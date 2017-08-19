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

                @if(!Auth::user()->isMahasiswa())
                <hr style="margin: 20px 0 5px"/>
                <h6 style="margin: 5px;font-weight:bold">Informasi Pengusul</h6>
                <hr style="margin: 5px"/>
                <ol style="padding: 10px">
                @foreach ($anggota->cursor() as $value)
                    <li>{{ $value->pengguna()->nama }} {!! $value->pengguna()->nama == $ketua->nama ? '<b>(Ketua)</b>' : '' !!}</li>
                @endforeach
                </ol>
                @endif

                @if(Auth::user()->isKetua())
                    <a href="{{ route('edit.proposal') }}" class="btn btn-warning btn-sm">Edit Proposal</a>
                @endif
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h5>Unduh Berkas</h5>
            </div>
            <div class="card-content">
                    <a href="#" class="btn btn-primary" onclick="event.preventDefault();document.getElementById('unduh-proposal').submit();">Unduh Proposal</a>
                    @if(Auth::user()->mahasiswa()->proposal()->punyaProposalFinal())
                    <a href="#" class="btn btn-primary">Unduh Proposal Final</a>
                    @endif
                    @if(!Auth::user()->isMahasiswa())
                    <a href="#" class="btn btn-primary">Unduh Laporan Kemajuan</a>
                    <a href="#" class="btn btn-primary">Unduh Laporan Akhir</a>
                    @endif
                    <form id="unduh-proposal" action="{{ route('unduh.proposal') }}" method="post" style="display: none;">
                        {{ csrf_field() }}
                    </form>
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
                        {{ str_replace('|', ', ', $proposal->keyword) }}
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3">
                        <strong>Abstrak</strong>
                    </div>
                    <div class="col-lg-9">
                        {!! $proposal->abstrak !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
