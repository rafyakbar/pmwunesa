@extends('layouts.app')

@section('brand')
    Proposal
@endsection

@section('content')
    <div class="btn-group">
        <div class="btn-group">
            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
                {{ ucwords(str_replace('_', ' ', $fakultas)) }}&nbsp;&nbsp;<span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
                <li><a href="{{ route('daftar.proposal',['fakultas' => 'semua_fakultas', 'lolos' => $lolos, 'perHalaman' => $perHalaman]) }}">Semua
                        Fakultas</a></li>
                @foreach($daftar_fakultas as $item)
                    <li>
                        <a href="{{ route('daftar.proposal',['fakultas' => str_replace(' ','_',strtolower($item->nama)), 'lolos' => $lolos, 'perHalaman' => $perHalaman]) }}">Fakultas {{ $item->nama }}</a>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="btn-group">
            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
                {{ ucwords(str_replace('_', ' ', $lolos)) }}&nbsp;&nbsp;<span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
                <li><a href="{{ route('daftar.proposal',['fakultas' => $fakultas, 'lolos' => 'semua_proposal', 'perHalaman' => $perHalaman]) }}">Semua
                        Proposal</a></li>
                <li><a href="{{ route('daftar.proposal',['fakultas' => $fakultas, 'lolos' => 'tahap_1', 'perHalaman' => $perHalaman]) }}">Lolos
                        Tahap 1</a></li>
                <li><a href="{{ route('daftar.proposal',['fakultas' => $fakultas, 'lolos' => 'tahap_2', 'perHalaman' => $perHalaman]) }}">Lolos
                        Tahap 2</a></li>
            </ul>
        </div>
        @if($proposal->total() > 0)
            <a href="{{ route('unduhproposaluniv', [ 'fakultas' => $fakultas, 'lolos' => $lolos ]) }}"
               class="btn btn-info">Unduh</a>
        @endif
    </div>
    <div class="btn-group">
        <div class="btn-group">
            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
                {{ $perHalaman }} per halaman&nbsp;&nbsp;<span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
                @for($per = 5; $per <= $proposal->total(); $per += 5)
                    <li>
                        <a href="{{ route('daftar.proposal',['fakultas' => $fakultas, 'lolos' => $lolos, 'perHalaman' => $per]) }}">{{ $per }} data per halaman</a>
                    </li>
                @endfor
                <li>
                    <li>
                        <a href="{{ route('daftar.proposal',['fakultas' => $fakultas, 'lolos' => $lolos, 'perHalaman' => $proposal->total()]) }}">Semua data</a>
                    </li>
                </li>
            </ul>
        </div>
    </div>

    <div class="card">
        <div class="card-header" data-background-color="purple">
            <h4>Daftar proposal</h4>
            <p class="category">Jumlah proposal sesuai filter adalah {{ $proposal->total() }}</p>
        </div>
        <div class="card-content">
            @if($proposal->total() == 0)
                <div class="alert alert-info">
                    <h5>Maaf, masih belum ada proposal!</h5>
                </div>
            @else
                <table class="table use-datatable">
                    <thead>
                    <tr>
                        <th style="width: 5%">No.</th>
                        <th style="width: 45%">Judul Proposal</th>
                        <th style="width: 20%">Jenis Usaha</th>
                        <th style="width: 30%">Aksi</th>
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
                                <div class="btn-group">
                                    <a href="{{ route('detail.proposal', ['id' => $item->id]) }}" class="btn btn-info btn-sm">Detail</a>
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
        <div class="card-footer">
            {{ $proposal->links() }}
        </div>
    </div>

@endsection