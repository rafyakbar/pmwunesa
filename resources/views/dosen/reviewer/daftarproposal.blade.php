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
        <div class="card-header" data-background-color="purple">
            <div class="nav-tabs-navigation">
                <div class="nav-tabs-wrapper">
                    <ul class="nav nav-tabs" data-tabs="tabs">
                        <li {{ $tahap == 1 ? 'class=active' : '' }}>
                            <a style="color:#fff !important;" href="{{ route('daftar.proposal.reviewer',[ 'tahap' => 1]) }}" data-toggle="tab"
                               aria-expanded="true"
                               onclick="window.location.href = '{{ route('daftar.proposal.reviewer',[ 'tahap' => 1]) }}'">
                                Tahap 1
                                <div class="ripple-container"></div>
                            </a>
                        </li>
                        <li {{ $tahap == 2 ? 'class=active' : '' }}>
                            <a style="color:#fff !important;" href="{{ route('daftar.proposal.reviewer',[ 'tahap' => 2]) }}" data-toggle="tab"
                               aria-expanded="true"
                               onclick="window.location.href = '{{ route('daftar.proposal.reviewer',[ 'tahap' => 2]) }}'">
                                Tahap 2
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
                    @if(!\PMW\Models\Pengaturan::melewatiBatasPenilaian($tahap))
                    <p style="margin: 10px" class="alert alert-warning">
                        Batas penilaian tahap {{ $tahap }} adalah pada {{ \Carbon\Carbon::parse(\PMW\Models\Pengaturan::batasPenilaian($tahap))->formatLocalized('%A %d %B %Y') }}
                    </p>
                        @else
                        <p style="margin: 10px" class="alert alert-danger">
                            Anda sudah tidak bisa melakukan penilaian untuk tahap {{ $tahap }}
                        </p>
                    @endif

                    <div style="margin:10px;">
                        <ul class="nav nav-pills">
                            <li role="presentation" {{ (is_null(request()->get('sudahdinilai')) || !request()->get('sudahdinilai')) ? 'class=active' : '' }}><a href="{{ route('daftar.proposal.reviewer',['sudahdinilai' => 0,'tahap' => $tahap]) }}">Belum dinilai</a></li>
                            <li role="presentation" {{ request()->get('sudahdinilai') ? 'class=active' : '' }}><a href="{{ route('daftar.proposal.reviewer',['sudahdinilai' => 1, 'tahap' => $tahap]) }}">Sudah dinilai</a></li>
                        </ul>
                    </div>

                    @if(count($daftarproposal) > 0)
                        <table class="table table-hover table-expand">
                            <thead class="text-warning">
                            <tr>
                                <th>Judul proposal</th>
                                <th class="hidden-sm hidden-xs">Jenis produk</th>
                                <th class="hidden-sm hidden-xs">Usulan dana</th>
                                <th class="hidden-sm hidden-xs">Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($daftarproposal as $proposal)
                                <tr data-proposal="{{ $proposal->id }}">
                                    <td><a target="_blank"
                                           href="{{ route('lihat.proposal',[ 'id' => $proposal->id]) }}">
                                            <strong>{{ $proposal->judul }}</strong><sup><i
                                                        class="fa fa-external-link"></i></sup></a>
                                    </td>
                                    <td class="hidden-sm hidden-xs">{{ $proposal->jenis_usaha }}</td>
                                    <td class="hidden-sm hidden-xs">{{ Dana::format($proposal->usulan_dana) }}</td>
                                    <td class="hidden-sm hidden-xs">
                                        <div class="btn-group btn-group-sm">
                                            @if($proposal->sudahDinilaiOleh(Auth::user()->id,$proposal->pivot->tahap))
                                                <a href="{{ route('lihat.nilai.review',['id' => $proposal->pivot->id]) }}"
                                                   class="btn btn-primary">Lihat Nilai</a>
                                                @if(!\PMW\Models\Pengaturan::melewatiBatasPenilaian($tahap))
                                                    <a href="{{ route('edit.nilai.review',['id' => $proposal->pivot->id]) }}"
                                                       class="btn btn-primary">Edit</a>
                                                @endif
                                            @else
                                                @if(!\PMW\Models\Pengaturan::melewatiBatasPenilaian($tahap))
                                                    <a href="{{ route('tambah.nilai.review',['id' => $proposal->pivot->id]) }}"
                                                       class="btn btn-primary">Beri Nilai</a>
                                                @endif
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                <tr class="expand">
                                    <td colspan="6">
                                        Sedang memuat...
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        <div style="padding-left: 10px;">
                            {{ $daftarproposal->links() }}
                        </div>
                    @else
                        <p style="margin:10px;" class="alert alert-primary">Tidak ada proposal</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection

@push('js')
    <script>
        $('.table-expand').find('tbody').find('tr:not(".expand")').click(function (e) {
            $(this).prevUntil('.table-expand', '.expand').hide()
            $(this).next().nextUntil('.table-expand', '.expand').hide()
            $(this).next().toggle()

            var elem = $(this).next()

            $.ajax({
                url: "{{ route('data.proposal.ajax') }}",
                type: 'get',
                data: 'id=' + $(this).attr('data-proposal'),
                success: function (response) {
                    createExpandedTable(response, elem)
                }
            })
        })

        /**
         * Membuat data expand pada tabel ketika sebuah baris pada tabel di klik
         * @param  json data
         * @return void
         */
        var createExpandedTable = function (data, elem) {
            elem.html('<td colspan="6">' + data + '</td>')
        }
    </script>
@endpush
