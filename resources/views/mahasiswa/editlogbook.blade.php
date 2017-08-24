@extends('layouts.app')

@section('title','Edit Logbook')

@section('brand','Edit Logbook')

@section('content')
    <div class="card" id="wrapper-form-logbook">
        <div class="card-content">
            <h5>Edit Logbook</h5>
            <form action="{{ route('edit.logbook') }}" method="post">

                {{ csrf_field() }}

                {{ method_field('patch') }}

                <input type="hidden" name="id" value="{{ $logbook->id }}">

                <div class="row">
                    <div class="col-lg-2">
                        <label>Tanggal<label>
                        </div>
                        <div class="col-lg-5">
                            <p>{{ Carbon\Carbon::today()->formatLocalized('%A %d %B %Y') }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-2">
                            <label for="biaya">Biaya<label>
                            </div>
                            <div class="col-lg-5">
                                <input class="form-control" type="number" name="biaya" placeholder="biaya" value="{{ $errors->has('biaya') ? old('biaya') : $logbook->biaya }}"/>
                                @if($errors->has('biaya'))
                                    <p class="alert alert-danger">{{ $errors->first('biaya') }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-2">
                                <label for="catatan">Catatan<label>
                                </div>
                                <div class="col-lg-5">
                                    <textarea name="catatan" class="form-control" placeholder="Catatan">{{ $errors->has('catatan') ? old('catatan') : $logbook->catatan }}</textarea>
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
                                        <a href="{{ route('logbook') }}" type="button" class="btn btn-primary">Batal</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            @endsection
