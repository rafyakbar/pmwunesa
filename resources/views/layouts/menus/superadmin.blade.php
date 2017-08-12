<li @if(Route::currentRouteName() === 'fakultas' ) class="active" @endif>
    <a href="{{ route('fakultas') }}">
        <i class="material-icons">book</i>
        <p>Fakultas</p>
    </a>
</li>

<li>
    <a href="{{ route('pengguna') }}">
        <i class="material-icons">library_books</i>
        <p>Pengguna</p>
    </a>
</li>

<li>
    <a href="{{ route('daftar.proposal.reviewer') }}">
        <i class="material-icons">library_books</i>
        <p>Proposal</p>
    </a>
</li>

<li>
    <a href="/">
        <i class="material-icons">library_books</i>
        <p>Proposal Final</p>
    </a>
</li>

<li>
    <a href="/">
        <i class="material-icons">library_books</i>
        <p>Laporan Kemajuan</p>
    </a>
</li>

<li>
    <a href="/">
        <i class="material-icons">library_books</i>
        <p>Laporan Akhir</p>
    </a>
</li>