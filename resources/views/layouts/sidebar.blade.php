<div class="sidebar" data-color="blue" data-image="../assets/img/sidebar-1.jpg">
    <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | blue | green | orange | red"

        Tip 2: you can also add an image using data-image tag
    -->

    <div class="logo">
        <a href="{{ route('dashboard') }}" class="simple-text">
            PMW Unesa
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

            @if (Auth::user()->isSuperAdmin())

                @include('layouts.menus.adminuniversitas')

            @endif

            @if (Auth::user()->isAdminUniversitas())

                @include('layouts.menus.adminuniversitas')

            @endif

            @if (Auth::user()->isAdminFakultas())

                @include('layouts.menus.adminuniversitas')

            @endif

            @if(Auth::user()->isMahasiswa())

                @include('layouts.menus.mahasiswa')

            @endif

            @if(Auth::user()->isReviewer())

                @include('layouts.menus.reviewer')

            @endif

            @if(Auth::user()->isDosenPembimbing())

                @include('layouts.menus.reviewer')

            @endif
            <li {{ Route::currentRouteName() === 'pengaturan' ? 'class=active' : '' }}>
                <a href="{{ route('pengaturan') }}"><i class="material-icons">face</i><p>Profil</p></a>
            </li>
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
