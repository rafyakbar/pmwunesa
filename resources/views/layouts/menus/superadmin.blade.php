<li>
    <a data-toggle="collapse" href="#permintaan">
        <i class="material-icons">grid_on</i>
        <p>Permintaan</p>
    </a>
    <div class="collapse" id="permintaan">
        <ul class="nav">
            <li>
                <a href="{{ route('permintaan.hakakses') }}">Hak Akses</a>
            </li>
        </ul>
    </div>
</li>

<li>
    <a data-toggle="collapse" href="#akademik">
        <i class="material-icons">grid_on</i>
        <p>Akademik</p>
    </a>
    <div class="collapse" id="akademik">
        <ul class="nav">
            <li>
                <a href="{{ route('daftar.fakultas') }}">Fakultas</a>
            </li>
            <li>
                <a href="{{ route('daftar.jurusan') }}">Jurusan</a>
            </li>
            <li>
                <a href="{{ route('daftar.prodi') }}">Prodi</a>
            </li>
        </ul>
    </div>
</li>

<li @if(Route::currentRouteName() === 'daftar.pengguna' ) class="active" @endif>
    <a href="{{ route('daftar.pengguna') }}">
        <i class="material-icons">library_books</i>
        <p>Pengguna</p>
    </a>
</li>

<li @if(Route::currentRouteName() === 'daftar.proposal' ) class="active" @endif>
    <a href="{{ route('daftar.proposal') }}">
        <i class="material-icons">library_books</i>
        <p>Proposal</p>
    </a>
</li>

<li @if(Route::currentRouteName() === 'pengaturansistem' ) class="active" @endif>
    <a href="{{ route('pengaturansistem') }}">
        <i class="material-icons">library_books</i>
        <p>Pengaturan</p>
    </a>
</li>
