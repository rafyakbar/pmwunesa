@extends('layouts.app')

@section('content')

    @if(Session::has('message'))
        <p class="alert alert-success">{{ Session::get('message') }}</p>
    @endif

    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header" data-background-color="green">
                    <h4 class="title">Profil</h4>
                    <p class="category">Isi data berikut dengan benar sesuai identitas asli</p>
                </div>

                <div class="card-content">
                    <form action="{{ route('ubah.profil') }}" method="post">

                        {{ csrf_field() }}

                        <div class="row">
                            <div class="col-lg-3">
                                <label for="nama">Nama lengkap</label>
                            </div>
                            <div class="col-lg-9">
                                <input class="form-control" placeholder="Nama lengkap" type="text" name="nama"
                                       value="{{ $errors->has('nama') ? old('nama') : Auth::user()->nama }}" required/>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3">
                                <label for="id">NIM/NIP/NIDN</label>
                            </div>
                            <div class="col-lg-9">
                                <input class="form-control" type="text" name="id"
                                       value="{{ Auth::user()->id }}" disabled/>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3">
                                <label for="no_telepon">No. telepon</label>
                            </div>
                            <div class="col-lg-9">
                                <input class="form-control" placeholder="No. telepon" type="text" name="no_telepon"
                                       value="{{ $errors->has('no_telepon') ? old('no_telepon') : Auth::user()->no_telepon }}"
                                       required/>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3">
                                <label for="no_telepon">E-mail</label>
                            </div>
                            <div class="col-lg-9">
                                <input class="form-control" placeholder="E-mail" type="email" name="email"
                                       value="{{ $errors->has('email') ? old('email') : Auth::user()->email }}"
                                       disabled/>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3">
                                <label for="alamat_asal">Alamat asal</label>
                            </div>
                            <div class="col-lg-9">
                                <input type="text" name="alamat_asal"
                                       value="{{ $errors->has('alamat_asal') ? old('alamat_asal') : Auth::user()->alamat_asal }}"
                                       class="form-control" placeholder="Alamat asal" required/>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3">
                                <label for="alamat_asal">Alamat tinggal</label>
                            </div>
                            <div class="col-lg-9">
                                <input type="text" name="alamat_tinggal"
                                       value="{{ $errors->has('alamat_tinggal') ? old('alamat_tinggal') : Auth::user()->alamat_tinggal }}"
                                       class="form-control" placeholder="Alamat tinggal" required/>
                            </div>
                        </div>

                        @if(Auth::user()->isMahasiswa())
                            <div class="row">
                                <div class="col-lg-3">
                                    <label for="ipk">IPK</label>
                                </div>
                                <div class="col-lg-9">
                                    <input type="text" name="ipk"
                                           value="{{ $errors->has('ipk') ? old('ipk') : Auth::user()->mahasiswa()->ipk }}"
                                           class="form-control" placeholder="IPK"/>
                                </div>
                            </div>
                        @endif

                        @if(Auth::user()->isDosenPembimbing() || Auth::user()->isMahasiswa())
                        <div class="row">
                            <div class="col-lg-3">
                                <label>Instansi</label>
                            </div>
                            <div class="col-lg-9">
                                <select class="form-control" style="width: auto" id="fakultas">
                                    @if(!is_null(Auth::user()->prodi()))
                                        <option value="{{ Auth::user()->prodi()->jurusan()->fakultas()->id }}">
                                            Fakultas {{ Auth::user()->prodi()->jurusan()->fakultas()->nama }}</option>
                                    @else
                                        <option value="-1">Pilih Fakultas</option>
                                    @endif
                                    @foreach($daftar_fakultas as $fakultas)
                                            <option value="{{ $fakultas->id }}">Fakultas {{ $fakultas->nama }}</option>
                                    @endforeach
                                </select>

                                <select class="form-control" style="width: auto" id="jurusan">
                                    @if(!is_null(Auth::user()->prodi()))
                                        <option value="{{ Auth::user()->prodi()->jurusan()->id }}">
                                            {{ Auth::user()->prodi()->jurusan()->nama }}</option>
                                    @else
                                    <option value="-1">Pilih Jurusan</option>
                                        @endif
                                        @foreach($daftar_jurusan as $jurusan)
                                            <option value="{{ $jurusan->id }}">Fakultas {{ $jurusan->nama }}</option>
                                        @endforeach
                                </select>

                                <select class="form-control" style="width: auto" name="id_prodi" id="prodi">
                                    @if(!is_null(Auth::user()->prodi()))
                                        <option value="{{ Auth::user()->prodi()->id }}">
                                            {{ Auth::user()->prodi()->nama }}</option>
                                    @else
                                        <option value="-1">Pilih Program Studi</option>
                                    @endif
                                    @foreach($daftar_prodi as $prodi)
                                        <option value="{{ $prodi->id }}">Fakultas {{ $prodi->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        @endif

                        <div class="row">
                            <div class="col-lg-3"></div>
                            <div class="col-lg-9">
                                <button type="submit" class="btn btn-success">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header" data-background-color="green">
                    <h4 class="title">Ubah password</h4>
                    <p class="category">Jaga keamanan akun anda</p>
                </div>

                <div class="card-content">
                    <form action="{{ route('ubah.password') }}" method="post">
                        {{ csrf_field() }}

                        {{ method_field('patch') }}
                        <br/>
                        <div class="form-group label-floating">
                            <label class="control-label">Password lama</label>
                            <input class="form-control" type="password" name="plama"/>
                        </div>

                        @if($errors->has('plama'))
                            <p class="alert alert-danger">{{ $errors->first('plama') }}</p>
                        @endif

                        <div class="form-group label-floating">
                            <label class="control-label">Password baru</label>
                            <input class="form-control" type="password" name="pbaru"/>
                        </div>

                        <div class="form-group label-floating">
                            <label class="control-label">Konfirmasi password baru</label>
                            <input class="form-control" type="password" name="pbaru_confirm"/>
                        </div>

                        @if($errors->has('pbaru'))
                            <p class="alert alert-danger">{{ $errors->first('pbaru') }}</p>
                        @endif
                        <button type="submit" class="btn btn-success">Ubah</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('js')
    <script>
        $('#fakultas').on('change', function () {
            var val = $(this).val()

            if (val !== -1) {
                $.ajax({
                    type: 'post',
                    url: '{{ route('daftar.jurusan.fakultas') }}',
                    data: 'fakultas=' + val,
                    success: function (response) {
                        $('#jurusan').html('').append('<option value="-1">Pilih Jurusan</option>')
                        $('#prodi').html('').append('<option value="-1">Pilih Prodi</option>')

                        for (i in response) {
                            var option = $('<option></option>')
                            option.attr('value', response[i].id)
                            option.text(response[i].nama)

                            $('#jurusan').append(option)
                        }
                    }
                })
            }
        })

        $('#jurusan').on('change', function () {
            var val = $(this).val()

            if (val !== -1) {
                $.ajax({
                    type: 'post',
                    url: '{{ route('daftar.prodi.jurusan') }}',
                    data: 'jurusan=' + val,
                    success: function (response) {
                        $('#prodi').html('').append('<option value="-1">Pilih Prodi</option>')


                        for (i in response) {
                            var option = $('<option></option>')
                            option.attr('value', response[i].id)
                            option.text(response[i].nama)

                            $('#prodi').append(option)
                        }
                    }
                })
            }
        })
    </script>
@endpush