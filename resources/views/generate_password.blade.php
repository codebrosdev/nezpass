<!doctype html>
<head>
<title>NezPass: Ce NezPass (ne pas) LessPass</title>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<script defer src="https://unpkg.com/alpinejs@3.2.4/dist/cdn.min.js"></script>

</head>

<body>
<div class="container">
<div class="col-md-6">
<h1>NezPass: LessPass with a database</h1>

<p>We use the same algorithm as LessPass.com and input the password criteria and master password on our server to generate a password, which we store for future use.</p>

@include('shared.notices')
</div>
<div class="col-md-6">
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

<div style="border: 1px solid grey; padding-left:15px; padding-top:5px;">
	<div class="input-group">
      <input type="checkbox" aria-label="Checkbox to use lowercase" name="use_lowercase" {{ ($data && $data->lowercase) ? 'checked' : '' }} style="width: 30px; height: 30px;"><label for="use_lowercase" class="input-group-text">Use lowercase (a-z)</label>
     </div>

	<div class="input-group">
	<input type="checkbox" name="use_uppercase" {{ ($data && $data->uc)  ? 'checked': '' }} style="width: 30px; height: 30px;"><label for="use_uppercase" class="input-group-text">Use uppercase (A-Z)</label>
	</div>

	<div class="input-group">
<input type="checkbox" name="use_numbers" {{ ($data && $data->numbers) ? 'checked' : '' }} style="width: 30px; height: 30px;"><label for="use_numbers" class="input-group-text">Use numbers (0-9)</label>
    </div>

	<div class="input-group">
	<input type="checkbox" name="use_symbols" {{ ($data && $data->symbols) ? 'checked' : '' }} style="width: 30px; height: 30px;"><label for="use_symbols" class="input-group-text">Use symbols (%!@)</label>
	</div>
<br />
<input type="reset" value="clear" style="background-color: grey; color: darkblue">

<input style="border:2px solid blue;background: green; color: white" type="submit" name="submit" value="generate">

</form>
<br><br>
</div>
</div>


</body>
</html>
