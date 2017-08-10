@extends('layouts.app')

@section('content')

    @if(Auth::user()->mahasiswa()->punyaProposal())
        Timmu telah mengunggah proposal. <a href="{{ route('unduh.proposal') }}" onclick="event.preventDefault();document.getElementById('unduh-proposal').submit();">Unduh Proposal</a>
    @else
        @if(Auth::user()->isKetua())
            Anda belum memiliki proposal,
            <a href="{{ route('unggah.proposal') }}">Tambahkan proposal</a>
        @endif
    @endif

    <form id="unduh-proposal" action="{{ route('unduh.proposal') }}" method="post" style="display: none;">
        {{ csrf_field() }}
    </form>

    <div class="row">
        <div class="col-lg-6">
            <div class="panel-default">
                <div class="panel-heading">
                    <h3>Proposal</h3>
                </div>
                <div class="panel-body" style="background-color: #CCCCCC">
                    <form action="" method="">
                        <div class="form-group">
                            <label>Judul</label>
                            <input class="form-control" type="text" name="judul" placeholder="Judul">
                        </div>
                        <div class="form-group">
                            <label>Jenis Usaha</label>
                            <input class="form-control" type="text" name="jenis" placeholder="Jenis">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="panel-default">
                <div class="panel-heading">
                    <h3>Proposal</h3>
                </div>
                <div class="panel-body" style="background-color: #CCCCCC">
                    <form action="" method="">
                        <div class="form-group">
                            <label>Judul</label>
                            <input class="form-control" type="text" name="judul" placeholder="Judul">
                        </div>
                        <div class="form-group">
                            <label>Jenis Usaha</label>
                            <input class="form-control" type="text" name="jenis" placeholder="Jenis">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
