<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Lefuturiste\LessPass as LessPass;

use \App\Http\Controllers\PasswordProfileController;

function checkIfExists($table, $value, $field = 'id'){
    return DB::table($table)->where($field, $value)->exists();
}

Route::get('/', function () {
  $profile = NULL;
  if(isset($_COOKIE['session_id'])) {
    $profile = DB::table('password_profiles')
            ->select('masterpassword','password_length', 'counter', 'has_lowercase as lowercase', 'has_uppercase as uc', 'has_symbols as symbols','has_numbers as numbers')
             ->where('session_id' ,$_COOKIE['session_id'])
             ->latest()
             ->first(); 
  }
   return view('generate_password', ['data' => $profile]); 
})->name('welcome');

Route::post('/generate', function (Request $request) {
    $cookie = $_COOKIE['session_id'] ?? NULL; 

    $lpg = new LessPass\LessPassGenerator();
   
    $site = $request->input('site') ?? NULL;
    $login = $request->input('login') ?? NULL;
    $master = $request->input('master_password') ?? NULL;

    if(!$site || !$login || !$master) {
       return "Please fill in the login, site, and master password. <a href=\"https://nezpass.com\">Back</a>";
    }


    if($cookie == NULL) {
        $cookie_name = 'session_id';
        $cookie = 'nezpass_' . time() . rand(10,99);
        setcookie($cookie_name, $cookie, time() + (86400 * 30), "/"); 
    }

    $profile = [
		'lowercase' => $request->input('use_lowercase') ? true: false,
		'uppercase' => $request->input('use_uppercase') ? true: false,
		'numbers' => $request->input('use_numbers') ? true: false,
		'symbols' => $request->input('use_symbols') ? true: false,
		'length' => $request->input('length'),
		'counter' => $request->input('counter'),
	];

    $password = $lpg->generatePassword($site, $login,$master, $profile);

	 //save to DB for later reuse
     $expiryTime = new DateTime();
     $expires = $expiryTime->add(new DateInterval("PT1440M"));
     DB::table('password_profiles')->insert([
        'masterpassword' => $master,
        'has_lowercase' => $profile['lowercase'] ,
        'has_uppercase' => $profile['lowercase'],
        'has_numbers' => $profile['numbers'],
        'has_symbols' => $profile['symbols'],
        'counter' => $profile['counter'],
        'password_length' => $profile['length'],
        'expires_at' => $expires->format('Y-m-d H:i:s'),
        'session_id' => $cookie
    ]);



    return '<code>' . $password. '</code>';
})->name('generate_password');


//Route::get('/hello', function () {
//   return 'Hello Login';
//});

Route::get('login', 'AuthController@index');
Route::post('post-login', 'AuthController@postLogin'); 
Route::get('registration', 'AuthController@registration');
Route::post('post-registration', 'AuthController@postRegistration'); 
Route::get('dashboard', 'AuthController@dashboard'); 
Route::get('logout', 'AuthController@logout');

//these will eventually be obsolete if user login / reg is done
Route::get('/generated-passwords/request','PasswordProfileController@requestRecentPasswords')
    ->name('generated_passwords.requestrecent');
Route::post('/generated-passwords/show', 'PasswordProfileController@showRecentPasswords')
    ->name('generated_passwords.showrecent');


