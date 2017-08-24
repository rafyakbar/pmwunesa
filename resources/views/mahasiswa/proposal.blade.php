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
                    @if(!Auth::user()->isKetua())
                        <p class="alert alert-primary">Ketua tim anda belum mengunggah proposal</p>
                    @else
                        <p class="alert alert-primary">Anda belum mengunggah proposal</p>
                    @endif
                    @if(Auth::user()->isKetua())
                        @if(Auth::user()->mahasiswa()->bisaUnggahProposal())
                            <a href="{{ route('unggah.proposal') }}" class="btn btn-primary">Unggah Proposal</a>
                        @else
                            <p class="alert alert-danger">Anda sudah tidak bisa mengunggah proposal.</p>
                        @endif
                    @endif
                </div>
            </div>
        @endif
    @endif

@endsection
