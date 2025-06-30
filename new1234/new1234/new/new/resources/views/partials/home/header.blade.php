<!-- Topbar Start -->
<div class="container-fluid bg-dark">
    <div class="row py-2 px-lg-5">
        <div class="col-lg-6 text-center text-lg-left mb-2 mb-lg-0">
            <div class="d-inline-flex align-items-center text-white">
                <small><i class="fa fa-phone-alt mr-2"></i>+919828522814</small>
                <small class="px-3">|</small>
                <small><i class="fa fa-envelope mr-2"></i>inaniyakapil2000@gmail.com</small>
            </div>
        </div>
        <div class="col-lg-6 text-center text-lg-right">
            <div class="d-inline-flex align-items-center">
                <a class="text-white px-2" href="#"><i class="fab fa-facebook-f"></i></a>
                <a class="text-white px-2" href="#"><i class="fab fa-twitter"></i></a>
                <a class="text-white px-2" href="#"><i class="fab fa-linkedin-in"></i></a>
                <a class="text-white px-2" href="#"><i class="fab fa-instagram"></i></a>
                <a class="text-white pl-2" href="#"><i class="fab fa-youtube"></i></a>
            </div>
        </div>
    </div>
</div>
<!-- Topbar End -->

<!-- Navbar Start -->
<div class="container-fluid p-0">
    <nav class="navbar navbar-expand-lg bg-white navbar-light py-3 py-lg-0 px-lg-5">
        <a href="{{ route('home') }}" class="navbar-brand ml-lg-3">
            <h1 class="m-0 text-uppercase text-primary"><i class="fa fa-book-reader mr-3"></i>Education</h1>
        </a>
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-between px-lg-3" id="navbarCollapse">
            <div class="navbar-nav mx-auto py-0">
                <a href="{{ route('home') }}" class="nav-item nav-link @if(request()->routeIs('home')) active @endif">Home</a>
                <a href="{{ route('about') }}" class="nav-item nav-link @if(request()->routeIs('about')) active @endif">About</a>
                <a href="{{ route('course') }}" class="nav-item nav-link @if(request()->routeIs('course')) active @endif">Courses</a>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Pages</a>
                    <div class="dropdown-menu m-0">
                        <a href="{{ route('detail') }}" class="dropdown-item">Course Detail</a>
                        <a href="{{ route('feature') }}" class="dropdown-item">Our Features</a>
                        <a href="{{ route('team') }}" class="dropdown-item">Instructors</a>
                        <a href="{{ route('testimonial') }}" class="dropdown-item">Testimonial</a>
                    </div>
                </div>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Login As</a>
                    <div class="dropdown-menu m-0">
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ url('/dashboard') }}" class="dropdown-item">Dashboard</a>
                            @else
                                <a href="{{ route('student.login') }}" class="dropdown-item">Student Login</a>
                                <a href="{{ route('teacher.login') }}" class="dropdown-item">Teacher Login</a>
                                <a href="{{ route('login') }}" class="dropdown-item">Admin Login</a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="dropdown-item">Admin Register</a>
                                @endif
                            @endauth
                        @endif
                    </div>
                </div>
                <a href="{{ route('contact') }}" class="nav-item nav-link @if(request()->routeIs('contact')) active @endif">Contact</a>
            </div>
            <a href="#" class="btn btn-primary py-2 px-4 d-none d-lg-block">Join Us</a>
        </div>
    </nav>
</div>
<!-- Navbar End -->
