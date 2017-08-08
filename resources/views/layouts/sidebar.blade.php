<div class="sidebar" data-color="blue" data-image="../assets/img/sidebar-1.jpg">
    <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | blue | green | orange | red"

        Tip 2: you can also add an image using data-image tag
    -->

    <div class="logo">
        <a href="http://www.creative-tim.com" class="simple-text">
            PMW Unesa {{ Route::currentRouteName() }}
        </a>
    </div>

    <div class="sidebar-wrapper">
        <ul class="nav">
            <li @if(Route::currentRouteName() === 'dashboard' ) class="active" @endif>
                <a href="{{ route('dashboard') }}">
                    <i class="material-icons">dashboard</i>
                    <p>Dashboard</p>
                </a>
            </li>
            @if(Auth::user()->isMahasiswa())
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
                <a href={{ route('laporan.kemajuan') }}">
                    <i class="material-icons">assignment</i>
                    <p>Laporan Kemajuan</p>
                </a>
            </li>
            <li>
                <a href="{{ route('laporan.akhir') }}">
                    <i class="material-icons">description</i>
                    <p>Laporan Akhir</p>
                </a>
            </li>
            @endif
            <li>
                <a href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                    <i class="material-icons">close</i>
                    <p>Logout</p>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </li>

        </ul>
    </div>
</div>