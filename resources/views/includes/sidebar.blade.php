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
            <li>
                <a href="javascript: void(0);"> <i data-feather="home" class="align-self-center menu-icon"></i><span>Menu</span><span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
                <ul class="nav-second-level" aria-expanded="false">
                    <li class="nav-item"><a class="nav-link" href="{{ route('dashboard') }}"><i class="ti-control-record"></i>Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('user.index') }}"><i class="ti-control-record"></i>User</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('structural.index') }}"><i class="ti-control-record"></i>Struktural</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('jobtask.index') }}"><i class="ti-control-record"></i>Pekerjaan</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('jobtask.index') }}"><i class="ti-control-record"></i>Berita</a></li>
                </ul>
            </li>           
        </ul>

    </div>
</div>