<li @if(Route::currentRouteName() === 'proposaladminfakultas' ) class="active" @endif>
    <a href="{{ route('proposaladminfakultas',[ 'lolos' => 'semua', 'perHalaman' => 5 ]) }}">
        <i class="material-icons">library_books</i>
        <p>Proposal</p>
    </a>
</li>