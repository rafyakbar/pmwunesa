<div class="card">
    <div class="card-header" data-background-color="red">
        <h5>Daftar Logbook</h5>
    </div>
    <div class="card-content table-responsive">
        @if(count($daftarlogbook) > 0)
            <table class="table table-striped">
                <thead class="text-danger">
                <tr>
                    <th>Hari dan Tanggal</th>
                    <th>Catatan</th>
                    <th>Biaya</th>
                    @if(Auth::user()->isKetua())
                        <th>Aksi</th>
                    @endif
                </tr>
                </thead>
                <tbody>
                @foreach ($daftarlogbook as $index => $logbook)
                    <tr>
                        <td>{{ Carbon\Carbon::parse($logbook->tanggal)->formatLocalized('%A, %d %B %Y') }}</td>
                        <td>{{ $logbook->catatan }}</td>
                        <td>{{ Dana::format($logbook->biaya) }}</td>
                        @if(Auth::user()->isKetua())
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('halaman.edit.logbook',['id' => $logbook->id]) }}"
                                       class="btn btn-primary">Edit</a>
                                    <a href="{{ route('hapus.logbook') }}"
                                       class="btn btn-danger hapus-logbook" data-id="{{ $logbook->id }}">Hapus</a>
                                </div>
                            </td>
                        @endif
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $daftarlogbook->links() }}
        @else
            <p class="alert alert-warning">Tidak ada logbook</p>
        @endif

    </div>
</div>
