@extends('layouts.app')

@section('content')
    <ul>
        @foreach($fakultas as $item)
            <li>
                id={{ $item->id }} |
                {{ $item->nama }}
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
    <ul>
        @foreach($jurusan as $item)
            <li>
                id={{ $item->id }} |
                id_fakultas={{ $item->id_fakultas }} |
                {{ $item->nama }}
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
    <ul>
    @foreach($prodi as $item)
        <li>
            id={{ $item->id }} |
            id_jurusan={{ $item->id_jurusan }}
            {{ $item->nama }}
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