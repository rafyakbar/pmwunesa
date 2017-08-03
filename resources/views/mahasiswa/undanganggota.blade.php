<form action="{{ route('undang.anggota') }}" method="post">
{{ csrf_field() }}
    <input type="text" name="untuk"/>
    <input type="submit"/>
</form>