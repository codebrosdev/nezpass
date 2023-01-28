<!doctype html>
<html>

<form action="{{ route('generated_passwords.showrecent') }}" method="post">
 @csrf
<strong>Enter your master password:</strong>
  <input type="text" name="master_password">
<br />
  <input type="submit" value="Show My Passwords" name="submit">
  
</form>
