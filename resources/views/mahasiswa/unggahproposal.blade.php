@extends('layouts.app')

@section('content')

    <form action="{{ route('unggah.proposal') }}" method="post" enctype="multipart/form-data">

        {{ csrf_field() }}

        {{ method_field('put') }}

        Judul
        <input type="text" name="judul"/><br/>

        Usulan Dana
        <input type="number" name="usulan_dana"/><br/>

        Abstrak
        <textarea name="abstrak"></textarea><br/>

        Keyword
        <textarea name="keyword"></textarea><br/>

        Jenis Usaha
        <select name="jenis_usaha">
            <option value="Barang">Barang</option>
            <option value="Jasa">Jasa</option>
            <option value="Barang & Jasa">Barang & jasa</option>
        </select>
        <br/>
        Berkas
        <input type="file" name="berkas"/>

        <input type="submit" value="Unggah"/>
    </form>

@endsection