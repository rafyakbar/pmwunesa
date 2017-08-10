@extends('layouts.app')

@section('content')

    {{--fakultas--}}
    <h3>Daftar fakultas</h3>
    <ul>
        @foreach($fakultas as $item)
            <li>
                id={{ $item->id }}
                <form action="{{ route('edit.fakultas') }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('put') }}
                    <input type="hidden" name="id" value="{{ $item->id }}">
                    <input type="text" name="nama" value="{{ $item->nama }}">
                    <input type="submit" name="submit" value="simpan">
                </form>
                <form action="{{ route('hapus.fakultas') }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('put') }}
                    <input type="hidden" name="id" value="{{ $item->id }}">
                    <input type="submit" name="submit" value="hapus">
                </form>
            </li>
        @endforeach
    </ul>
    <h3>Tambah fakultas</h3>
    <form action="{{ route('tambah.fakultas') }}" method="post">
        {{ csrf_field() }}
        {{ method_field('put') }}
        <textarea name="nama" placeholder="Pisahkan dengan enter untuk menambahkan banyak fakultas"></textarea>
        <input type="submit" name="submit" value="tambah">
    </form>
    <br>
    <br>

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