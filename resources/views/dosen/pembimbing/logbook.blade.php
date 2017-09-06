@extends('layouts.app')

@section('brand', "Logbook")
@section('title', "Logbook")

@section('content')

    @if($proposal->lolos())

        <div class="card" id="logbook-header" style="{{ $errors->count() > 0 ? 'display:none' : '' }}">
            <div class="card-content">
                <div class="row">
                    <div class="col-lg-10">
                        <h5 style="vertical-align:middle;margin-top:20px">Tim ini
                            memiliki {{ $proposal->logbook()->count() }} logbook</h5>
                    </div>
                </div>
            </div>
        </div>

        @if($proposal->logbook()->count() > 0)
            @include('mahasiswa.part.daftar_logbook', [
                'daftarlogbook' => $daftarlogbook
            ])
        @endif

    @else

        <div class="card">

            <div class="card-content">
                <p class="alert alert-primary">Tim belum dinyatakan lolos</p>
            </div>

        </div>

    @endif

@endsection
