<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <h5 class="title">
                    Laporan Kemajuan
                </h5>
            </div>

            <div class="card-content">
                @if(is_null(Auth::user()->mahasiswa()->proposal()->laporanKemajuan()))
                    <p class="alert alert-primary">Tim anda belum mengunggah laporan kemajuan</p>

                    @if(Auth::user()->isKetua())
                        <h4>Unggah Laporan Kemajuan</h4>

                        <form class="upload" action="{{ route('unggah.laporan.kemajuan') }}" method="post"
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
                    <p class="alert alert-primary">Tim anda telah mengunggah laporan kemajuan</p>

                    <h6>Keterangan</h6>
                    <p>{{ Auth::user()->mahasiswa()->proposal()->laporanKemajuan()->keterangan }}</p>
                    <form action="{{ route('unduh.laporan.kemajuan') }}" method="post">
                        {{ csrf_field() }}
                        <button class="btn btn-primary">Unduh Laporan</button>
                    </form>
                @endif
            </div>
        </div>
    </div>

    {{-- Laporan Akhir  --}}
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <h5 class="title">
                    Laporan Akhir
                </h5>
            </div>

            <div class="card-content">
                @if(is_null(Auth::user()->mahasiswa()->proposal()->laporanAkhir()))
                    <p class="alert alert-primary">Tim anda belum mengunggah laporan akhir</p>

                    @if(Auth::user()->isKetua())
                        <h4>Unggah Laporan Akhir</h4>

                        <form class="upload" action="{{ route('unggah.laporan.akhir') }}" method="post" enctype="multipart/form-data">

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
                    <p class="alert alert-primary">Tim anda telah mengunggah laporan akhir</p>

                    <h6>Keterangan</h6>
                    <p>{{ Auth::user()->mahasiswa()->proposal()->laporanAkhir()->keterangan }}</p>
                    <form action="{{ route('unduh.laporan.akhir') }}" method="post">
                        {{ csrf_field() }}
                        <button class="btn btn-primary">Unduh Laporan</button>
                    </form>
                @endif
            </div>
        </div>
    </div>
</div>

@push('js')
    <script src="{{ asset('js/jquery.form.js') }}"></script>
    <script>
        $(function () {

            var form;

            $('button[type="submit"]').click(function () {
                $('button[type="submit"]').attr('disabled', 'disabled')
                form = $(this).parent().parent().parent()
                form.submit()
            })

            $('form.upload').ajaxForm({
                beforeSend: function () {
                    form.find('.progress').show()
                },
                uploadProgress: function (event, position, total, percentComplete) {
                    form.find('.progress-bar').width(percentComplete + "%")
                },
                success: function (response) {
                    swal({
                        type: response.type,
                        title: (response.type == 'error') ? 'Gagal !' : 'Berhasil !',
                        text: response.message
                    }, function () {
                        window.location.reload()
                    })
                },
                error: function (response) {
                    swal({
                        type: 'error',
                        title: 'Gagal !',
                        text: 'Terjadi kesalahan sistem, cobalah beberapa saat lagi !'
                    }, function () {
                        $('button[type="submit"]').removeAttr('disabled')
                        $('.progress').hide()
                    })
                }
            })
        })
    </script>
@endpush