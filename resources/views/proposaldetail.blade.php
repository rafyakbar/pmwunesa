@extends('layouts.app')

@section('title')
    Detail Proposal
@endsection

@section('brand')
    Proposal {{ $proposal->judul}}
@endsection

@section('content')

    <div class="row">
        <div class="col-lg-5">
            @include('part.proposal.informasi_umum',[
                'proposal' => $proposal
            ])
            <div class="card">
                <div class="card-header">
                    <h5>Unduh Berkas</h5>
                </div>
                <div class="card-content">
                    <a href="#" class="btn btn-primary"
                       onclick="event.preventDefault();document.getElementById('unduh-proposal').submit();">Unduh
                        Proposal</a>
                    @if($proposal->punyaProposalFinal())
                        <a href="#" class="btn btn-primary">Unduh Proposal Final</a>
                    @endif
                    @if(!Auth::user()->isMahasiswa())
                        <a href="#" class="btn btn-primary">Unduh Laporan Kemajuan</a>
                        <a href="#" class="btn btn-primary">Unduh Laporan Akhir</a>
                    @endif
                    <form id="unduh-proposal" action="{{ route('unduh.proposal') }}" method="post"
                          style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-7">
            <div class="card">
                <div class="card-header">
                    <h4>Deskripsi Proposal</h4>
                </div>

                <div class="card-content">
                    <div class="row">
                        <div class="col-lg-3">
                            <strong>Keyword</strong>
                        </div>
                        <div class="col-lg-9">
                            {{ str_replace('|', ', ', $proposal->keyword) }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3">
                            <strong>Abstrak</strong>
                        </div>
                        <div class="col-lg-9">
                            {!! $proposal->abstrak !!}
                        </div>
                    </div>
                </div>
            </div>

            @include('part.proposal.informasi_penilaian')
        </div>
    </div>

@endsection
