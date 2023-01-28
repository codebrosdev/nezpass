<!doctype html>
<html>

@if(sizeof($passwords) == 0) 
  <p>No matches found</p>
@else
  <ul>
    @foreach($passwords as $password)
      <li><code>{{ $password->password }}</code></li>
    @endforeach
  </ul>
@endif


</html>
