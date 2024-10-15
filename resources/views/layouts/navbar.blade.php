<div class="top_nav">
    <div class="nav_menu">
        <div class="nav toggle">
            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
        </div>
        <nav class="nav navbar-nav">
            <ul class="navbar-right">
                <li class="nav-item dropdown open" style="padding-left: 15px;">
                    <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                    <img src="{{ Auth::user()->profile_picture ? Storage::url(Auth::user()->profile_picture) : asset('images/default-profile.png') }}"> {{ Auth::user()->name }}
                    </a>
                    <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                        <!-- Link ke profil -->
                        <a class="dropdown-item" href="{{ route('profile') }}"> Profile</a>
                        <a class="dropdown-item" href="javascript:;">
                            <span>Settings</span>
                        </a>
                        <a class="dropdown-item" href="javascript:;">Help</a>
                        <a class="dropdown-item" href="login.html">
                            <i class="fa fa-sign-out pull-right"></i> Log Out
                        </a>
                    </div>
                </li>
                
                <!-- Bagian lain tidak berubah -->
                <li role="presentation" class="nav-item dropdown open">
                    <a href="javascript:;" class="dropdown-toggle info-number" id="navbarDropdown1" data-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-envelope-o"></i>
                    </a>
                    <ul class="dropdown-menu list-unstyled msg_list" role="menu" aria-labelledby="navbarDropdown1">
                        <li class="nav-item">
                            <div class="text-center">
                                <a class="dropdown-item">
                                    <strong>See All Alerts</strong>
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</div>