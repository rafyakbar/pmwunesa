@extends('layouts.app')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/form.css') }}"/>
@endpush

@section('content')

    @if(!Auth::user()->mahasiswa()->punyaTim() || (Auth::user()->isKetua() && Auth::user()->mahasiswa()->jumlahAnggotaTim() < 3))
        <div class="row">
            <div class="col-lg-4">
                @if(Auth::user()->mahasiswa()->punyaTim())
                    @include('mahasiswa.part.daftar_tim')
                @endif
                @if(Auth::user()->mahasiswa()->undanganTimAnggota()->count() > 0)
                    @include('mahasiswa.part.undangan_tim_yang_diterima')
                @endif
                    @include('mahasiswa.part.undangan_tim_yang_dikirim')
            </div>
            <div class="col-lg-8">
                @include('mahasiswa.part.pencarian_anggota')
            </div>
        </div>

    @else
        @include('mahasiswa.part.info_tim')
    @endif

    @push('js')
        <script src="{{ asset('js/jquery.form.js') }}"></script>
        @if(!Auth::user()->mahasiswa()->timLengkap())
        <script src="{{ asset('js/undangantim.js') }}"></script>
        @else
        <script src="{{ asset('js/undanganpembimbing.js') }}"></script>
        @endif
    @endpush

@endsection
