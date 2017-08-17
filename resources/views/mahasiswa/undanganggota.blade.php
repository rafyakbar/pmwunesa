@extends('layouts.app')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/form.css') }}"/>
@endpush

@section('content')

    @if(!Auth::user()->mahasiswa()->punyaTim() || (Auth::user()->isKetua() && Auth::user()->mahasiswa()->jumlahAnggotaTim() < 3))
        <div class="row">
            <div class="col-lg-4">
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
        <div class="row">
            <div class="col-lg-5">
                <div class="card">
                    <div class="card-header">
                        <h4>Tim Anda</h4>
                    </div>
                    <div class="card-content">
                        <ul>
                            @foreach(Auth::user()->mahasiswa()->proposal()->mahasiswa()->cursor() as $anggota)
                                <li>{{ $anggota->pengguna()->nama }} {!! $anggota->pengguna()->isKetua() ? '<b>(Ketua)</b>' : '' !!}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @push('js')
        <script src="{{ asset('js/jquery.form.js') }}"></script>
        <script src="{{ asset('js/undangantim.js') }}"></script>
    @endpush

@endsection
