<form action="{{ route('gantipassword') }}" method="post">

{{ csrf_field() }}

<input type="text" name="baru"/>

<input type="submit" value="ganti"/>

</form>