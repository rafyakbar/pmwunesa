@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header" data-background-color="purple">
            <h4 class="title">Prodi</h4>
            <p class="category">Daftar program studi</p>
        </div>
        <div class="card-content table-responsive">
            <table class="table">
                <thead class="text-primary">
                <tr>
                    <th>Nama dan Jurusan</th>
                    <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                @foreach($prodi as $item)
                    <tr>
                        <td class="col-xs-10">
                            <form action="{{ route('edit.prodi') }}" method="post" class="col-xs-11">
                                {{ csrf_field() }}
                                {{ method_field('put') }}
                                <input type="hidden" name="id" value="{{ $item->id }}">
                                <span class="material-input"></span>
                                <div class="input-group">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <input type="text" name="nama" value="{{ $item->nama }}" class="form-control" style="border: 1px">
                                        </div>
                                        <div class="col-md-7">
                                            <select name="id_jurusan" class="form-control">
                                                @if(is_null($item->id_jurusan))
                                                    <option value="">Pilih jurusan</option>
                                                    @foreach($jurusan as $value)
                                                        <option value="{{ $value->id }}">Jurusan {{ $value->nama }}</option>
                                                    @endforeach
                                                @else
                                                    {{ $pJurusan = \PMW\Models\Prodi::find($item->id)->jurusan() }}
                                                    <option value="{{ $pJurusan->id }}">Fakultas {{ \PMW\Models\Jurusan::find($pJurusan->id)->fakultas()->nama }} | Jurusan {{ $pJurusan->nama }}</option>
                                                    @foreach($jurusan as $value)
                                                        @if($value->id !== $pJurusan->id)
                                                            <option value="{{ $value->id }}">Fakultas {{ \PMW\Models\Jurusan::find($value->id)->fakultas()->nama }} | Jurusan {{ $value->nama }}</option>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <span class="input-group-btn">
                                        <button type="submit" class="btn btn-white btn-just-icon" title="simpan">
                                            <i class="material-icons">save</i>
                                        </button>
                                    </span>
                                </div>
                            </form>
                        </td>
                        <td class="col-xs-1">
                            <form action="{{ route('hapus.prodi') }}" method="post">
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
        <div class="card-footer">
            {{ $prodi->links() }}
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <form action="{{ route('tambah.prodi') }}" method="post">
                        {{ csrf_field() }}
                        {{ method_field('put') }}
                        <div class="row" style="padding-left: 5%; padding-right: 5%">
                            <div class="col-md-10">
                                <textarea name="nama" placeholder="Pisahkan dengan enter untuk menambahkan banyak prodi" class="form-control"></textarea>
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