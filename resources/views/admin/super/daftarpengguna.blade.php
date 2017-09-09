@extends('layouts.app')

@section('content')

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

    <div class="dropdown">
        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
            Filter&nbsp;&nbsp;Hak Akses&nbsp;&nbsp;<span class="caret"></span>
        </button>
        <ul class="dropdown-menu">
            <li><a href="{{ route('daftar.pengguna',['fakultas' => $fakultas, 'role' => 'semua_hak_akses']) }}">Semua Hak Akses</a>
            </li>
            @foreach($hak_akses as $item)
                <li>
                    <a href="{{ route('daftar.pengguna',[ 'fakultas' => $fakultas, 'role' => str_replace(' ','_',strtolower($item->nama))]) }}">{{ $item->nama }}</a>
                </li>
            @endforeach
        </ul>
    </div>

    <a href="{{ route('unduh.filter.pengguna', ['fakultas' => $fakultas, 'role' => $role]) }}" class="btn btn-primary">Unduh Daftar Pengguna</a>

    <ul>
        @foreach($user as $item)
            @if($role != 'semua_hak_akses')
                @if(\PMW\User::find($item->id)->hasRole(ucwords(str_replace('_',' ',$role))))
                    <li>
                        {{ ++$c }}
                        @if(is_null($item->nama))
                            "Pengguna ini belum mengatur nama"
                        @else
                            {{ $item->nama }}
                        @endif
                        <br>
                        @if(!\PMW\User::find($item->id)->hasRole('Super Admin'))
                            <form action="{{ route('tambah.hakaksespengguna') }}" method="post">
                                {{ csrf_field() }}
                                {{ method_field('put') }}
                                <input type="hidden" name="id" value="{{ $item->id }}">
                                @foreach($hak_akses as $value)
                                    <input type="checkbox" name="hakakses[]" value="{{ $value->nama }}"
                                           @if(\PMW\User::find($item->id)->hasRole($value->nama)) checked disabled
                                           @endif @if($value->nama == 'Ketua Tim') disabled @endif> {{ $value->nama }}<br>
                                @endforeach
                                <input type="submit" name="simpan" value="simpan">
                            </form>
                            <form action="{{ route('hapus.pengguna') }}" method="post">
                                {{ csrf_field() }}
                                {{ method_field('put') }}
                                <input type="hidden" name="id" value="{{ $item->id }}">
                                <input type="submit" name="submit" value="hapus">
                            </form>
                        @endif
                    </li>
                @endif
            @else
                <li>
                    {{ ++$c }}
                    @if(is_null($item->nama))
                        "Pengguna ini belum mengatur nama"
                    @else
                        {{ $item->nama }}
                    @endif
                    <br>
                    @if(!\PMW\User::find($item->id)->hasRole('Super Admin'))
                        <form action="{{ route('tambah.hakaksespengguna') }}" method="post">
                            {{ csrf_field() }}
                            {{ method_field('put') }}
                            <input type="hidden" name="id" value="{{ $item->id }}">
                            @foreach($hak_akses as $value)
                                <input type="checkbox" name="hakakses[]" value="{{ $value->nama }}"
                                       @if(\PMW\User::find($item->id)->hasRole($value->nama)) checked disabled
                                       @endif @if($value->nama == 'Ketua Tim') disabled @endif> {{ $value->nama }}<br>
                            @endforeach
                            <input type="submit" name="simpan" value="simpan">
                        </form>
                        <form action="{{ route('hapus.pengguna') }}" method="post">
                            {{ csrf_field() }}
                            {{ method_field('put') }}
                            <input type="hidden" name="id" value="{{ $item->id }}">
                            <input type="submit" name="submit" value="hapus">
                        </form>
                    @endif
                </li>
            @endif
        @endforeach
    </ul>
    <br>
    <br>
    <h3>Tambah Pengguna</h3>
    <form action="{{ route('tambah.user') }}" method="post">
        {{ csrf_field() }}
        {{ method_field('put') }}
        <input type="text" name="id" placeholder="nip/nim" required>
        <input type="email" name="email" placeholder="email" required>
        <br>
        <label>Hak akses</label><br>
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
        <input type="submit">
    </form>
@endsection