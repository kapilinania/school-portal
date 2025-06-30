
    
        <!-- Header -->
        <div class="header">
            <div class="header-left">
                <a href="{{ url('/') }}" class="logo">
                    <img src="{{ asset('assets/img/logo.png') }}" alt="Logo">
                </a>
                <a href="{{ url('/') }}" class="logo logo-small">
                    <img src="{{ asset('assets/img/logo-small.png') }}" alt="Logo" width="30" height="30">
                </a>
            </div>
            <div class="menu-toggle">
                <a href="javascript:void(0);" id="toggle_btn">
                    <i class="fas fa-bars"></i>
                </a>
            </div>

            <div class="top-nav-search">
                <form>
                    <input type="text" class="form-control" placeholder="Search here">
                    <button class="btn" type="submit"><i class="fas fa-search"></i></button>
                </form>
            </div>
            <a class="mobile_btn" id="mobile_btn">
                <i class="fas fa-bars"></i>
            </a>

            <ul class="nav user-menu">
                <li class="nav-item dropdown noti-dropdown language-drop me-2">
                    <a href="#" class="dropdown-toggle nav-link header-nav-list" data-bs-toggle="dropdown">
                        <img src="{{ asset('assets/img/icons/header-icon-02.svg') }}" alt="">
                    </a>
                    <div class="dropdown-menu">
                        <div class="noti-content">
                            <div>
                                <a class="dropdown-item active" href="javascript:;"><i class="flag flag-in me-2"></i>India</a>
                                <a class="dropdown-item" href="javascript:;"><i class="flag flag-lr me-2"></i>English</a>
                            </div>
                        </div>
                    </div>
                </li>

                <li class="nav-item dropdown noti-dropdown me-2">
                    <a href="#" class="dropdown-toggle nav-link header-nav-list" data-bs-toggle="dropdown">
                        <img src="{{ asset('assets/img/icons/header-icon-05.svg') }}" alt="">
                    </a>
                    <div class="dropdown-menu notifications">
                        <div class="topnav-dropdown-header">
                            <span class="notification-title">Notifications</span>
                            <a href="javascript:void(0)" class="clear-noti"> Clear All </a>
                        </div>

                        {{-- <div class="noti-content">
                            <ul class="notification-list">
                                <li class="notification-message">
                                    <a href="#">
                                        <div class="media d-flex">
                                            <span class="avatar avatar-sm flex-shrink-0">
                                                <img class="avatar-img rounded-circle" alt="User Image" src="{{ asset('assets/img/profiles/avatar-02.jpg') }}">
                                            </span>
                                            <div class="media-body flex-grow-1">
                                                <p class="noti-details"><span class="noti-title">Carlson Tech</span> has approved <span class="noti-title">your estimate</span></p>
                                                <p class="noti-time"><span class="notification-time">4 mins ago</span></p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="notification-message">
                                    <a href="#">
                                        <div class="media d-flex">
                                            <span class="avatar avatar-sm flex-shrink-0">
                                                <img class="avatar-img rounded-circle" alt="User Image" src="{{ asset('assets/img/profiles/avatar-11.jpg') }}">
                                            </span>
                                            <div class="media-body flex-grow-1">
                                                <p class="noti-details"><span class="noti-title">International Software Inc</span> has sent you an invoice in the amount of <span class="noti-title">₹ 218</span></p>
                                                <p class="noti-time"><span class="notification-time">6 mins ago</span></p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="notification-message">
                                    <a href="#">
                                        <div class="media d-flex">
                                            <span class="avatar avatar-sm flex-shrink-0">
                                                <img class="avatar-img rounded-circle" alt="User Image" src="{{ asset('assets/img/profiles/avatar-17.jpg') }}">
                                            </span>
                                            <div class="media-body flex-grow-1">
                                                <p class="noti-details"><span class="noti-title">John Hendry</span> sent a cancellation request <span class="noti-title">Apple iPhone XR</span></p>
                                                <p class="noti-time"><span class="notification-time">8 mins ago</span></p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="notification-message">
                                    <a href="#">
                                        <div class="media d-flex">
                                            <span class="avatar avatar-sm flex-shrink-0">
                                                <img class="avatar-img rounded-circle" alt="User Image" src="{{ asset('assets/img/profiles/avatar-13.jpg') }}">
                                            </span>
                                            <div class="media-body flex-grow-1">
                                                <p class="noti-details"><span class="noti-title">Mercury Software Inc</span> added a new product <span class="noti-title">Apple MacBook Pro</span></p>
                                                <p class="noti-time"><span class="notification-time">12 mins ago</span></p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div> --}}

                        <div class="noti-content">
                            <ul class="notification-list">
                                @if(!empty($logs))
                                    @foreach($logs as $log)
                                        <li class="notification-message">
                                            <a href="#">
                                                <div class="media d-flex">
                                                    <span class="avatar avatar-sm flex-shrink-0">
                                                        <img class="avatar-img rounded-circle" alt="User Image" src="{{ asset('assets/img/ball.png') }}"> <!-- Use a default avatar image -->
                                                    </span>
                                                    <div class="media-body flex-grow-1">
                                                        <p class="noti-details">
                                                            <span class="noti-title">
                                                                
                                                            </span>
                                                             {{ $log->message }} <!-- Display log message -->
                                                        </p>
                                                        <p class="noti-time"><span class="notification-time">{{ $log->created_at->diffForHumans() }}</span></p>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                    @endforeach
                                @else
                                    <li class="notification-message text-center mt-2">
                                        <p>No important logs available.</p>
                                    </li>
                                @endif
                            </ul>
                        </div>
                        

                        <div class="topnav-dropdown-footer">
                            <a href="#">View all Notifications</a>
                        </div>
                    </div>
                </li>

                <li class="nav-item zoom-screen me-2">
                    <a href="#" class="nav-link header-nav-list win-maximize">
                        <img src="{{ asset('assets/img/icons/header-icon-04.svg') }}" alt="">
                    </a>
                </li>

                {{-- <li class="nav-item dropdown has-arrow new-user-menus">
                    <a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
                        <span class="user-img">
                            <img class="rounded-circle" src="{{ asset('assets/img/profiles/avatar-01.jpg') }}" width="31" alt="admin">
                            <div class="user-text">
                                <h6>
                                    @if (Auth::check())
                                     {{ Auth::user()->name }}
                                    @endif
                                </h6>
                                <p class="text-muted mb-0">Administrator</p> 
                            </div>
                        </span>
                    </a>
                    <div class="dropdown-menu">
                        <div class="user-header">
                            <div class="avatar avatar-sm">
                                <img src="{{ asset('assets/img/profiles/avatar-01.jpg') }}" alt="User Image" class="avatar-img rounded-circle">
                            </div>
                            <div class="user-text">
                                <h6>
                                    @if (Auth::check())
                                     {{ Auth::user()->name }}
                                    @endif</h6>
                                <p class="text-muted mb-0">Administrator</p>
                            </div>
                        </div>
                        <a class="dropdown-item" href="{{ route('admin.profile') }}">My Profile</a>
                        
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                        <a class="dropdown-item" href="{{ route('logout') }}" 
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                       

                    </div>
                </li> --}}

                <!-- Dropdown Menu -->
<!-- Dynamic Profile Image -->
<li class="nav-item dropdown has-arrow new-user-menus">
    <a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
        <span class="user-img">
            @if (Auth::check())
                @if (Auth::user() instanceof App\Models\Student)
                    <!-- Student Profile Image -->
                    <img class="rounded-circle" 
                         src="{{ Auth::user()->photo ? asset('storage/' . Auth::user()->photo) : asset('assets/img/default-student.png') }}" 
                         width="31" alt="{{ Auth::user()->name }}">
                @elseif (Auth::user() instanceof App\Models\Teacher)
                    <!-- Teacher Profile Image -->
                    <img class="rounded-circle" 
                         src="{{ Auth::user()->profile_image ? asset('storage/' . Auth::user()->profile_image) : asset('assets/img/default-teacher.png') }}" 
                         width="31" alt="{{ Auth::user()->name }}">
                @else
                    <!-- Default User Profile Image (For Admin or Other Roles) -->
                    <img class="rounded-circle" 
                         src="{{ asset('assets/img/admin.png') }}" 
                         width="31" alt="User">
                @endif
            @else
                <!-- Default Image for Guest -->
                <img class="rounded-circle" 
                     src="{{ asset('assets/img/admin.png') }}" 
                     width="31" alt="Guest">
            @endif

            <div class="user-text">
                <h6>
                    @if (Auth::check())
                        {{ Auth::user()->name }}
                    @endif
                </h6>
                <p class="text-muted mb-0">
                    @if (Auth::check())
                        @if (Auth::user() instanceof App\Models\Student)
                            Student
                        @elseif (Auth::user() instanceof App\Models\Teacher)
                            Teacher
                        @else
                            Administrator
                        @endif
                    @else
                        Guest
                    @endif
                </p>
            </div>
        </span>
    </a>
    <div class="dropdown-menu">
        <div class="user-header">
            <div class="avatar avatar-sm">
                @if (Auth::check())
                    @if (Auth::user() instanceof App\Models\Student)
                        <!-- Student Avatar -->
                        <img src="{{ Auth::user()->photo ? asset('storage/' . Auth::user()->photo) : asset('assets/img/default-student.png') }}" 
                             alt="{{ Auth::user()->name }}" class="avatar-img rounded-circle">
                    @elseif (Auth::user() instanceof App\Models\Teacher)
                        <!-- Teacher Avatar -->
                        <img src="{{ Auth::user()->profile_image ? asset('storage/' . Auth::user()->profile_image) : asset('assets/img/default-teacher.png') }}" 
                             alt="{{ Auth::user()->name }}" class="avatar-img rounded-circle">
                    @else
                        <!-- Default Avatar for Other Users -->
                        <img src="{{ asset('assets/img/admin.png') }}" 
                             alt="User Image" class="avatar-img rounded-circle">
                    @endif
                @else
                    <!-- Guest Avatar -->
                    <img src="{{ asset('assets/img/admin.png') }}" 
                         alt="Guest Image" class="avatar-img rounded-circle">
                @endif
                
            </div>
            <div class="user-text">
                <h6>
                    @if (Auth::check())
                        {{ Auth::user()->name }}
                    @endif
                </h6>
                <p class="text-muted mb-0">
                    @if (Auth::check())
                        @if (Auth::user() instanceof App\Models\Student)
                            Student
                        @elseif (Auth::user() instanceof App\Models\Teacher)
                            Teacher
                        @else
                            Administrator
                        @endif
                    @else
                        Guest
                    @endif
                </p>
            </div>
        </div>
        <!-- Profile and Logout Links -->
        @if(Auth::check())
            <a class="dropdown-item" href="{{ route('admin.profile') }}">My Profile</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            <a class="dropdown-item" href="{{ route('logout') }}" 
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                Logout
            </a>
        @endif
    </div>
</li>



                

            </ul>
        </div>
        
