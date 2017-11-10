@extends('layouts.app')

@section('brand')
    Jurusan
@endsection

@section('content')
    <div class="dropdown">
        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
            {{ ucwords(str_replace('_',' ',$fakultas)) }}&nbsp;&nbsp;<span class="caret"></span>
        </button>
        <ul class="dropdown-menu">
            <li><a href="{{ route('daftar.jurusan', ['fakultas' => 'semua_fakultas', 'perHalaman' => $perHalaman]) }}">Semua FAKULTAS</a></li>
            @foreach($daftarfakultas as $item)
                <li>
                    <a href="{{ route('daftar.jurusan', ['fakultas' => str_replace(' ','_',strtolower($item->nama)), 'perHalaman' => $perHalaman]) }}">{{ $item->nama }}</a>
                </li>
            @endforeach
        </ul>
    </div>
    <div class="card">
        <div class="card-header" data-background-color="purple">
            <h4 class="title">Jurusan</h4>
            <p class="category">Jumlah jurusan sesuai filter adalah {{ $jurusan->total() }} jurusan</p>
        </div>
        <div class="card-content table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Nama dan fakultas</th>
                    <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                @foreach($jurusan as $item)
                    <tr>
                        <td>{{ ($jurusan->currentpage() * $jurusan->perpage()) + (++$c) - $jurusan->perpage()  }}</td>
                        <td>
                            <form action="{{ route('edit.jurusan') }}" method="post" id="simpan-{{ $item->id }}">
                                {{ csrf_field() }}
                                {{ method_field('put') }}
                                <input type="hidden" name="id" value="{{ $item->id }}">
                                <span class="material-input"></span>
                                <div class="input-group">
                                    <div class="row">
                                        <div class="col-md-7">
                                            <input type="text" name="nama" value="{{ $item->nama }}" class="form-control" style="border: 1px">
                                        </div>
                                        <div class="col-md-5">
                                            <select name="id_fakultas" class="form-control">
                                                @if(is_null($item->id_fakultas))
                                                    <option value="">Pilih fakultas</option>
                                                    @foreach($daftarfakultas as $value)
                                                        <option value="{{ $value->id }}">Fakultas {{ $value->nama }}</option>
                                                    @endforeach
                                                @else
                                                    {{ $jFakultas = \PMW\Models\Jurusan::find($item->id)->fakultas() }}
                                                    <option value="{{ $jFakultas->id }}">Fakultas {{ $jFakultas->nama }}</option>
                                                    @foreach($daftarfakultas as $value)
                                                        @if($value->id !== $jFakultas->id)
                                                            <option value="{{ $value->id }}">Fakultas {{ $value->nama }}</option>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
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
                    <form action="{{ route('hapus.jurusan') }}" method="post" id="hapus-{{ $item->id }}">
                        {{ csrf_field() }}
                        {{ method_field('put') }}
                        <input type="hidden" name="id" value="{{ $item->id }}">
                    </form>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            {{ $jurusan->links() }}
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <form action="{{ route('tambah.jurusan') }}" method="post">
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