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
                    <th>No</th>
                    <th>Nama</th>
                    <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                @foreach($fakultas as $item)
                    <tr>
                        <td>{{ ++$c }}</td>
                        <td>
                            <form action="{{ route('edit.fakultas') }}" method="post" id="simpan-{{ $item->id }}">
                                {{ csrf_field() }}
                                {{ method_field('put') }}
                                <input type="hidden" name="id" value="{{ $item->id }}">
                                <span class="material-input"></span>
                                <div class="input-group">
                                    <input type="text" name="nama" value="{{ $item->nama }}" class="form-control" style="border: 1px">
                                </div>
                            </form>
                        </td>
                        <td>
                            <div class="btn-group">
                                <a class="btn btn-success btn-sm" onclick="event.preventDefault(); document.getElementById('simpan-{{ $item->id }}').submit()">Simpan</a>
                                <a class="btn btn-danger btn-sm" onclick="event.preventDefault(); document.getElementById('hapus-{{ $item->id }}').submit()">Hapus</a>
                            </div>
                        </td>
                    </tr>
                    <form action="{{ route('hapus.fakultas') }}" method="post" id="hapus-{{ $item->id  }}">
                        {{ csrf_field() }}
                        {{ method_field('put') }}
                        <input type="hidden" name="id" value="{{ $item->id }}">
                    </form>
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