@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h4>Review Tahap 1</h4>
                </div>
                <div class="card-content">
                    @if($review['tahap1']->count() > 0)
                        @foreach($review['tahap1']->get() as $hasil)
                            <div class="alert alert-primary">{!! $hasil->komentar !!}</div>
                        @endforeach
                    @else
                        <p class="alert-warning alert">Proposal anda belum dinilai</p>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h4>Review Tahap 2</h4>
                </div>
                <div class="card-content">
                    @if($proposal->lolos(1))
                        @if($review['tahap2']->count() > 0)
                            {{ $review['tahap2']->get() }}
                        @else
                            <p class="alert-warning alert">Proposal anda belum dinilai</p>
                        @endif
                    @else
                        <p class="alert alert-warning">Proposal anda tidak lolos tahap 1</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection