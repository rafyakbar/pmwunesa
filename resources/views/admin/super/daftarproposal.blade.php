@extends('layouts.app')

@section('content')
    <div class="btn-group">
        <div class="btn-group">
            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
                {{ ucwords(str_replace('_', ' ', $fakultas)) }}&nbsp;&nbsp;<span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
                <li><a href="{{ route('daftar.proposal',['fakultas' => 'semua_fakultas', 'lolos' => $lolos]) }}">Semua
                        Fakultas</a></li>
                @foreach($daftar_fakultas as $item)
                    <li>
                        <a href="{{ route('daftar.proposal',['fakultas' => str_replace(' ','_',strtolower($item->nama)), 'lolos' => $lolos]) }}">Fakultas {{ $item->nama }}</a>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="btn-group">
            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
                {{ ucwords(str_replace('_', ' ', $lolos)) }}&nbsp;&nbsp;<span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
                <li><a href="{{ route('daftar.proposal',['fakultas' => $fakultas, 'lolos' => 'semua_proposal']) }}">Semua
                        Proposal</a></li>
                <li><a href="{{ route('daftar.proposal',['fakultas' => $fakultas, 'lolos' => 'tahap_1']) }}">Lolos
                        Tahap 1</a></li>
                <li><a href="{{ route('daftar.proposal',['fakultas' => $fakultas, 'lolos' => 'tahap_2']) }}">Lolos
                        Tahap 2</a></li>
            </ul>
        </div>
        @if($proposal->total() > 0)
            <a href="{{ route('unduhproposaluniv', [ 'fakultas' => $fakultas, 'lolos' => $lolos ]) }}"
               class="btn btn-info">Unduh</a>
        @endif
    </div>

    <div class="card">
        <div class="card-header" data-background-color="purple">
            <h4>Daftar proposal</h4>
            <p class="category">Jumlah proposal sesuai filter adalah {{ count($proposal) }}</p>
        </div>
        <div class="card-content">
            @if($proposal->total() == 0)
                <div class="alert alert-info">
                    <h5>Maaf, masih belum ada proposal!</h5>
                </div>
            @else
                <table class="table table-responsive">
                    <thead>
                    <tr>
                        <th>No.</th>
                        <th>Judul Proposal</th>
                        <th>Jenis Usaha</th>
                        <th>Anggota Tim</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($proposal as $item)
                        <tr>
                            <td>{{ ($proposal->currentpage() * $proposal->perpage()) + (++$c) - $proposal->perpage()  }}</td>
                            <td>
                                {{ $item->judul }}
                            </td>
                            <td>
                                {{ $item->jenis_usaha }}
                            </td>
                            <td>
                                <ul>
                                    @foreach(\PMW\Models\Proposal::find($item->id)->mahasiswa()->cursor() as $value)
                                        <li>
                                            {{ \PMW\User::find($value->id_pengguna)->nama }}
                                            @if(\PMW\User::find($value->id_pengguna)->hasRole('Ketua Tim'))
                                                <strong>(Ketua)</strong>
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <button class="btn btn-info btn-sm">Detail</button>
                                    <a href="{{ route('edit.reviewer',['idproposal' => $item->id]) }}"
                                       class="btn btn-primary btn-sm">Atur Reviewer</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>

@endsection