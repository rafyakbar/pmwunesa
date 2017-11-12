@extends('layouts.app')

@section('brand')
    Detail <b>{{ $proposal->judul }}</b>
@endsection

@section('content')
    <div class="card">
        <div class="card-content">
            <div class="alert alert-info">
                <p>Proposal ini diunggah {{ $proposal->created_at->diffForHumans() }} ({{ $proposal->created_at }})</p>
            </div>
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <label>Jenis usaha</label>
                    <h5><b>{{ $proposal->jenis_usaha }}</b></h5>
                    <label>Reviewer tahap 1</label>
                    @if(!is_null($proposal->daftarReview(1)))
                        <ul class="list-group">
                            @foreach($proposal->daftarReview(1)->get() as $item)
                                <li class="list-group-item">
                                    <b>{{ \PMW\User::find($item->id_pengguna)->nama }}</b>
                                    @if(!is_null($item->komentar))
                                        <br>
                                        <label>Komentar</label>
                                        <p>{{ $item->komentar }}</p>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <br>
                        -
                    @endif
                </div>
                <div class="col-md-3 col-sm-6">
                    <label>Usulan dana</label>
                    <h5><b>Rp {{ Dana::format($proposal->usulan_dana) }}</b></h5>
                    <label>Reviewer tahap 2</label>
                    @if(!is_null($proposal->daftarReview(2)))
                        <ul class="list-group">
                            @foreach($proposal->daftarReview(2)->get() as $item)
                                <li class="list-group-item">
                                    <b>{{ \PMW\User::find($item->id_pengguna)->nama }}</b>
                                    @if(!is_null($item->komentar))
                                        <br>
                                        <label>Komentar</label>
                                        <p>{{ $item->komentar }}</p>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <br>
                        -
                    @endif
                </div>
                <div class="col-md-3 col-sm-6">
                    <label>Status penilaian</label>
                    <h5><b>{{ $proposal->statusPenilaian() }}</b></h5>
                    <label>Nilai rata-rata</label>
                    <ul class="list-group">
                        <ul class="list-group-item">
                            <p><b>Tahap 1</b><br>{{ $proposal->nilaiRataRata(1) }}</p>
                        </ul>
                        <ul class="list-group-item">
                            <p><b>Tahap 2</b><br>{{ $proposal->nilaiRataRata(2) }}</p>
                        </ul>
                    </ul>
                </div>
                <div class="col-md-3 col-sm-6">
                    <label>Unduh proposal</label>
                    <br>
                    <div class="btn-group">
                        <a class="btn btn-primary btn-sm">belum final</a>
                        @if(is_null($proposal->direktori_final))
                            <a class="btn btn-success btn-sm">final</a>
                        @endif
                    </div>
                    <label>Pembimbing & Tim</label>
                    <ul class="list-group">
                        <li class="list-group-item">
                            <label>Pembimbing</label>
                            @if($proposal->punyaPembimbing())
                                <b>{{ $proposal->pembimbing()->nama }}</b>
                                <br>
                                {{ $proposal->pembimbing()->id }}
                            @else
                            @endif
                        </li>
                        <li class="list-group-item">
                            <label>Tim</label>
                            @foreach($proposal->mahasiswa()->get() as $item)
                                <br>
                                <b>
                                    {{ $item->pengguna()->nama }}
                                    @if($item->pengguna()->isKetua())
                                        (ketua)
                                    @else
                                        (anggota)
                                    @endif
                                </b>
                                <br>
                                {{ $item->pengguna()->id }}
                            @endforeach
                        </li>
                    </ul>
                </div>
            </div>
            <label>Abstrak</label>
            <p>{!! $proposal->abstrak !!}</p>
            <p><i>keyword : </i>{{ $proposal->keyword() }}</p>
        </div>
    </div>
@endsection