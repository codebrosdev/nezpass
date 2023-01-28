<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 
class PasswordProfileController extends Controller
{
  /**
   * show form to user for finding his 
     previously generated passwords if masterpassword matches in either plaintext or in non-plaintext form.
   */
  public function requestRecentPasswords() {
    $this->checkSession();
    return view('generated_passwords.requestrecent');
  }

  public function showRecentPasswords(Request $request) {
    $sess_id = $this->checkSession();

    $master = $request->input('master_password');
    if(!$master) {
      return 'Could not proceed - no master password';
    }

    $hash = hash('sha256', $master);
    $passwords = DB::table('password_profiles')
                     ->join('generated_passwords', 'password_profiles.session_id','=', 'generated_passwords.session_id')
                     ->where([
                          ['generated_passwords.session_id', $sess_id],
                          ['masterpassword', $hash],
                     ])->orWhere([
                          ['generated_passwords.session_id', $sess_id],
                          ['masterpassword', $master],
                     ])->get();

    return view('generated_passwords.showrecent', ['passwords' => $passwords]);
  }

  private function checkSession() {
    if(isset($_COOKIE['session_id'])) {
       return $_COOKIE['session_id'];
    } 
    redirect('/');
  }
}
