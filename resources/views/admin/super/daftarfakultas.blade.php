@extends('layouts.app')

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
                    <th>ID</th>
                    <th>Nama</th>
                    <th colspan="2">Aksi</th>
                </tr>
                </thead>
                <tbody>
                @foreach($fakultas as $item)
                    <tr>
                        <td class="col-xs-1">{{ $item->id }}</td>
                        <td class="col-xs-7">
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
                                <input type="submit" name="submit" value="Hapus" class="btn btn-danger">
                            </form>
                        </td>
                        <td class="col-xs-2">
                            <button type="button" data-toggle="modal" data-target="#myModal" class="btn">Lihat Jurusan</button>
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
                        <div class="row">
                            <div class="col-md-10" style="padding-left: 5%">
                                <textarea name="nama" placeholder="Pisahkan dengan enter untuk menambahkan banyak fakultas" class="form-control"></textarea>
                            </div>
                            <div class="col-md-2">
                                <input type="submit" name="submit" value="tambah" class="btn">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



    {{--jurusan--}}
    <h3>Daftar Jurusan</h3>
    <ul>
        @foreach($jurusan as $item)
            <li>
                id={{ $item->id }} |
                id_fakultas={{ $item->id_fakultas }}
                <form action="{{ route('edit.jurusan') }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('put') }}
                    <input type="hidden" name="id" value="{{ $item->id }}">
                    <input type="text" name="nama" value="{{ $item->nama }}">
                    <input type="submit" name="submit" value="simpan">
                </form>
                <form action="{{ route('hapus.jurusan') }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('put') }}
                    <input type="hidden" name="id" value="{{ $item->id }}">
                    <input type="submit" name="submit" value="hapus">
                </form>
            </li>
        @endforeach
    </ul>
    <h3>Tambah jurusan</h3>
    <form action="{{ route('tambah.jurusan') }}" method="post">
        {{ csrf_field() }}
        {{ method_field('put') }}
        <input type="number" name="id_fakultas" placeholder="id_fakultas (hidden)">
        <textarea name="nama" placeholder="Pisahkan dengan enter untuk menambahkan banyak jurusan"></textarea>
        <input type="submit" name="submit" value="tambah">
    </form>
    <br>
    <br>

    {{--prodi--}}
    <h3>Daftar Prodi</h3>
    <ul>
        @foreach($prodi as $item)
            <li>
                id={{ $item->id }} |
                id_jurusan={{ $item->id_jurusan }}
                <form action="{{ route('edit.prodi') }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('put') }}
                    <input type="hidden" name="id" value="{{ $item->id }}">
                    <input type="text" name="nama" value="{{ $item->nama }}">
                    <input type="submit" name="submit" value="simpan">
                </form>
                <form action="{{ route('hapus.prodi') }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('put') }}
                    <input type="hidden" name="id" value="{{ $item->id }}">
                    <input type="submit" name="submit" value="hapus">
                </form>
            </li>
        @endforeach
    </ul>
    <h3>Tambah Prodi</h3>
    <form action="{{ route('tambah.prodi') }}" method="post">
        {{ csrf_field() }}
        {{ method_field('put') }}
        <input type="number" name="id_jurusan" placeholder="id_jurusan (hidden)">
        <textarea name="nama" placeholder="Pisahkan dengan enter untuk menambahkan banyak prodi"></textarea>
        <input type="submit" name="submit" value="tambah">
    </form>
@endsection