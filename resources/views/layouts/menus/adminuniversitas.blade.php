<li @if(Route::currentRouteName() === 'proposaladminuniv' ) class="active" @endif>
    <a href="{{ route('proposaladminuniv', ['fakultas' => 'semua_fakultas', 'lolos' => 'semua']) }}">
        <i class="material-icons">library_books</i>
        <p>Proposal</p>
    </a>
</li>