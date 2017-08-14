<li>
    <a data-toggle="collapse" href="#tablesExamples">
        <i class="material-icons">grid_on</i>
        <p>Permintaan</p>
    </a>
    <div class="collapse" id="tablesExamples">
        <ul class="nav">
            <li>
                <a href="{{ route('permintaan.hakakses') }}" @if(Route::currentRouteName() === 'permintaan.hakakses' ) class="active" @endif>Hak Akses</a>
            </li>
        </ul>
    </div>
</li>

<li @if(Route::currentRouteName() === 'fakultas' ) class="active" @endif>
    <a href="{{ route('fakultas') }}">
        <i class="material-icons">book</i>
        <p>Fakultas</p>
    </a>
</li>

<li @if(Route::currentRouteName() === 'pengguna' ) class="active" @endif>
    <a href="{{ route('pengguna') }}">
        <i class="material-icons">library_books</i>
        <p>Pengguna</p>
    </a>
</li>

<li @if(Route::currentRouteName() === 'proposal.superadmin' ) class="active" @endif>
    <a href="{{ route('proposal.superadmin') }}">
        <i class="material-icons">library_books</i>
        <p>Proposal</p>
    </a>
</li>

<li @if(Route::currentRouteName() === 'laporankemajuan' ) class="active" @endif>
    <a href="/">
        <i class="material-icons">library_books</i>
        <p>Laporan</p>
    </a>
</li>
