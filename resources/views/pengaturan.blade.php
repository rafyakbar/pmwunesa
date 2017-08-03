@if(count($errors))
    @foreach($errors->all() as $error)
        {{ $error }}
    @endforeach
@endif

@if(Session::has('message'))
<p>{{ Session::get('message') }}</p>
@endif
<form action="{{ route('ubah.profil') }}" method="post">
{{ csrf_field() }}
<input type="text" name="id_prodi" value="{{ Auth::user()->id_prodi }}"/>
Nama : <input type="text" name="nama" value="{{ Auth::user()->nama }}"/><br/>
E-mail : <input type="text" name="email" value="{{ Auth::user()->email }}"/><br/>
No. telepon : <input type="text" name="no_telepon" value="{{ Auth::user()->no_telepon }}"/><br/>
@if($errors->has('no_telepon'))
    <p>{{ $errors->first('no_telepon') }}</p>
@endif
Alamat Asal : <input type="text" name="alamat_asal" value="{{ Auth::user()->alamat_asal }}"/><br/>
Alamat Tinggal : <input type="text" name="alamat_tinggal" value="{{ Auth::user()->alamat_tinggal }}"/><br/>
@if(Auth::user()->hasAnyRole([\PMW\User::KETUA_TIM,\PMW\User::ANGGOTA]))
IPK : <input type="text" name="ipk" value="{{ Auth::user()->mahasiswa()->ipk }}"/>
@endif
<button type="submit">Ubah</button>
</form>