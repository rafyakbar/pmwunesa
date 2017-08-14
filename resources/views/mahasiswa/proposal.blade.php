@extends('layouts.app')

@section('brand',"Proposal")

@section('content')

    {{-- Jika user belum punya tim --}}
    @if(!Auth::user()->mahasiswa()->punyaTim())
    <div class="card">
        <div class="card-content">
            <p class="alert alert-primary">Anda belum memiliki tim</p>
        </div>
    </div>
@else
    @if(!Auth::user()->mahasiswa()->punyaProposal())
        <div class="card">
            <div class="card-content">
                <p class="alert alert-primary">Tim anda belum mengunggah proposal</p>
                @if(Auth::user()->isKetua())
                    <a href="{{ route('unggah.proposal') }}" class="btn btn-primary">Unggah Proposal</a>
                @endif
            </div>
        </div>
    @endif
    @endif

    {{-- <div class="row">
        <div class="col-lg-6">
            <div class="panel-default">
                <div class="panel-heading">
                    <h3>Proposal</h3>
                </div>
                <div class="panel-body">
                    <form action="" method="" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Judul</label>
                            <input class="form-control" type="text" name="judul" placeholder="Judul">
                        </div>
                        <div class="form-group">
                            <label>Jenis Usaha</label>
                            <input class="form-control" type="text" name="jenis" placeholder="Jenis">
                        </div>
                        <div class="form-group">
                            <label>File Proposal</label><br>
                            <button class="btn btn-primary">Unggah Proposal <input type="file" name="file"></button>
                            <button class="btn btn-warning">Lihat Proposal</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="panel-default">
                <div class="panel-heading">
                    <h3>Proposal Final</h3>
                </div>
                <div class="panel-body">
                    <form action="" method="">
                        <div class="form-group">
                            <label>Judul</label>
                            <input class="form-control" type="text" name="judul" placeholder="Judul">
                        </div>
                        <div class="form-group">
                            <label>Jenis Usaha</label>
                            <input class="form-control" type="text" name="jenis" placeholder="Jenis">
                        </div>
                        <div class="form-group">
                            <label>File Proposal</label><br>
                            <button class="btn btn-primary">Unggah Proposal <input type="file" name="file"></button>
                            <button class="btn btn-warning">Lihat Proposal</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> --}}

@endsection
