@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-lg-2">
            <div class="dropdown">
                <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
                    Filter&nbsp;&nbsp;Fakultas&nbsp;&nbsp;<span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                    <li><a href="{{ route('daftar.pengguna',['fakultas' => 'semua_fakultas', 'role' => $role]) }}">Semua
                            Fakultas</a></li>
                    @foreach($daftar_fakultas as $item)
                        <li>
                            <a href="{{ route('daftar.pengguna',[ 'fakultas' => str_replace(' ','_',strtolower($item->nama)), 'role' => $role]) }}">Fakultas {{ $item->nama }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="col-lg-2">
            <div class="dropdown">
                <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
                    Filter Hak Akses&nbsp;&nbsp;<span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                    <li><a href="{{ route('daftar.pengguna',['fakultas' => $fakultas, 'role' => 'semua_hak_akses']) }}">Semua
                            Hak Akses</a>
                    </li>
                    @foreach($hak_akses as $item)
                        <li>
                            <a href="{{ route('daftar.pengguna',[ 'fakultas' => $fakultas, 'role' => str_replace(' ','_',strtolower($item->nama))]) }}">{{ $item->nama }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    filter : @if($fakultas!='semua_fakultas') Fakultas @endif {{ ucwords(str_replace('_',' ',$fakultas)) }} | @if($role == 'semua') Semua Hak Akses @else {{ ucwords(str_replace('_',' ',$role)) }} @endif
    <br>

    <a href="{{ route('unduh.filter.pengguna', ['fakultas' => $fakultas, 'role' => $role]) }}" class="btn btn-primary">Unduh
        Daftar Pengguna</a>

    <div class="card card-content">
        <div class="row">
            <div class="col-lg-12">
                <table class="table" style="margin-left: 10px">
                    <thead class="text-primary">
                    <tr>
                        <th>No.</th>
                        <th>Nama</th>
                        <th>Hak Akses</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($user as $item)
                        <tr>
                            @if($role != 'semua_hak_akses')
                                @if(\PMW\User::find($item->id)->hasRole(ucwords(str_replace('_',' ',$role))))
                                    <td>
                                        {{ ++$c }}
                                    </td>
                                    @if(is_null($item->nama))
                                        <td>
                                            "Pengguna ini belum mengatur nama"
                                        </td>
                                    @else
                                        <td>
                                            {{ $item->nama }}
                                        </td>
                                    @endif
                                    @if(!\PMW\User::find($item->id)->hasRole('Super Admin'))
                                        <td>
                                            <form action="{{ route('tambah.hakaksespengguna') }}" method="post">
                                                {{ csrf_field() }}
                                                {{ method_field('put') }}
                                                <input type="hidden" name="id" value="{{ $item->id }}">
                                                @foreach($hak_akses as $value)
                                                    <input type="checkbox" name="hakakses[]" value="{{ $value->nama }}"
                                                           @if(\PMW\User::find($item->id)->hasRole($value->nama)) checked
                                                           disabled
                                                           @endif @if($value->nama == 'Ketua Tim') disabled @endif> {{ $value->nama }}
                                                    <br>
                                            @endforeach
                                        </td>
                                        <td>
                                            <input type="submit" name="simpan" value="simpan" class="btn btn-primary">
                                            </form>
                                            <form action="{{ route('hapus.pengguna') }}" method="post">
                                                {{ csrf_field() }}
                                                {{ method_field('put') }}
                                                <input type="hidden" name="id" value="{{ $item->id }}">
                                                <input type="submit" name="submit" value="hapus" class="btn btn-danger">
                                            </form>
                                        </td>
                                    @endif
                                @endif
                            @else
                                <td>
                                    {{ ++$c }}
                                </td>
                                @if(is_null($item->nama))
                                    <td>
                                        "Pengguna ini belum mengatur nama"
                                    </td>
                                @else
                                    <td>
                                        {{ $item->nama }}
                                    </td>
                                @endif
                                @if(!\PMW\User::find($item->id)->hasRole('Super Admin'))
                                    <td>
                                        <form action="{{ route('tambah.hakaksespengguna') }}" method="post">
                                            {{ csrf_field() }}
                                            {{ method_field('put') }}
                                            <input type="hidden" name="id" value="{{ $item->id }}">
                                            @foreach($hak_akses as $value)
                                                <input type="checkbox" name="hakakses[]" value="{{ $value->nama }}"
                                                       @if(\PMW\User::find($item->id)->hasRole($value->nama)) checked
                                                       disabled
                                                       @endif @if($value->nama == 'Ketua Tim') disabled @endif> {{ $value->nama }}
                                                <br>
                                        @endforeach
                                    </td>
                                    <td>
                                        <input type="submit" name="simpan" value="Simpan" class="btn btn-primary">
                                        </form>
                                        <form action="{{ route('hapus.pengguna') }}" method="post">
                                            {{ csrf_field() }}
                                            {{ method_field('put') }}
                                            <input type="hidden" name="id" value="{{ $item->id }}">
                                            <input type="submit" name="submit" value="Hapus" class="btn btn-danger">
                                        </form>
                                    </td>
                                @endif
                            @endif
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <br>
    <div class="card card-content">
        <div class="row">
            <form action="{{ route('tambah.user') }}" method="post" class="form-group">
                <div class="col-lg-5 col-lg-offset-1" style="padding:5px">
                    <h3>Tambah Pengguna</h3>
                    {{ csrf_field() }}
                    {{ method_field('put') }}
                    <label for="id">NIP/NIM</label>
                    <input type="text" name="id" placeholder="NIP/NIM" required class="form-control">
                    <label for="email">Email</label>
                    <input type="email" name="email" placeholder="Email" required class="form-control">
                    <br>
                </div>
                <div class="col-lg-5" style="padding:5px">
                    <label style="margin-top:25px">Hak akses</label><br>
                    <input type="checkbox" name="hakakses[]" value="Super Admin"> Super Admin<br>
                    <input type="checkbox" name="hakakses[]" value="Admin Universitas"> Admin Universitas<br>
                    <input type="checkbox" name="hakakses[]" value="Admin Fakultas"> Admin Fakultas
                    <select name="idfakultas">
                        @foreach($daftar_fakultas as $item)
                            <option value="{{ $item->id }}">{{ $item->nama }}</option>
                        @endforeach
                    </select><br>
                    <input type="checkbox" name="hakakses[]" value="Reviewer"> Reviewer<br>
                    <input type="checkbox" name="hakakses[]" value="Dosen Pembimbing"> Dosen Pembimbing<br>
                    <input type="checkbox" name="hakakses[]" value="Anggota"> Mahasiswa<br>
                    <input type="submit" class="btn btn-primary" value="Tambah">
                </div>
            </form>
        </div>
    </div>
@endsection