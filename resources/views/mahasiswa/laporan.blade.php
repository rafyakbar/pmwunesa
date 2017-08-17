@extends('layouts.app')

@section('brand','Laporan')

@section('title','Laporan')

@section('content')

@if(Auth::user()->mahasiswa()->punyaTim())
@if(!is_null(Auth::user()->mahasiswa()->proposal()->laporanKemajuan()))

@endif
@else

    <div class="card">
        <div class="card-content">
            <p class="alert alert-primary">Anda belum memiliki tim</p>
        </div>
    </div>

@endif

@endsection
