@extends('layouts.app')

@section('content')

    <div class="card">
        <div class="card-header">
            <h4 class="title">Ups, anda belum mendapat hak akses apapun !</h4>
            <p class="category">Untuk mendapatkan hak akses, silahkan tekan tombol berikut sesuai hak akses yang anda inginkan</p>
        </div>

        <div class="card-content">
            @if(Auth::user()->bisaRequestHakAkses(\PMW\Models\HakAkses::DOSEN_PEMBIMBING))
                <form action="{{ route('request.pembimbing') }}" method="post">
                    {{ csrf_field() }}
                    <input type="submit" value="Request menjadi dosen pembimbing" class="btn btn-primary"/>
                </form>
            @elseif(Auth::user()->requestingHakAkses(\PMW\Models\HakAkses::DOSEN_PEMBIMBING))
                <p>Anda sedang menunggu persetujuan untuk menjadi dosen pembimbing</p>
            @endif

            @if(Auth::user()->bisaRequestHakAkses(\PMW\Models\HakAkses::REVIEWER))
                <form action="{{ route('request.reviewer') }}" method="post">
                    {{ csrf_field() }}
                    <input type="submit" value="Request menjadi reviewer" class="btn btn-primary"/>
                </form>
            @elseif(Auth::user()->requestingHakAkses(\PMW\Models\HakAkses::REVIEWER))
                <p>Anda sedang menunggu persetujuan untuk menjadi reviewer</p>
            @endif

            <div class="alert alert-warning">
                Anda perlu menunggu sampai admin menerima <i>request</i> anda
            </div>
        </div>
    </div>

@endsection
