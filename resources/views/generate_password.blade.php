<!doctype html>
<head>
<title>NezPass: Ce NezPass (ne pas) LessPass</title>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>

<body>
<div class="container">

<h1>NezPass: LessPass with a database</h1>

<p>NezPass may be less secure than LessPass.com because the form submits to the server and returns back the generated password. We employ the same algorithm used by LessPass.com but the inputs actually enter the server. We only store the master password and the password criteria for subsequent use.</p>

@include('shared.notices')

<form action="{{ route('generate_password') }}" method="POST">
    @csrf
<div>
@if($data)
  <div class="form-group"><label for="site">Site:</label><input class="form-control" type="text" name="site" placeholder="Site" required></div>
  <div class="form-group"><label for="master_password">Master:</label><input class="form-control" type="password" name="master_password" placeholder="Master Password" value="{{ ($data->masterpassword) ?? '' }}" required></div>
   <div class="form-group"><label>Length</label>
	<input class="form-control" type="number" name="length"  placeholder="length" value="{{ ($data->password_length) ?? '' }}">
   </div>
	<div class="form-group"><label>Login:</label> <input class="form-control" type="text" name="login" placeholder="login"required></div>
	<div class="form-group"><label>Counter:</label> 
		<input type="number" class="form-control" name="counter" placeholder="counter" value="{{ (!empty($data->counter)) ?? '1' }}">
    </div>
@else
  <div class="form-group"><label for="site">Site:</label><input class="form-control" type="text" name="site" placeholder="Site" required></div>
  <div class="form-group"><label for="master_password">Master:</label><input class="form-control" type="password" name="master_password" placeholder="Master Password" required></div>
   <div class="form-group"><label>Length</label>
	<input type="number" class="form-control" name="length"  placeholder="length">
   </div>
	<div class="form-group"><label>Login:</label> <input type="text" class="form-control" name="login" placeholder="login"required></div>
	<div class="form-group"><label>Counter:</label> 
		<input type="number" name="counter" placeholder="counter" class="form-control" value="1">
    </div>
@endif
</div>

<div>
	<input type="checkbox" name="use_lowercase" {{ ($data && $data->lowercase) ? 'checked' : '' }}><label for="use_lowercase">Use lowercase</label>
	<input type="checkbox" name="use_uppercase" {{ ($data && $data->uc)  ? 'checked': '' }}><label for="use_uppercase">Use uppercase</label>
	<input type="checkbox" name="use_symbols" {{ ($data && $data->symbols) ? 'checked' : '' }}><label for="use_symbols">Use symbols</label>
	<input type="checkbox" name="use_numbers" {{ ($data && $data->numbers) ? 'checked' : '' }}><label for="use_numbers">Use numbers</label>
</div>
<br />
<input type="reset" value="clear" style="background-color: orange">

<input style="border:2px solid lightblue;" type="submit" name="submit" value="generate">

</form>
</div>

</body>
</html>
