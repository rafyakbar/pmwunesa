<div class="sidebar" data-color="blue" data-image="../assets/img/sidebar-1.jpg">
    <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | blue | green | orange | red"

        Tip 2: you can also add an image using data-image tag
    -->

    <div class="logo">
        <a href="http://www.creative-tim.com" class="simple-text">
            PMW Unesa
        </a>
    </div>

    <div class="sidebar-wrapper">
        <ul class="nav">
            {{-- @if(Auth::user()->hasRole(\PMW\User::KETUA_TIM))
            <li class="active">
                <a href="dashboard.html">
                    <i class="material-icons">dashboard</i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li>
                <a href="user.html">
                    <i class="material-icons">people</i>
                    <p>Anggota</p>
                </a>
            </li>
            <li>
                <a href="table.html">
                    <i class="material-icons">book</i>
                    <p>Logbook</p>
                </a>
            </li>
            <li>
                <a href="typography.html">
                    <i class="material-icons">check_circle</i>
                    <p>Proposal Final</p>
                </a>
            </li>
            <li>
                <a href="icons.html">
                    <i class="material-icons">attach_money</i>
                    <p>Laporan Kegiatan</p>
                </a>
            </li>
            <li>
                <a href="maps.html">
                    <i class="material-icons">description</i>
                    <p>Laporan Akhir</p>
                </a>
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
            @endif
            @if(Auth::user()->hasRole(\PMW\User::ANGGOTA))

            @endif
            @if(Auth::user()->hasRole(\PMW\User::REVIEWER))

            @endif
            @if(Auth::user()->hasRole(\PMW\User::ADMIN_FAKULTAS))

            @endif
            @if(Auth::user()->hasRole(\PMW\User::ADMIN_UNIVERSITAS))

            @endif
            @if(Auth::user()->hasRole(\PMW\User::DOSEN_PEMBIMBING))

            @endif
            @if(Auth::user()->hasRole(\PMW\User::SUPER_ADMIN))

            @endif	--}}

            <li class="active">
                <a href="{{ route('dashboard') }}">
                    <i class="material-icons">dashboard</i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li>
                <a href="{{ route('undang.anggota') }}">
                    <i class="material-icons">people</i>
                    <p>Anggota</p>
                </a>
            </li>
            <li>
                <a href="typography.html">
                    <i class="material-icons">library_books</i>
                    <p>Proposal</p>
                </a>
            </li>
            <li>
                <a href="table.html">
                    <i class="material-icons">book</i>
                    <p>Logbook</p>
                </a>
            </li>
            <li>
                <a href="icons.html">
                    <i class="material-icons">assignment</i>
                    <p>Laporan Kegiatan</p>
                </a>
            </li>
            <li>
                <a href="maps.html">
                    <i class="material-icons">description</i>
                    <p>Laporan Akhir</p>
                </a>
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