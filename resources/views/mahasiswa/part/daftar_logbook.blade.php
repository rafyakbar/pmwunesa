<div class="card">
            <div class="card-header" data-background-color="red">
                <h5>Daftar Logbook</h5>
            </div>
            <div class="card-content table-responsive">
                <table class="table table-striped">
                    <thead class="text-danger">
                    <tr>
                        <th>Hari dan Tanggal</th>
                        <th>Catatan</th>
                        <th>Biaya</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach (Auth::user()->mahasiswa()->proposal()->logbook()->cursor() as $index => $logbook)
                        <tr>
                            <td>{{ Carbon\Carbon::parse($logbook->created_at)->formatLocalized('%A, %d %B %Y') }}</td>
                            <td>{{ $logbook->catatan }}</td>
                            <td>{{ Dana::format($logbook->biaya) }}</td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('halaman.edit.logbook',['id' => $logbook->id]) }}"
                                       class="btn btn-primary">Edit</a>
                                    <a href="{{ route('hapus.logbook') }}"
                                       class="btn btn-danger hapus-logbook" data-id="{{ $logbook->id }}">Hapus</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
