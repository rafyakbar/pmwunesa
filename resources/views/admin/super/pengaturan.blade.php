@extends('layouts.app')

@section('content')
    @foreach($pengaturan as $item)
        <h3>{{ $item->nama }}</h3>
        <form>
            <input type="hidden" value="{{ $item->id }}">
            <input type="text" value="{{ $item->keterangan }}">
            <input type="submit" name="submit" value="simpan" class="btn btn-primary">
        </form>
        <p>Terakhir diubah pada {{ $item->updated_at }}</p>
        <br><br>
    @endforeach

    <div class="card">
        <div class="card-header" data-background-color="blue">
            <h3>Daftar aspek</h3>
        </div>
        <div class="card-content">
            <table class="table">
                <thead>
                <tr>
                    <td>No.</td>
                    <td>Nama Aspek</td>
                    <td>Aksi</td>
                </tr>
                </thead>
                <tbody>
                @foreach($aspek as $item)
                    <tr>
                        <td>
                            {{ $item->id }}
                        </td>
                        <form action="{{ route('edit.aspek') }}" method="post">
                            {{ csrf_field() }}
                            {{ method_field('put') }}
                                <input type="hidden" name="id" value="{{ $item->id }}">
                            <td>
                                <input name="nama" value="{{ $item->nama }}">
                            </td>
                            <td>
                                <input type="submit" name="submit" value="simpan" class="btn btn-primary">
                        </form>
                        <form action="{{ route('hapus.aspek') }}" method="post">
                            {{ csrf_field() }}
                            {{ method_field('put') }}
                                <input type="hidden" name="id" value="{{ $item->id }}">
                                <input type="submit" name="submit" value="hapus" class="btn btn-danger">
                            </td>
                        </form>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <ul>
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