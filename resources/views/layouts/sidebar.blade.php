<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="text-center card-header">
                <img width="" height="75" alt=""src="{{ asset('images/logo.png') }}">
                <div class="line_nav"></div>
            </div>
            
            <div class="nav">
                <!-- Dashboard -->
                @if (Session::get('akses_id') == '1')
                    <div class="sb-sidenav-menu-heading">Core</div>
                    <a class="nav-link {{ $nav == 'dashboard' ?'active':'' }}" href="{{ route('dashboard') }}">
                        <div class="sb-nav-link-icon"><i class="fas fa-home fa-sm"></i></div>Dashboard
                    </a>
                @endif

                <div class="sb-sidenav-menu-heading">Interface</div>
                <!-- Interface -->
                @if (Session::get('akses_id') == '1')
                    <a class="nav-link {{ $nav == 'role' ?'active':'' }}" href="{{ route('role.index') }}">
                        <div class="sb-nav-link-icon"><i class="fas fa-key fa-sm"></i></div>Role
                    </a>
                    <a class="nav-link {{ $nav == 'user' ?'active':'' }}" href="{{ route('user.index') }}">
                        <div class="sb-nav-link-icon"><i class="fas fa-user fa-sm"></i></div>User
                    </a>
                @endif
                <a class="nav-link {{ $nav == 'kategori-biaya' ?'active':'' }}" href="{{ route('kategori-biaya.index') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>Kategori Biaya
                </a>
                
            </div>
        </div>
        <!-- <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        Start Bootstrap
                    </div> -->
    </nav>
</div>