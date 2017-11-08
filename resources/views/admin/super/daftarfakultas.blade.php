@extends('layouts.app')

@section('brand')
    Fakultas
@endsection

@section('content')
    <div class="card">
        <div class="card-header" data-background-color="purple">
            <h4 class="title">Fakultas</h4>
            <p class="category">Daftar fakultas</p>
        </div>
        <div class="card-content table-responsive">
            <table class="table">
                <thead class="text-primary">
                <tr>
                    <th>Nama</th>
                    <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                @foreach($fakultas as $item)
                    <tr>
                        <td class="col-xs-10">
                            <form action="{{ route('edit.fakultas') }}" method="post" class="col-xs-11">
                                {{ csrf_field() }}
                                {{ method_field('put') }}
                                <input type="hidden" name="id" value="{{ $item->id }}">
                                <span class="material-input"></span>
                                <div class="input-group">
                                    <input type="text" name="nama" value="{{ $item->nama }}" class="form-control" style="border: 1px">
                                    <span class="input-group-btn">
                                        <button type="submit" class="btn btn-white btn-just-icon" title="simpan">
                                            <i class="material-icons">save</i>
                                        </button>
                                    </span>
                                </div>
                            </form>
                        </td>
                        <td class="col-xs-2">
                            <form action="{{ route('hapus.fakultas') }}" method="post">
                                {{ csrf_field() }}
                                {{ method_field('put') }}
                                <input type="hidden" name="id" value="{{ $item->id }}">
                                <input type="submit" name="submit" value="Hapus" class="btn btn-danger btn-round btn-sm">
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <form action="{{ route('tambah.fakultas') }}" method="post">
                        {{ csrf_field() }}
                        {{ method_field('put') }}
                        <div class="row" style="padding-left: 5%; padding-right: 5%">
                            <div class="col-md-10">
                                <textarea name="nama" placeholder="Pisahkan dengan enter untuk menambahkan banyak fakultas" class="form-control"></textarea>
                            </div>
                            <div class="col-md-2">
                                <input type="submit" name="submit" value="tambah" class="btn btn-round btn-sm">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection