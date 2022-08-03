            <!-- Top Bar Start -->
            <div class="topbar">            
                <!-- Navbar -->
                <nav class="navbar-custom">    
                    <ul class="list-unstyled topbar-nav float-right mb-0">  

                        <li class="dropdown">
                            <a class="nav-link dropdown-toggle waves-effect waves-light nav-user" data-toggle="dropdown" href="#" role="button"
                                aria-haspopup="false" aria-expanded="false">
                                <span class="ml-1 nav-user-name hidden-sm">{{Auth::user()->name}}</span>
                                <img src="{{Storage::url(Auth::user()->user_photo)}}" alt="profile-user" class="rounded-circle" />                                 
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="#"><i data-feather="user" class="align-self-center icon-xs icon-dual mr-1"></i> Profile</a>
                                <a class="dropdown-item" href="#"><i data-feather="settings" class="align-self-center icon-xs icon-dual mr-1"></i> Settings</a>
                                <div class="dropdown-divider mb-0"></div>
                                {{-- <a class="dropdown-item" href="#"><i data-feather="power" class="align-self-center icon-xs icon-dual mr-1"></i> Logout</a> --}}
                                <a href="{{ route('logout') }}" class="dropdown-item"  onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i data-feather="power" class="align-self-center icon-xs icon-dual mr-1"></i>
                                    Logout
                                </a>
                                
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </div>
                        </li>
                    </ul><!--end topbar-nav-->
                    
                </nav>
                <!-- end navbar-->
            </div>