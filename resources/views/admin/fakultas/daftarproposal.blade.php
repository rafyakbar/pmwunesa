@extends('layouts.app')

@section('content')
    <h3>Proposal</h3>
    <div class="row">
        <div class="col-lg-2">
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
        </div>
        <div class="col-lg-2">
            <a href="{{ route('unduhproposalfakultas',[ 'filter'=>$filter ]) }}" class="btn btn-primary">Unduh
                Proposal</a>
        </div>
    </div>

    <div class="card card-content">
        <div class="row">
            <div class="col-lg-12">
                <table class="table" style="margin-left: 10px">
                    <thead class="text-primary">
                    <tr>
                        <th>No.</th>
                        <th>Judul Proposal</th>
                        <th>Anggota Tim</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        @foreach($proposal as $item)
                            @if($filter == 'semua')
                                <td>{{ ++$c }}</td>
                                <td>
                                    {{ $item->judul }}<br>
                                </td>
                                <td>
                                    <ul>
                                        @foreach(\PMW\Models\Proposal::find($item->id)->mahasiswa()->get() as $tim)
                                            <li>
                                                {{ \PMW\User::find($tim->id_pengguna)->nama }}
                                                ({{ $tim->id_pengguna }})
                                                @if(\PMW\User::find($tim->id_pengguna)->hasRole('Ketua Tim'))
                                                    <strong>(Ketua)</strong>
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                </td>
                            @else
                                @if(\PMW\Models\Proposal::find($item->id)->lolos(explode('_',$filter)[1]))
                                    <td>{{ ++$c }}</td>
                                    <td>
                                        {{ $item->judul }}<br>
                                    </td>
                                    <td>
                                        <ul>
                                            @foreach(\PMW\Models\Proposal::find($item->id)->mahasiswa()->get() as $tim)
                                                <li>
                                                    {{ \PMW\User::find($tim->id_pengguna)->nama }}
                                                    ({{ $tim->id_pengguna }})
                                                    @if(\PMW\User::find($tim->id_pengguna)->hasRole('Ketua Tim'))
                                                        <strong>(Ketua)</strong>
                                                    @endif
                                                </li>
                                            @endforeach
                                        </ul>
                                    </td>
                                @endif
                            @endif
                        @endforeach
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <ul>

        </ul>
@endsection