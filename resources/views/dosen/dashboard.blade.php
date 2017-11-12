@extends('layouts.app')

@section('brand','Dasbor')

@section('title','Dasbor ' . Auth::user()->nama)

@section('content')

    @if(Auth::user()->isDosenPembimbing())
        @include('dosen.pembimbing.part.dashboard')
    @endif
    
@endsection

@push('js')
    <script src="{{ asset('js/jquery.form.js') }}" charset="utf-8"></script>
    <script src="{{ asset('js/dosen.js') }}" charset="utf-8"></script>
@endpush
