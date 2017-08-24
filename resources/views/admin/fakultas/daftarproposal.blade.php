@extends('layouts.app')

@section('content')
    <div class="dropdown">
        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
            Pilih&nbsp;&nbsp;Filter&nbsp;&nbsp;<span class="caret"></span>
        </button>
        <ul class="dropdown-menu">
            <li><a href="{{ route('proposaladminfakultas',[ 'filter' => 'semua' ]) }}">Semua Proposal</a></li>
            <li><a href="{{ route('proposaladminfakultas',[ 'filter' => 'tahap_1' ]) }}">Lolos Tahap 1</a></li>
            <li><a href="{{ route('proposaladminfakultas',[ 'filter' => 'tahap_2' ]) }}">Lolos Tahap 2</a></li>
        </ul>
    </div>
    <a href="{{ route('unduhproposalfakultas',[ 'filter'=>$filter ]) }}" class="btn btn-primary">Unduh Proposal</a>
    <ul>
        @foreach($proposal as $item)
            @if($filter == 'semua')
                <li>
                    {{ $item->judul }}<br>
                    Tim<br>
                    <ul>
                        @foreach(\PMW\Models\Proposal::find($item->id)->mahasiswa()->get() as $tim)
                            <li>
                                {{ $tim->id_pengguna }}
                                {{ \PMW\User::find($tim->id_pengguna)->nama }}
                                @if(\PMW\User::find($tim->id_pengguna)->hasRole('Ketua Tim'))
                                    <strong>(Ketua)</strong>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </li>
            @else
                @if(\PMW\Models\Proposal::find($item->id)->lolos(explode('_',$filter)[1]))
                    <li>
                        {{ $item->judul }}<br>
                        Tim<br>
                        <ul>
                            @foreach(\PMW\Models\Proposal::find($item->id)->mahasiswa()->get() as $tim)
                                <li>
                                    {{ $tim->id_pengguna }}
                                    {{ \PMW\User::find($tim->id_pengguna)->nama }}
                                    @if(\PMW\User::find($tim->id_pengguna)->hasRole('Ketua Tim'))
                                        <strong>(Ketua)</strong>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </li>
                @endif
            @endif
        @endforeach
    </ul>
@endsection