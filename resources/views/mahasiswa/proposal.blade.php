@extends('layouts.app')

@section('content')
    @if(!is_null(Auth::user()->proposal()->judul))
        Timmu telah mengunggah proposal. <a href="{{ route('unduh.proposal') }}" onclick="event.preventDefault();
                            document.getElementById('unduh-proposal').submit();">Unduh Proposal</a>
    @else
        @if(Auth::user()->isKetua())
            Anda belum memiliki proposal,
            <a href="{{ route('unggah.proposal') }}">Tambahkan proposal</a>
        @endif
    @endif

    <form id="unduh-proposal" action="{{ route('unduh.proposal') }}" method="post" style="display: none;">
        {{ csrf_field() }}
    </form>
@endsection
