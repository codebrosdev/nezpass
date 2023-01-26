<form action="{{ route('generate_password') }}" method="POST">
    @csrf
<div>
	<input type="text" name="site" placeholder="Site" >
	<input type="text" name="master_password" placeholder="Master">
	<input type="number" name="length"  placeholder="length" value="16">
	<input type="text" name="login" placeholder="login">
	<input type="number" name="counter" placeholder="counter">
</div>

<div>
	<input type="checkbox" name="use_lowercase" checked="checked"><label for="use_lowercase">Use lowercase</label>
	<input type="checkbox" name="use_uppercase" checked="checked"><label for="use_uppercase">Use uppercase</label>
	<input type="checkbox" name="use_symbols" checked="checked"><label for="use_symbols">Use symbols</label>
	<input type="checkbox" name="use_numbers" checked="checked"><label for="use_numbers">Use numbers</label>
</div>
<br />
<input type="submit" name="submit" value="submit">
</form>


@include('shared.notices');
