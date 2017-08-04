@extends('layouts.app')

@section('content')

    <form action="{{ route('unggah.proposal') }}" method="post" enctype="multipart/form-data">

        {{ method_field('put') }}

        {{ csrf_field() }}

        <input type="text" name="judul"/>

        <input type="text" name="jenis_usaha"/>

        <textarea name="keyword"></textarea>

        <textarea name="abstrak"></textarea>

        <input type="file" name="berkas"/>

        <input type="submit" value="unggah"/>

    </form>

@endsection