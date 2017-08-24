<html>
<body>
<form action="{{ route('radio') }}" method="post">
    {{ csrf_field() }}
    <p>
    <input type="radio" name="a[0]" value="a"/>
    <input type="radio" name="a[0]" value="b"/>
    <input type="radio" name="a[0]" value="c"/>
    </p>
    <p>
    <input type="radio" name="a[2]" value="a"/>
    <input type="radio" name="a[2]" value="b"/>
    <input type="radio" name="a[2]" value="c"/>
    </p>
    <input type="submit"/>
</form>
</body>
</html>