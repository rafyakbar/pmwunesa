@extends('layouts.app')

@section('content')
    @if(Auth::user()->mahasiswa()->bisaKirimUndanganDosen())
        <form action="{{ route('undang.dosen') }}" method="post">
            {{ csrf_field() }}
            <input type="text" name="dosen"/>
            <input type="submit"/>
        </form>
    @endif
@endsection