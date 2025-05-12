<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>@yield('title') - DALMA Project</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Favicons -->
    <link href="{{ asset('img/favicon.png') }}" rel="icon">
    <link href="{{ asset('img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    @yield('header_styles')
</head>

<body class="index-page">

    <header id="header" class="header d-flex align-items-center fixed-top">
        <div class="container-fluid position-relative d-flex align-items-center justify-content-between">

            <a href="{{ route('home') }}" class="logo d-flex align-items-center me-auto me-xl-0">
                <img src="{{ asset('images/logo.jpg') }}" alt="">
                <div>
                    <h1>Daraja La Mafanikio</h1>
                    <i>TVET Skills Development and Job Linkage.</i>
                </div>
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="{{ route('home') }}" class="{{ Request::url() == route('home') ? 'active' : '' }}">Home</a></li>
                    <li><a href="{{ route('about') }}" class="{{ Request::url() == route('about') ? 'active' : '' }}">About</a></li>
                    <li><a href="{{ route('elearning') }}" class="{{ Request::url() == route('elearning') ? 'active' : '' }}">E-Learning</a></li>
                    <li class="dropdown"><a href="#"><span>Jobs</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                        <ul>
                            <li><a href="{{ route('jobs.index') }}">Job List</a></li>
                            <li><a href="{{ route('jobs.create') }}">Post a Job</a></li>
                        </ul>
                    </li>
                    <li><a href="{{ route('contact') }}" class="{{ Request::url() == route('contact') ? 'active' : '' }}">Contact</a></li>
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>

            @auth
            <a class="nav-link dropdown">
                <a class="nav-link dropdown-toggle {{ Request::url() == '/profile' ? 'active' : '' }}" href="#" data-bs-toggle="dropdown" aria-expanded="true"><i class="bi bi-person-circle"></i><i class="bi bi-angle-down"></i></a>
                <ul class="dropdown-menu dropdown-menu-lg-start" data-bs-popper="dynamic" id="categoriesDropDownNav">
                    <li><a class="dropdown-item" href="{{ route('profile.edit') }}"><i class="bi bi-person-circle"></i>&nbsp;My Profile</a></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a class="dropdown-item" href="route('logout')" onclick="event.preventDefault();
                            this.closest('form').submit();"><i class="bi bi-box-arrow-right"></i>&nbsp;{{ __('Log Out') }}
                            </a>
                        </form>
                    </li>
                </ul>
            </a>
            @else
            <a class="nav-link {{ Request::url() == route('getstarted') ? 'active' : '' }}" href="{{ route('getstarted') }}"><i class="bi bi-person-circle"></i></a>
            @endauth

        </div>
    </header>

    @yield('content')



    <footer id="footer" class="footer position-relative light-background">

        <div class="container footer-top">
            <div class="row gy-4">
                <div class="col-lg-5 col-md-12 footer-about">
                    <a href="index.html" class="logo d-flex align-items-center">
                        <span class="sitename">Daraja La Mafanikio</span>
                    </a>
                    <p>Empowering TVET graduates from Informal Settlements in Kenya.</p>
                    <div class="social-links d-flex mt-4">
                        <a href=""><i class="bi bi-twitter-x"></i></a>
                        <a href=""><i class="bi bi-facebook"></i></a>
                        <a href=""><i class="bi bi-instagram"></i></a>
                        <a href=""><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>

                <div class="col-lg-2 col-6 footer-links">
                    <h4>Useful Links</h4>
                    <ul>
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li><a href="{{ route('about') }}">About us</a></li>
                        <li><a href="{{ route('services') }}">Services</a></li>
                        <li><a href="#">Terms of service</a></li>
                        <li><a href="#">Privacy policy</a></li>
                    </ul>
                </div>

                <div class="col-lg-2 col-6 footer-links">
                    <h4>Our Services</h4>
                    <ul>
                        <li><a href="#">Employability and Entrepreneurship Training</a></li>
                        <li><a href="#">Linking TVET graduates to employment opportunities</a></li>
                        <li><a href="#">Youth Empowerment</a></li>
                        <li><a href="#"></a></li>
                        <li><a href="#">Youth Empowerment</a></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
                    <h4>Contact Us</h4>
                    <p>{{ config('app.address') }}</p>
                    <p>{{ config('app.city') }}, {{ config('app.country') }}</p>
                    <p class="mt-4"><strong>Phone:</strong> <span>{{ config('app.phone') }}</span></p>
                    <p><strong>Email:</strong> <span>{{ config('app.email') }}</span></p>
                </div>

            </div>
        </div>

        <div class="container copyright text-center mt-4">
            <p>© <span>Copyright</span> <strong class="sitename">Daraja La Mafanikio</strong> <span>All Rights Reserved</span></p>
            
        </div>

    </footer>

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    @yield('footer_scripts')

</body>

</html>
