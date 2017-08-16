@extends('layouts.app')

@section('content')
    <ul>
        @foreach($user as $item)
            {{ $isSuperAdmin = false }}
            <li>{{ $item->nama }},
                @foreach($item->hakAksesPengguna()->cursor() as $value)
                    {{ $value->nama  }},
                    @if($value->nama == 'Super Admin')
                        {{ $isSuperAdmin = true }}
                    @endif
                @endforeach
                @if(!$isSuperAdmin)
                    <form action="{{ route('tambah.hakaksespengguna') }}" method="post">
                        {{ csrf_field() }}
                        {{ method_field('put') }}
                        <input type="hidden" name="id" value="{{ $item->id }}">
                        @foreach($hak_akses as $value)
                            <input type="checkbox" name="hakakses[]" value="{{ $value->nama }}" @if(\PMW\User::find($item->id)->hasRole($value->nama)) checked disabled @endif @if($value->nama == 'Ketua Tim') disabled @endif> {{ $value->nama }}<br>
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
        <input type="checkbox" name="hakakses[]" value="Admin Fakultas"> Admin Fakultas<br>
        <input type="checkbox" name="hakakses[]" value="Reviewer"> Reviewer<br>
        <input type="checkbox" name="hakakses[]" value="Dosen Pembimbing"> Dosen Pembimbing<br>
        <input type="checkbox" name="hakakses[]" value="Anggota"> Mahasiswa<br>
        <input type="submit">
    </form>
@endsection