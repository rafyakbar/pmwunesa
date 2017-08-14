@extends('layouts.app')

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
@endsection
