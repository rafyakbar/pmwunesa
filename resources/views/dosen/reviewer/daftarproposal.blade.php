@extends('layouts.app')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/table.css') }}"/>
@endpush

@section('title')
    Daftar Proposal
@endsection

@section('brand')
    Daftar Proposal
@endsection

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
                    <table class="table table-hover table-expand">
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
                                <tr data-proposal="{{ $proposal->id }}">
                                    <td><a target="_blank" href="{{ route('lihat.proposal',[ 'id' => $proposal->id]) }}"> <strong>{{ $proposal->judul }}</strong><sup><i class="fa fa-external-link"></i></sup></a></td>
                                    <td class="hidden-sm hidden-xs">{{ $proposal->jenis_usaha }}</td>
                                    <td class="hidden-sm hidden-xs">{{ Dana::format($proposal->usulan_dana) }}</td>
                                    <td>{{ $proposal->pivot->tahap }}</td>
                                    <td class="hidden-sm hidden-xs">{{ $proposal->sudahDinilaiOleh(Auth::user()->id,$proposal->pivot->tahap) ? 'Sudah dinilai' : 'Belum dinilai' }}</td>
                                    <td class="hidden-sm hidden-xs">
                                        <div class="btn-group btn-group-sm">
                                            @if($proposal->sudahDinilaiOleh(Auth::user()->id,$proposal->pivot->tahap))
                                            <a href="{{ route('lihat.nilai.review',['id' => $proposal->pivot->id]) }}"class="btn btn-primary">Lihat Nilai</a>
                                            <a href="{{ route('edit.nilai.review',['id' => $proposal->pivot->id]) }}"class="btn btn-primary">Edit</a>
                                        @else
                                            <a href="{{ route('tambah.nilai.review',['id' => $proposal->pivot->id]) }}"class="btn btn-primary">Beri Nilai</a>
                                        @endif
                                        </div>
                                    </td>
                                </tr>
                                <tr class="expand">
                                    <td colspan="6">
                                        hello
                                    </td>
                                </tr>
                                @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('js')
    <script>
        $('.table-expand').find('tbody').find('tr:not(".expand")').click(function(e){
            $(this).prevUntil('.table-expand','.expand').hide()
            $(this).next().nextUntil('.table-expand','.expand').hide()
            $(this).next().toggle()

            var elem = $(this).next()

            $.ajax({
                url : "{{ route('data.proposal.ajax') }}",
                type : 'get',
                data : 'id=' + $(this).attr('data-proposal'),
                success : function(response){
                    createExpandedTable(response, elem)
                }
            })
        })

        /**
         * Membuat data expand pada tabel ketika sebuah baris pada tabel di klik
         * @param  json data
         * @return void
         */
        var createExpandedTable = function (data, elem){
            elem.html('<td colspan="6">' + data + '</td>')
        }
    </script>
@endpush
