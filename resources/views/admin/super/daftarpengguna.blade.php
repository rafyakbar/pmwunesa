@extends('layouts.app')

@section('content')
    <ul>
        @foreach($user as $u)
            <li>{{ $u->nama }},
                @foreach($u->hakAksesPengguna()->cursor() as $item)
                    {{ $item->nama  }}
                @endforeach
            </li>
        @endforeach
    </ul>
@endsection