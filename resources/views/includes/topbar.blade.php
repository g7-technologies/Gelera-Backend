<div class="topbar">
    <div class="topbar-left">
        <a href="{{ url('dashboard') }}" class="logo">
            <span>
                <img src="{{ asset('public/images/logo.png') }}" alt="logo-small" width="80">
            </span>
        </a>
    </div>
    <nav class="navbar-custom">    
        <ul class="list-unstyled topbar-nav float-right mb-0"> 
            
            <li class="dropdown">
                <a class="nav-link dropdown-toggle waves-effect waves-light nav-user" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    <i class="mdi mdi-account mdi-18px" height="800"></i>
                    <span class="ml-1 nav-user-name hidden-sm">{{ Auth::guard('admin')->user()->name}} <i class="mdi mdi-chevron-down"></i> </span>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="{{url('/change_password')}}"><i class="fa fa-lock text-muted mr-2"></i> Change Password  </a>
                    <form action="{{ url('/logout') }}" method="get">
                    <button type="submit" class="dropdown-item"><i class="dripicons-exit text-muted mr-2"></i> Logout</button>
                    </form>
                </div>
            </li>
        </ul>
        <ul class="list-unstyled topbar-nav mb-0">                        
            <li>
                <button class="button-menu-mobile nav-link waves-effect waves-light">
                    <i class="dripicons-menu nav-icon"></i>
                </button>
            </li>
        </ul>
    </nav>
</div>