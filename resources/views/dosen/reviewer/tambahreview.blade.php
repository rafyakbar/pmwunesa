@extends('layouts.app')

@section('content')
    <form action="{{ route('tambah.review',['idproposal' => $idproposal, 'tahap' => $tahap]) }}" method="post">

        {{ csrf_field() }}

        {{ method_field('put') }}

        Aspek
        <ul>
            @foreach($daftarAspek as $aspek)
                <li>
                    {{ $aspek->nama }}
                    @for($i = 1;$i <= 5;$i++)
                        {{ $i }}<input type="radio" name="nilai[{{ $aspek->id }}]" value="{{ $i }}"/>
                    @endfor
                </li>
            @endforeach
        </ul>

        <br/>
        Komentar<br/>
        <textarea name="komentar"></textarea>

        <br/>
        <input type="submit" name="Beri nilai"/>

    </form>
@endsection