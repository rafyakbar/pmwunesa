@extends('layouts.app')

@section('content')
    @if(is_null(Auth::user()->proposal()->direktori_final))
        <form action="{{ route('unggah.proposal.final') }}" method="post" enctype="multipart/form-data">

            {{ csrf_field() }}

            {{ method_field('put') }}

            <input type="file" name="berkas"/>

            <input type="submit" value="Unggah"/>

        </form>
    @endif
@endsection