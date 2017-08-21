@if(is_null(Auth::user()->mahasiswa()->proposal()->laporan($type)))
    <p class="alert alert-primary">Tim anda belum mengunggah laporan kemajuan</p>

    @if(Auth::user()->isKetua())
        <h4>Unggah Laporan {{ $type === 'kemajuan' ? 'Kemajuan' : 'Akhir' }}</h4>

        <form class="upload" action="{{ $type === 'kemajuan' ? route('unggah.laporan.kemajuan') : route('unggah.laporan.akhir') }}" method="post"
              enctype="multipart/form-data">

            {{ csrf_field() }}

            {{ method_field('put') }}

            <label>Keterangan Tambahan</label>

            <textarea name="keterangan" class="form-control" placeholder="Keterangan"></textarea>

            <div class="form-group">
                <div class="btn-group">
                    <button class="btn btn-primary">Pilih Berkas Laporan <input type="file"
                                                                                name="berkas"></button>
                    <button class="btn btn-success" type="submit">Unggah</button>
                </div>
            </div>

            <div class="progress" style="display:none" id="progress">
                <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar"
                     aria-valuemin="0">
                    <span class="sr-only"></span>
                </div>
            </div>

        </form>
    @endif
@else
    <p class="alert alert-primary">Tim anda telah mengunggah laporan {{ $type === 'kemajuan' ? 'kemajuan' : 'akhir' }}</p>

    <div id="info-{{ $type === 'kemajuan' ? 'kemajuan' : 'akhir' }}">
        <h6>Keterangan</h6>
        <p>{{ Auth::user()->mahasiswa()->proposal()->laporan($type)->keterangan }}</p>
        <form action="{{ $type === 'kemajuan' ? route('unduh.laporan.kemajuan') : route('unduh.laporan.akhir') }}" method="post">
            {{ csrf_field() }}
            <button class="btn btn-primary">Unduh Laporan</button>
        </form>
        <button class="btn btn-warning edit-laporan" data-target="#form-{{ $type === 'kemajuan' ? 'kemajuan' : 'akhir' }}">Edit Laporan</button>
    </div>

    <form id="form-{{ $type === 'kemajuan' ? 'kemajuan' : 'akhir' }}" class="upload" action="{{ $type === 'kemajuan' ? route('unggah.laporan.kemajuan') : route('unggah.laporan.akhir') }}" method="post" style="display: none"
          enctype="multipart/form-data">

        {{ csrf_field() }}

        {{ method_field('put') }}

        <label>Keterangan Tambahan</label>

        <textarea name="keterangan" class="form-control" placeholder="Keterangan">{{ Auth::user()->mahasiswa()->proposal()->laporan($type)->keterangan }}</textarea>

        <div class="form-group">
            <div class="btn-group">
                <button class="btn btn-primary">Pilih Berkas Laporan <input type="file"
                                                                            name="berkas"></button>
                <button class="btn btn-success" type="submit">Unggah</button>
            </div>
        </div>

        <div class="progress" style="display:none" id="progress">
            <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar"
                 aria-valuemin="0">
                <span class="sr-only"></span>
            </div>
        </div>

    </form>
@endif