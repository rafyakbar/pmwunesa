@extends('layouts.app')

@section('content')
    @foreach($pengaturan as $item)
        <h3>{{ $item->nama }}</h3>
        <form>
            <input type="hidden" value="{{ $item->id }}">
            <input type="text" value="{{ $item->keterangan }}">
            <input type="submit" name="submit" value="simpan">
        </form>
        <p>Terakhir diubah pada {{ $item->updated_at }}</p>
        <br><br>
    @endforeach

    <h3>Daftar aspek</h3>
    <ul>
        @foreach($aspek as $item)
            <li>
                id={{ $item->id }}
                <form action="{{ route('edit.aspek') }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('put') }}
                    <input type="hidden" name="id" value="{{ $item->id }}">
                    <input name="nama" value="{{ $item->nama }}">
                    <input type="submit" name="submit" value="simpan">
                </form>
                <form action="{{ route('hapus.aspek') }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('put') }}
                    <input type="hidden" name="id" value="{{ $item->id }}">
                    <input type="submit" name="submit" value="hapus">
                </form>
            </li>
        @endforeach
    </ul>
    <br>
    <br>
    <h3>Tambah aspek</h3>
    <form action="{{ route('tambah.aspek') }}" method="post">
        {{ csrf_field() }}
        {{ method_field('put') }}
        <textarea name="nama" placeholder="Pisahkan dengan enter untuk menambahkan banyak aspek"></textarea>
        <input type="submit" name="submit" value="tambah">
    </form>
@endsection