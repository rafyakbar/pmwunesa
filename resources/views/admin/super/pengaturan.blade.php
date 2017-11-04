@extends('layouts.app')

@section('content')
    @if(session()->has('message'))
    <div class="alert alert-info">
        {{ session()->get('message') }}
    </div>
    @endif

    <div class="row">
        <div class="col-md-6 col-sm-6">
            <div class="card">
                <div class="card-header" data-background-color="blue">
                    <h4 class="title">{{ $pengaturan[0]->nama }}</h4>
                </div>
                <div class="card-content">
                    <form action="{{ route('edit.pengaturan') }}" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="id" value="{{ $pengaturan[0]->id }}" min="0" max="100">
                        <input type="number" name="keterangan" value="{{ $pengaturan[0]->keterangan }}" class="form-control">
                        <input type="submit" name="submit" value="simpan" class="btn btn-success">
                    </form>
                    <p>Diubah {{ $pengaturan[0]->updated_at->diffForHumans() }}.</p>
                </div>
            </div>
            <div class="card">
                <div class="card-header" data-background-color="blue">
                    <h4 class="title">{{ $pengaturan[1]->nama }}</h4>
                </div>
                <div class="card-content">
                    <form>
                        <input type="hidden" value="{{ $pengaturan[1]->id }}">
                        <input type="text" name="keterangan" value="{{ $pengaturan[1]->keterangan }}" class="form-control">
                        <input type="submit" name="submit" value="simpan" class="btn btn-success">
                    </form>
                    <p>Diubah {{ $pengaturan[1]->updated_at->diffForHumans() }}.</p>
                </div>
            </div>
            <div class="card">
                <div class="card-header" data-background-color="blue">
                    <h4 class="title">{{ $pengaturan[3]->nama }}</h4>
                </div>
                <div class="card-content">
                    <form>
                        <input type="hidden" value="{{ $pengaturan[3]->id }}">
                        <input type="text" name="keterangan" value="{{ $pengaturan[3]->keterangan }}" class="form-control">
                        <input type="submit" name="submit" value="simpan" class="btn btn-success">
                    </form>
                    <p>Diubah {{ $pengaturan[3]->updated_at->diffForHumans() }}.</p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-6">
            <div class="card">
                <div class="card-header" data-background-color="blue">
                    <h4 class="title">{{ $pengaturan[2]->nama }}</h4>
                </div>
                <div class="card-content">
                    <form>
                        <input type="hidden" value="{{ $pengaturan[2]->id }}">
                        <input type="text" name="keterangan" value="{{ $pengaturan[2]->keterangan }}" class="form-control">
                        <input type="submit" name="submit" value="simpan" class="btn btn-success">
                    </form>
                    <p>Diubah {{ $pengaturan[2]->updated_at->diffForHumans() }}.</p>
                </div>
            </div>
            <div class="card">
                <div class="card-header" data-background-color="blue">
                    <h4 class="title">{{ $pengaturan[4]->nama }}</h4>
                </div>
                <div class="card-content">
                    <form>
                        <input type="hidden" value="{{ $pengaturan[4]->id }}">
                        <input type="text" name="keterangan" value="{{ $pengaturan[4]->keterangan }}" class="form-control">
                        <input type="submit" name="submit" value="simpan" class="btn btn-success">
                    </form>
                    <p>Diubah {{ $pengaturan[4]->updated_at->diffForHumans() }}.</p>
                </div>
            </div>
            <div class="card">
                <div class="card-header" data-background-color="blue">
                    <h4 class="title">Tambah Aspek</h4>
                </div>
                <div class="card-content">
                    <form action="{{ route('tambah.aspek') }}" method="post">
                        {{ csrf_field() }}
                        {{ method_field('put') }}
                        <textarea name="nama" class="form-control"
                                  placeholder="Pisahkan dengan enter untuk menambahkan banyak aspek"></textarea>
                        <input type="submit" name="submit" value="tambah" class="btn btn-success">
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header" data-background-color="blue">
            <h4>Daftar aspek</h4>
            <p class="category">Berikut ini adalah aspek atau kriteria PMW UNESA</p>
        </div>
        <div class="card-content">
            <table class="table">
                <thead>
                <tr>
                    <td>No.</td>
                    <td width="50%">Nama Aspek</td>
                    <td>Aksi</td>
                </tr>
                </thead>
                <tbody>
                @foreach($aspek as $item)
                    <tr>

                        <td>
                            {{ ++$c }}
                        </td>
                        <td>
                            <form action="{{ route('edit.aspek') }}" method="post" id="update-{{ $item->id }}">
                                {{ csrf_field() }}
                                {{ method_field('put') }}
                                <input type="hidden" name="id" value="{{ $item->id }}">
                                <input name="nama" value="{{ $item->nama }}" class="form-control">
                            </form>
                        </td>
                        <td>
                            <div class="btn-group">
                                <a href="{{ route('edit.aspek') }}" class="btn btn-success btn-sm"
                                   onclick="event.preventDefault(); document.getElementById('update-{{ $item->id }}').submit();">Simpan</a>
                                <a href="{{ route('hapus.aspek') }}" onclick="event.preventDefault();document.getElementById('hapus-{{ $item->id }}').submit();" class="btn btn-danger btn-sm">Hapus</a>
                            </div>
                        </td>

                    </tr>
                    <form action="{{ route('hapus.aspek') }}" method="post" id="hapus-{{ $item->id }}">
                        {{ csrf_field() }}
                        {{ method_field('put') }}
                        <input type="hidden" name="id" value="{{ $item->id }}">
                    </form>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection