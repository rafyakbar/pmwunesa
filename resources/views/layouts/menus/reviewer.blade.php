<li {{ Route::currentRouteName() === 'daftar.proposal.reviewer' ? 'class=active' : ''}}>
    <a href="{{ route('daftar.proposal.reviewer') }}">
        <i class="material-icons">book</i>
        <p>Daftar Proposal</p>
    </a>
</li>

<li {{ Route::currentRouteName() === 'daftar.proposal.final' ? 'class=active' : ''}}>
    <a href="{{ route('daftar.proposal.final') }}">
        <i class="material-icons">library_books</i>
        <p>Proposal Final</p>
    </a>
</li>

<li {{ Route::currentRouteName() === 'daftar.laporan.kemajuan' ? 'class=active' : ''}}>
    <a href="{{ route('daftar.laporan.kemajuan')}}">
        <i class="material-icons">library_books</i>
        <p>Laporan Kemajuan</p>
    </a>
</li>

<li {{ Route::currentRouteName() === 'daftar.laporan.akhir' ? 'class=active' : ''}}>
    <a href="{{ route('daftar.laporan.akhir')}}">
        <i class="material-icons">library_books</i>
        <p>Laporan Akhir</p>
    </a>
</li>
