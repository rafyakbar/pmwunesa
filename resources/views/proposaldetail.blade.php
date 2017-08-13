@extends('layouts.app')

@section('title')
    Detail Proposal
    @endsection

    @section('brand')
        Proposal {{ $proposal->judul}}
    @endsection

@section('content')

<div class="row">
    <div class="col-lg-5">
        <div class="card">
            <div class="card-header">
                <h4>Informasi Umum</h4>
            </div>

            <div class="card-content">
                <div class="row">
                    <div class="col-lg-4">
                        <strong>Judul</strong>
                    </div>
                    <div class="col-lg-8">
                        {{ $proposal->judul }}
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <strong>Jenis Produk</strong>
                    </div>
                    <div class="col-lg-7">
                        {{ $proposal->jenis_usaha }}
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <strong>Usulan Dana</strong>
                    </div>
                    <div class="col-lg-8">
                        {{ Dana::format($proposal->usulan_dana) }}
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <strong>Judul</strong>
                    </div>
                    <div class="col-lg-8">
                        {{ $proposal->judul }}
                    </div>
                </div>

                <hr style="margin: 20px 0 5px"/>
                <h6 style="margin: 5px;font-weight:bold">Informasi Pengusul</h6>
                <hr style="margin: 5px"/>
                <ol style="padding: 10px">
                @foreach ($anggota->cursor() as $value)
                    <li>{{ $value->pengguna()->nama }} {!! $value->pengguna()->nama == $ketua->nama ? '<b>(Ketua)</b>' : '' !!}</li>
                @endforeach
                </ol>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h5>Unduh Berkas</h5>
            </div>
            <div class="card-content">
                    <a href="#" class="btn btn-primary">Unduh Proposal</a>
                    <a href="#" class="btn btn-primary">Unduh Proposal Final</a>
                    <a href="#" class="btn btn-primary">Unduh Laporan Kemajuan</a>
                    <a href="#" class="btn btn-primary">Unduh Laporan Akhir</a>
            </div>
        </div>
    </div>

    <div class="col-lg-7">
        <div class="card">
            <div class="card-header">
                <h4>Deskripsi Proposal</h4>
            </div>

            <div class="card-content">
                <div class="row">
                    <div class="col-lg-3">
                        <strong>Keyword</strong>
                    </div>
                    <div class="col-lg-9">
                        {{ $proposal->keyword }}
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3">
                        <strong>Abstrak</strong>
                    </div>
                    <div class="col-lg-9">
                        {{ $proposal->abstrak }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
