@extends('layouts.app')

@section('brand','Dasbor')

@section('title','Dasbor ' . Auth::user()->nama)

@section('content')

    @if(Auth::user()->isDosenPembimbing())
        @include('dosen.pembimbing.part.dashboard')
    @endif

    @if(Auth::user()->bisaRequestHakAkses(\PMW\Models\HakAkses::REVIEWER))
        <form action="{{ route('request.reviewer') }}" class="ajax-form" method="post">
            {{ csrf_field() }}
            <input type="submit" class="btn btn-warning" value="Request menjadi reviewer"/>
        </form>
    @endif

    @if(Auth::user()->requestingHakAkses(\PMW\Models\HakAkses::REVIEWER))
        Anda sedang menunggu persetujuan untuk menjadi reviewer
    @endif
@endsection

@push('js')
    <script src="{{ asset('js/jquery.form.js') }}" charset="utf-8"></script>
    <script src="{{ asset('js/dosen.js') }}" charset="utf-8"></script>
@endpush
