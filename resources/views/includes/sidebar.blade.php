<div class="left-sidenav">
    <!-- LOGO -->
    <div class="brand">
        <a href="/admin/dashboard" class="logo">
            <span>
                <img src="{{url('logo-polri.png')}}" alt="logo-large" class="logo-lg logo-dark">
            </span>
            <span>
                <img src="{{url('logo-polri.png')}}" alt="logo-large" class="logo-lg logo-light">
                <img src="{{url('logo-polri.png')}}" alt="logo-large" class="logo-lg logo-dark">
            </span>
        </a>
    </div>
    <!--end logo-->
    <div class="menu-content h-100" data-simplebar>
        <ul class="metismenu left-sidenav-menu">
            <li class="menu-label mt-0">Navigation</li>
                @if (Auth::user()->user_role == 'admin')
                <li class="nav-item"><a class="nav-link" href="{{ route('dashboard') }}"><i class="ti-pie-chart"></i>Dashboard</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('user.index') }}"><i class="ti-user"></i>User</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('structural.index') }}"><i class="ti-link"></i>Struktural</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('sector.index') }}"><i class="ti-layers-alt"></i>Bidang</a></li>
                @else
                    <li class="nav-item"><a class="nav-link" href="{{ route('dashboard') }}"><i class="ti-pie-chart"></i>Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('jobtask.index') }}"><i class="ti-briefcase"></i>Pekerjaan</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('report.index') }}"><i class="ti-notepad"></i>Laporan</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('news.index') }}"><i class="ti-announcement"></i>Berita</a></li>
                @endif
        </ul>

    </div>
</div>