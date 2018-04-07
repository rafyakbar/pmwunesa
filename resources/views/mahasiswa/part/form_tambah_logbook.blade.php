@if(Session::has('message'))
    <p class="alert alert-success alert-dismissible">
        <button style="top:0;right:0" type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
        <span>{{ Session::get('message') }}</span>
    </p>
@endif

<div class="card" style="{{ $errors->count() == 0 ? 'display:none' : '' }}"
     id="wrapper-form-logbook">

    <div class="card-header" data-background-color="red">
        <h5>Tambah Logbook</h5>
    </div>

    <div class="card-content">
        <form action="{{ route('tambah.logbook') }}" method="post">

            {{ csrf_field() }}

            {{ method_field('put') }}

            <input type="hidden" name="tanggal" value="{{ Carbon\Carbon::today() }}"/>

            <div class="row">
                <div class="col-lg-2">
                    <label>Hari dan Tanggal</label>
                </div>
                <div class="col-lg-5">
                    <p>{{ Carbon\Carbon::today()->formatLocalized('%A, %d %B %Y') }}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-2">
                    <label for="biaya">Biaya</label>
                </div>
                <div class="col-lg-5">
                    <input class="form-control" type="number" name="biaya" placeholder="biaya"
                           value="{{ old('biaya') }}" required/>
                    @if($errors->has('biaya'))
                        <p class="alert alert-danger">{{ $errors->first('biaya') }}</p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-lg-2">
                    <label for="catatan">Catatan</label>
                </div>
                <div class="col-lg-5">
                                <textarea name="catatan" class="form-control"
                                          placeholder="Catatan" required>{{ old('catatan') }}</textarea>
                    @if($errors->has('catatan'))
                        <p class="alert alert-danger">{{ $errors->first('catatan') }}</p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-lg-2">
                </div>
                <div class="col-lg-5">
                    <div class="btn-group">
                        <button type="submit" class="btn btn-success">Simpan</button>
                        <button type="button" class="btn btn-primary" id="batal-tambah-logbook">Batal
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>