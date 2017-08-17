<li @if(Route::currentRouteName() === 'undang.anggota' ) class="active" @endif>
    <a href="{{ route('undang.anggota') }}">
        <i class="material-icons">people</i>
        <p>Tim Saya</p>
    </a>
</li>
<li>
    <a href="{{ route('proposal') }}">
        <i class="material-icons">library_books</i>
        <p>Proposal</p>
    </a>
</li>
<li>
    <a href="{{ route('logbook') }}">
        <i class="material-icons">book</i>
        <p>Logbook</p>
    </a>
</li>
<li>
    <a href="{{ route('laporan') }}">
        <i class="material-icons">assignment</i>
    <p>Laporan</p>
    </a>
</li>
