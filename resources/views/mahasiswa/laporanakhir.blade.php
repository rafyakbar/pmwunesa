@extends('layouts.app')

@section('content')
    @if(is_null(Auth::user()->mahasiswa()->proposal()->laporanAkhir()))
    <form action="{{ route('unggah.laporan.akhir') }}" method="post" enctype="multipart/form-data">

        {{ csrf_field() }}

        {{ method_field('put') }}

        <textarea name="keterangan"></textarea>

        <input type="file" name="berkas"/>

        <input type="submit" value="Unggah">

    </form>
        @else
        Anda telah mengunggah laporan akhir. <a href="{{ route('unduh.laporan.akhir') }}" onclick="event.preventDefault();document.getElementById('unduh-laporan').submit();">Unduh disini</a>

        <form id="unduh-laporan" action="{{ route('unduh.laporan.akhir') }}" method="post" style="display: none;">
            {{ csrf_field() }}
        </form>
    @endif
@endsection
