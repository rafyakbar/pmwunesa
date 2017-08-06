@extends('layouts.app')

@section('content')
    @if(is_null(Auth::user()->proposal()->direktori_final))
        Tim anda belum mengunggah proposal final.
        @if(Auth::user()->isKetua())
            <a href="{{ route('unggah.proposal.final') }}">Unggah proposal final</a>
        @endif
    @else
        Anda telah mengunggah proposal final. <a href="{{ route('unduh.proposal.final') }}" onclick="event.preventDefault(); document.getElementById('unduh-proposal').submit();">Unduh disini</a>

        <form id="unduh-proposal" action="{{ route('unduh.proposal') }}" method="post" style="display: none;">
            {{ csrf_field() }}
        </form>
    @endif
@endsection