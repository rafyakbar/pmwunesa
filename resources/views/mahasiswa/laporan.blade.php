@extends('layouts.app')

@section('brand','Laporan')

@section('title','Laporan')

@section('content')

    @if(Auth::user()->mahasiswa()->punyaTim())
        @if(Auth::user()->mahasiswa()->proposal()->lolos())
            @include('mahasiswa.part.info_laporan')
        @else
            <div class="card">
                <div class="card-content">
                    <p class="alert alert-primary">Proposal tim anda belum lolos</p>
                </div>
            </div>
        @endif
    @else

        <div class="card">
            <div class="card-content">
                <p class="alert alert-primary">Anda belum memiliki tim</p>
            </div>
        </div>

    @endif

@endsection
