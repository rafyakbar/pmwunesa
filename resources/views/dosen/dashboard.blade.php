@extends('layouts.app')

@section('content')
    @if($bimbingan->count() > 0)
        Anda telah menjadi pembimbing dari mahasiswa berikut :
        <ul>
        @foreach($bimbingan->cursor() as $proposal)
            <li>{{ \PMW\Models\Proposal::find($proposal->id)->ketua()->nama }}</li>
        @endforeach
        </ul>
    @endif

    @if($undangan->count() > 0)
        Anda diminta untuk menjadi pembimbing dari mahasiswa berikut :<br/>
        <ul>
            @foreach($undangan->cursor() as $proposal)
                <li>{{ \PMW\Models\Proposal::find($proposal->id)->ketua()->nama }}
                    <form action="{{ route('terima.undangan.dosen') }}" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="proposal" value="{{ $proposal->id }}">
                        <input type="submit" value="Terima"/>
                    </form>
                </li>
            @endforeach
        </ul>
    @endif

    @if(Auth::user()->isDosenPembimbing()&&
        !Auth::user()->isReviewer() &&
        !Auth::user()->requestingHakAkses(\PMW\Models\HakAkses::REVIEWER))
        <form action="{{ route('request.reviewer') }}" method="post">
            {{ csrf_field() }}
            <input type="hidden" name="hak_akses" value="{{ \PMW\Models\HakAkses::where('nama',\PMW\User::REVIEWER)->first()->id }}">
            <input type="submit" value="Request menjadi reviewer"/>
        </form>
    @endif

    @if(Auth::user()->requestingHakAkses(\PMW\Models\HakAkses::REVIEWER))
        Anda sedang menunggu persetujuan untuk menjadi reviewer
    @endif
@endsection
