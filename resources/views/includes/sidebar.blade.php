<!-- Left Sidenav -->
<div class="left-sidenav">
    <div class="main-icon-menu">
        <nav class="nav">
            
            <a href="#Dashboard" class="nav-link" data-toggle="tooltip-custom" data-placement="top" title="" data-original-title="Dashboard">
                <i class="text-white mdi mdi-speedometer mdi-18px"></i>
            </a>
            
            <a href="#Users" class="nav-link" data-toggle="tooltip-custom" data-placement="top" title="" data-original-title="Users">
                <i class="text-white mdi mdi-account-group-outline mdi-18px"></i>
            </a>

            <a href="#PushNotification" class="nav-link" data-toggle="tooltip-custom" data-placement="top" title="" data-original-title="Push Notification">
                <i class="text-white mdi mdi-bell mdi-18px"></i>
            </a>

            <a href="#SocialMediaLinks" class="nav-link" data-toggle="tooltip-custom" data-placement="top" title="" data-original-title="Social Media Links">
                <i class="text-white mdi mdi-link mdi-18px"></i>
            </a>

            <a href="#Faqs" class="nav-link" data-toggle="tooltip-custom" data-placement="top" title="" data-original-title="Faqs">
                <i class="text-white mdi mdi-chat mdi-18px"></i>
            </a>

            <a href="#Extras" class="nav-link" data-toggle="tooltip-custom" data-placement="top" title="" data-original-title="Extras">
                <i class="text-white mdi mdi-apps mdi-18px"></i>
            </a>

            <a href="#Settings" class="nav-link" data-toggle="tooltip-custom" data-placement="top" title="" data-original-title="Settings">
                <i class="text-white mdi mdi-settings"></i>
            </a>
            
        </nav>
    </div>

    <div class="main-menu-inner">
        <div class="menu-body slimscroll">
            
            <div id="Dashboard" class="main-icon-menu-pane">
                <div class="title-box">
                    <h6 class="menu-title">Dashboard</h6>       
                </div>
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/dashboard') }}">
                            <span class="w-100"> Dashboard</span> <span class="menu-arrow"><i class="fas fa-arrow-alt-circle-down"></i></span>
                        </a>
                    </li>
                </ul>
            </div>
            
            <div id="Users" class="main-icon-menu-pane">
                <div class="title-box">
                    <h6 class="menu-title">Users</h6>       
                </div>
                <ul class="nav">
                    
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/all_users')}}">
                            <span class="w-100">All Users</span> <span class="menu-arrow"><i class="fas fa-arrow-alt-circle-down"></i></span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/active_users')}}">
                            <span class="w-100">Active Users</span> <span class="menu-arrow"><i class="fas fa-arrow-alt-circle-down"></i></span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/blocked_users')}}">
                            <span class="w-100">Blocked Users</span> <span class="menu-arrow"><i class="fas fa-arrow-alt-circle-down"></i></span>
                        </a>
                    </li>
                    
                </ul>
            </div>

            <div id="PushNotification" class="main-icon-menu-pane">
                <div class="title-box">
                    <h6 class="menu-title">Push Notification</h6>       
                </div>
                <ul class="nav">
                    
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/send_notification')}}">
                            <span class="w-100">Send Notification</span> <span class="menu-arrow"><i class="fas fa-arrow-alt-circle-down"></i></span>
                        </a>
                    </li>
                    
                </ul>
                
            </div>

            <div id="SocialMediaLinks" class="main-icon-menu-pane">
                <div class="title-box">
                    <h6 class="menu-title">Social Media Links</h6>       
                </div>
                <ul class="nav">
                    
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/social_media_links')}}">
                            <span class="w-100">Update Social Media Links</span> <span class="menu-arrow"><i class="fas fa-arrow-alt-circle-down"></i></span>
                        </a>
                    </li>
                    
                </ul>
                
            </div>

            <div id="Faqs" class="main-icon-menu-pane">
                <div class="title-box">
                    <h6 class="menu-title">Faqs</h6>       
                </div>
                <ul class="nav">
                    
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/add_faq')}}">
                            <span class="w-100">Add Faq</span> <span class="menu-arrow"><i class="fas fa-arrow-alt-circle-down"></i></span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/view_faqs')}}">
                            <span class="w-100">View Faqs</span> <span class="menu-arrow"><i class="fas fa-arrow-alt-circle-down"></i></span>
                        </a>
                    </li>
                    
                </ul>
                
            </div>

            <div id="Extras" class="main-icon-menu-pane">
                <div class="title-box">
                    <h6 class="menu-title">Extras</h6>       
                </div>
                <ul class="nav">
                    
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/daily_coins_limit')}}">
                            <span class="w-100">Set Daily Coins Limit</span> <span class="menu-arrow"><i class="fas fa-arrow-alt-circle-down"></i></span>
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/referal_bonus')}}">
                            <span class="w-100">Referal Bonus %</span> <span class="menu-arrow"><i class="fas fa-arrow-alt-circle-down"></i></span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/coins_per_click')}}">
                            <span class="w-100">Default Coins Per Click</span> <span class="menu-arrow"><i class="fas fa-arrow-alt-circle-down"></i></span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/coin_price')}}">
                            <span class="w-100">Coin Price</span> <span class="menu-arrow"><i class="fas fa-arrow-alt-circle-down"></i></span>
                        </a>
                    </li>
                    
                </ul>
                
            </div>

            <div id="Settings" class="main-icon-menu-pane">
                <div class="title-box">
                    <h6 class="menu-title">Settings</h6>       
                </div>
                <ul class="nav">
                    
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/change_password')}}">
                            <span class="w-100">Change Password</span> <span class="menu-arrow"><i class="fas fa-arrow-alt-circle-down"></i></span>
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/logout')}}">
                            <span class="w-100">Logout</span> <span class="menu-arrow"><i class="fas fa-arrow-alt-circle-down"></i></span>
                        </a>
                    </li>

                </ul>
            </div>
            
        </div>
    </div>
</div>