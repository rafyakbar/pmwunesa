@extends('layouts.app')

{{--@push('css')--}}
    {{--<link href="{{ asset("css/table.css") }}" rel="stylesheet">--}}
{{--@endpush--}}

@section('content')
    <div class="btn-group">
        <div class="btn-group">
            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
                {{ ucwords(str_replace('_',' ',$fakultas)) }}&nbsp;&nbsp;<span class="caret"></span>
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
        <div class="btn-group">
            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
                {{ ucwords(str_replace('_',' ',$role)) }}&nbsp;&nbsp;<span class="caret"></span>
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

        <a href="{{ route('unduh.filter.pengguna', ['fakultas' => $fakultas, 'role' => $role]) }}"
           class="btn btn-info">Unduh</a>
    </div>

    <div class="btn-group">
        <button class="btn btn-primary">Tambah pengguna</button>
    </div>

    <div class="card">
        <div class="card-header" data-background-color="blue">
            <h4>Daftar pengguna PMW UNESA</h4>
            <p class="category">Jumlah pengguna sesuai filter adalah {{ $user->total() }}</p>
        </div>
        <div class="card-content">
            <table class="table table-responsive">
                <thead>
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
                        <td>
                            {{ ($user->currentpage() * $user->perpage()) + (++$c) - $user->perpage()  }}
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
                                -
                            </td>
                            <td>
                                <div class="btn-group">
                                    <a class="btn btn-success btn-sm">Simpan</a>
                                    <a class="btn btn-danger btn-sm">Hapus</a>
                                    <a class="btn btn-primary btn-sm" data-toggle="collapse" data-target="#detail-{{ $item->id }}">Detail/Edit</a>
                                </div>
                            </td>
                        @endif
                    </tr>
                    <tr>
                        <td colspan="4" style="border-top: none !important;">
                            <div id="detail-{{ $item->id }}" class="collapse">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Hak akses</label>
                                        <form action="{{ route('tambah.hakaksespengguna') }}" method="post">
                                            {{ csrf_field() }}
                                            {{ method_field('put') }}
                                            <input type="hidden" name="id" value="{{ $item->id }}">
                                            @foreach($hak_akses as $value)
                                                <input type="checkbox" name="hakakses[]" value="{{ $value->nama }}"
                                                       @if(\PMW\User::find($item->id)->hasRole($value->nama)) checked disabled
                                                       @endif @if($value->nama == 'Ketua Tim') disabled @endif>
                                                {{ $value->nama }}
                                                <br>
                                            @endforeach
                                        </form>
                                    </div>
                                    <div class="col-md-4">
                                        <label>E-mail</label>
                                        <p>{{ $item->email }}</p>
                                        <label>Alamat asal</label>
                                        <p>{{ (is_null($item->alamat_asal)) ? '-' : $item->alamat_asal }}</p>
                                        <label>Alamat tinggal</label>
                                        <p>{{ (is_null($item->alamat_tinggal)) ? '-' : $item->alamat_tinggal }}</p>
                                    </div>
                                    <div class="col-md-4">
                                        <label>No telepon</label>
                                        <p>{{ is_null($item->no_telepon) ? '-' : $item->no_telepon }}</p>
                                        <p>Pengguna ini mendaftar pada {{ Carbon\Carbon::createFromTimeStamp(strtotime($item->created_at))->diffForHumans() }} dan telah memperbarui profil {{ Carbon\Carbon::createFromTimeStamp(strtotime($item->updated_at))->diffForHumans() }}</p>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <form action="{{ route('hapus.pengguna') }}" method="post">
                        {{ csrf_field() }}
                        {{ method_field('put') }}
                        <input type="hidden" name="id" value="{{ $item->id }}">
                    </form>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            {{ $user->links() }}
        </div>
    </div>

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

{{--@push('js')--}}
    {{--<script>--}}
        {{--$('.table-expand').find('tbody').find('tr:not(".expand")').click(function (e) {--}}
            {{--$(this).prevUntil('.table-expand', '.expand').hide()--}}
            {{--$(this).next().nextUntil('.table-expand', '.expand').hide()--}}
            {{--$(this).next().toggle()--}}

            {{--var elem = $(this).next()--}}
        {{--})--}}
    {{--</script>--}}
{{--@endpush--}}