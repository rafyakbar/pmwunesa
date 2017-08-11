@extends('layouts.app')

@push('js')
    <link rel="stylesheet" href="{{ asset('css/table.css') }}"/>
@endpush

@section('content')

    <div class="card card-nav-tabs">
        <div class="card-header" data-background-color="orange">
            <div class="nav-tabs-navigation">
                <div class="nav-tabs-wrapper">
                    <ul class="nav nav-tabs" data-tabs="tabs">
                        <li class="active">
                            <a href="#daftar" data-toggle="tab" aria-expanded="true">
                                <i class="material-icons">bug_report</i>
                                Sudah Dinilai
                                <div class="ripple-container"></div>
                            </a>
                        </li>
                        <li class="">
                            <a href="#belumdinilai" data-toggle="tab" aria-expanded="false">
                                <i class="material-icons">code</i>
                                Belum Dinilai
                                <div class="ripple-container"></div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="card-content no-padding">
            <div class="tab-content">
                <div class="tab-pane active" id="daftar">
                    <table class="table table-hover">
                        <thead class="text-warning">
                            <tr>
                                <th>Judul proposal</th>
                                <th class="hidden-sm hidden-xs">Jenis produk</th>
                                <th class="hidden-sm hidden-xs">Usulan dana</th>
                                <th>Tahap</th>
                                <th class="hidden-sm hidden-xs">Status Nilai</th>
                                <th class="hidden-sm hidden-xs">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($daftarproposal->get() as $proposal)
                                <tr>
                                    <td><a target="_blank" href="{{ route('lihat.proposal',[ 'id' => $proposal->id]) }}"> <strong>{{ $proposal->judul }}</strong><sup><i class="fa fa-external-link"></i></sup></a></td>
                                    <td class="hidden-sm hidden-xs">{{ $proposal->jenis_usaha }}</td>
                                    <td class="hidden-sm hidden-xs">{{ $proposal->usulan_dana }}</td>
                                    <td>{{ $proposal->pivot->tahap }}</td>
                                    <td class="hidden-sm hidden-xs">{{ $proposal->sudahDinilaiOleh(Auth::user()->id,$proposal->pivot->tahap) ? 'Sudah dinilai' : 'Belum dinilai' }}</td>
                                    <td class="hidden-sm hidden-xs">
                                        <div class="btn-group btn-group-sm">
                                            <a href="{{ route('lihat.nilai.review',['id' => $proposal->pivot->id]) }}"class="btn btn-primary">Lihat Nilai</a>
                                            <a href="{{ route('edit.nilai.review',['id' => $proposal->pivot->id]) }}"class="btn btn-primary">Edit</a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane" id="messages">
                    <table class="table">
                        <tbody>
                        <tr>
                            <td>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="optionsCheckboxes" checked=""><span
                                                class="checkbox-material"><span class="check"></span></span>
                                    </label>
                                </div>
                            </td>
                            <td>Flooded: One year later, assessing what was lost and what was found when a ravaging rain
                                swept through metro Detroit
                            </td>
                            <td class="td-actions text-right">
                                <button type="button" rel="tooltip" title="" class="btn btn-primary btn-simple btn-xs"
                                        data-original-title="Edit Task">
                                    <i class="material-icons">edit</i>
                                </button>
                                <button type="button" rel="tooltip" title="" class="btn btn-danger btn-simple btn-xs"
                                        data-original-title="Remove">
                                    <i class="material-icons">close</i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="optionsCheckboxes"><span class="checkbox-material"><span
                                                    class="check"></span></span>
                                    </label>
                                </div>
                            </td>
                            <td>Sign contract for "What are conference organizers afraid of?"</td>
                            <td class="td-actions text-right">
                                <button type="button" rel="tooltip" title="" class="btn btn-primary btn-simple btn-xs"
                                        data-original-title="Edit Task">
                                    <i class="material-icons">edit</i>
                                </button>
                                <button type="button" rel="tooltip" title="" class="btn btn-danger btn-simple btn-xs"
                                        data-original-title="Remove">
                                    <i class="material-icons">close</i>
                                </button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
