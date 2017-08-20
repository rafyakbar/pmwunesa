@extends('layouts.app')

@section('content')
    <a href="{{ route('unduhproposalfakultas') }}">Unduh Proposal</a>
    <ul>
        @foreach($proposal as $item)
            <li>
                {{ $item->judul }}<br>
                Tim<br>
                <ul>
                    @foreach(\PMW\Models\Proposal::find($item->id_proposal)->mahasiswa()->get() as $tim)
                        <li>
                            {{ $tim->id_pengguna }}
                            {{ \PMW\User::find($tim->id_pengguna)->nama }}
                            @if($tim->id_pengguna == $item->id_ketua)
                                <strong>(Ketua)</strong>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </li>
        @endforeach
    </ul>
@endsection