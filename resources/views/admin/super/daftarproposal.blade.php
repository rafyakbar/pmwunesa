@extends('layouts.app')

@section('content')
    <h3>Proposal</h3>
<div class="row">
    <div class="col-lg-4">
        <div class="dropdown">
            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
                Filter&nbsp;&nbsp;Fakultas&nbsp;&nbsp;<span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
                <li><a href="{{ route('daftar.proposal',['fakultas' => 'semua_fakultas', 'lolos' => $lolos]) }}">Semua Fakultas</a></li>
                @foreach($daftar_fakultas as $item)
                    <li><a href="{{ route('daftar.proposal',[ 'fakultas' => str_replace(' ','_',strtolower($item->nama)), 'lolos' => $lolos]) }}">Fakultas {{ $item->nama }}</a></li>
                @endforeach
            </ul>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="dropdown">
            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
                Filter&nbsp;&nbsp;Tahap&nbsp;&nbsp;<span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
                <li><a href="{{ route('daftar.proposal',['fakultas' => $fakultas, 'lolos' => 'semua']) }}">Semua Proposal</a></li>
                <li><a href="{{ route('daftar.proposal',['fakultas' => $fakultas, 'lolos' => 'tahap_1']) }}">Lolos Tahap 1</a></li>
                <li><a href="{{ route('daftar.proposal',['fakultas' => $fakultas, 'lolos' => 'tahap_2']) }}">Lolos Tahap 2</a></li>
            </ul>
        </div>
    </div>
</div>
    <br>



    <p>Filter : @if($fakultas!='semua_fakultas') Fakultas @endif {{ ucwords(str_replace('_',' ',$fakultas)) }} | @if($lolos == 'semua') Semua Tahap @else {{ ucwords(str_replace('_',' ',$lolos)) }} @endif</p>
    <br>
    <a href="{{ route('unduh.filter.proposal', [ 'fakultas' => $fakultas, 'lolos' => $lolos ]) }}" class="btn btn-primary">Unduh Proposal</a>

    <ul>
        @foreach($proposal as $item)
            @if($lolos != 'semua')
                @if(\PMW\Models\Proposal::find($item->id)->lolos(explode('_',$lolos)[1]))
                    @if($item->judul != '' && $item->judul != null)
                        <li>
                            {{ $item->judul }} <br>
                            <ul>
                                <p>Tim</p>
                                @foreach(\PMW\Models\Proposal::find($item->id)->mahasiswa()->cursor() as $value)
                                    <li>
                                        {{ \PMW\User::find($value->id_pengguna)->nama }}
                                        @if(\PMW\User::find($value->id_pengguna)->hasRole('Ketua Tim'))
                                            <strong>(Ketua)</strong>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                            <a href="{{ route('edit.reviewer',['idproposal' => $item->id]) }}" class="btn btn-primary">Atur Reviewer</a>
                        </li>
                    @endif
                @endif
            @else
                @if($item->judul != '' && $item->judul != null)
                    <li>
                        {{ $item->judul }} <br>
                        <ul>
                            <p>Tim</p>
                            @foreach(\PMW\Models\Proposal::find($item->id)->mahasiswa()->cursor() as $value)
                                <li>
                                    {{ \PMW\User::find($value->id_pengguna)->nama }}
                                    @if(\PMW\User::find($value->id_pengguna)->hasRole('Ketua Tim'))
                                        <strong>(Ketua)</strong>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                        <a href="{{ route('edit.reviewer',['idproposal' => $item->id]) }}" class="btn btn-primary">Atur Reviewer</a>
                    </li>
                @endif
            @endif
        @endforeach
    </ul>
@endsection