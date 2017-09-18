@extends('layouts.app')

@section('brand', "Laporan")

@section('content')
    @if(is_null(Auth::user()->mahasiswa()->proposal()->laporanKemajuan()))
        <form action="{{ route('unggah.laporan.kemajuan') }}" method="post" enctype="multipart/form-data">

            {{ csrf_field() }}

            {{ method_field('put') }}

            <textarea name="keterangan"></textarea>

            <input type="file" name="berkas"/>

            <input type="submit" value="Unggah">

        </form>
    @else
        Anda telah mengunggah laporan kemajuan. <a href="{{ route('unduh.laporan.kemajuan') }}" onclick="event.preventDefault();document.getElementById('unduh-laporan').submit();">Unduh disini</a>

        <form id="unduh-laporan" action="{{ route('unduh.laporan.kemajuan') }}" method="post" style="display: none;">
            {{ csrf_field() }}
        </form>
    @endif

    <div class="row">
        <div class="col-lg-6">
            <div class="panel-default">
                <div class="panel-heading">
                    <h3>Laporan Kemajuan</h3>
                </div>
                <div class="panel-body">
                    <form action="" method="" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>File Laporan</label><br>
                            <button class="btn btn-primary">Unggah Laporan <input type="file" name="file"></button>
                            <button class="btn btn-warning">Lihat Laporan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="panel-default">
                <div class="panel-heading">
                    <h3>Laporan Akhir</h3>
                </div>
                <div class="panel-body">
                    <form action="" method="">
                        <div class="form-group">
                            <label>File Laporan</label><br>
                            <button class="btn btn-primary">Unggah Laporan <input type="file" name="file"></button>
                            <button class="btn btn-warning">Lihat Laporan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
