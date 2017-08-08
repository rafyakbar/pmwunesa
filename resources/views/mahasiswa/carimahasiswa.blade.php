@extends('layouts.app') @section('brand', "Cari Anggota") @section('content')
<div class="row">
    <div class="col-lg-6 col-lg-offset-6">
        <div class="form-group card" style="width: 500px;">
            <form class="card-content" action="{{ route('cari') }}" method="get">

                {{ csrf_field() }} {{ method_field('put') }}

                <input class="form-control" type="text" name="cari" placeholder="Cari Mahasiswa" />

                <button class="btn btn-primary btn-sm" type="submit" style="float: right">Cari</button>

            </form>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-header" data-background-color="blue">
        <h4>Hasil Pencarian</h4>
    </div>
    <div class="card-content table-responsive">

    </div>
</div>
@endsection