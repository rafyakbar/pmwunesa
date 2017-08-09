@extends('layouts.app')

@section('content')
    <ul>
        @foreach($fakultas as $item)
            <li>
                {{ $item->nama }}
            </li>
        @endforeach
    </ul>
    <h3>Tambah fakultas</h3>
    <form action="{{ route('tambah.fakultas') }}" method="post">
        {{ csrf_field() }}
        {{ method_field('put') }}
        <textarea name="nama" placeholder="Pisahkan dengan enter untuk menambahkan banyak fakultas"></textarea>
        <input type="submit">
    </form>
    <br>
    <br>
    <ul>
        @foreach($jurusan as $item)
            <li>
                {{ $item->id_fakultas }}
                |
                {{ $item->nama }}
            </li>
        @endforeach
    </ul>
    <h3>Tambah jurusan</h3>
    <form action="{{ route('tambah.jurusan') }}" method="post">
        {{ csrf_field() }}
        {{ method_field('put') }}
        <input type="number" name="id_fakultas" placeholder="id_fakultas (hidden)">
        <textarea name="nama" placeholder="Pisahkan dengan enter untuk menambahkan banyak jurusan"></textarea>
        <input type="submit">
    </form>
    <br>
    <br>
    <ul>
    @foreach($prodi as $item)
        <li>
            {{ $item->id_jurusan }}
            |
            {{ $item->nama }}
        </li>
        @endforeach
    </ul>
    <h3>Tambah Prodi</h3>
    <form action="{{ route('tambah.jurusan') }}" method="post">
        {{ csrf_field() }}
        {{ method_field('put') }}
        <input type="number" name="id_jurusan" placeholder="id_jurusan (hidden)">
        <textarea name="nama" placeholder="Pisahkan dengan enter untuk menambahkan banyak prodi"></textarea>
        <input type="submit">
    </form>
@endsection