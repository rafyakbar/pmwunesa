<li @if(Route::currentRouteName() === 'proposaladminfakultas' ) class="active" @endif>
    <a href="{{ route('proposaladminfakultas',[ 'filter' => 'semua' ]) }}">
        <i class="material-icons">library_books</i>
        <p>Proposal</p>
    </a>
</li>