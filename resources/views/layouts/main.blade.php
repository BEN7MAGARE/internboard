<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title') - DALMA Project</title>
    <link href="//fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,700;1,400;1,600&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style-starter.css') }}">
    <link href="{{ asset('swiper/swiper-bundle.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/iziToast.min.css') }}" rel="stylesheet">
    @yield('header_styles')
</head>

<body>
    <header id="site-header" class="fixed-top">
        <div class="container-fluid">
            <nav class="navbar navbar-expand-lg navbar-light stroke py-lg-0">

                <h1><a class="navbar-brand pe-xl-5 pe-lg-4" href="/">
                        <!-- <img src="/img/logo1.jpg" alt="Logo" height="40px"> -->
                        <span class="sublog">DALMA</span>Project
                    </a>
                </h1>

                <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon fa icon-expand fa-bars"></span>
                    <span class="navbar-toggler-icon fa icon-close fa-times"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarScroll">

                    <ul class="navbar-nav me-lg-auto my-2 my-lg-0 navbar-nav-scroll" id="mainNavBar">

                        <li class="nav-item">
                            <a class="nav-link {{ Request::url() == '/>' ? 'active' : '' }}" aria-current="page"
                                href="/">Home</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link {{ Request::url() == 'elearning' ? 'active' : '' }}"
                                href="{{ route('elearning') }}">E-Learning</a>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link {{ Request::url() == 'jobs' || Request::url() == 'jobs/create' || Request::url() == 'jobs-search' ? 'active' : '' }}"
                                href="{{ route('jobs.index') }}">Jobs / Opportunities</a>
                            {{-- <a class="nav-link dropdown-toggle {{ Request::url() == 'jobs' || Request::url() == 'jobs/create' || Request::url() == 'jobs-search' ? 'active' : '' }}"
                                href="#" data-bs-toggle="dropdown" aria-expanded="true">Jobs / Opportunities <i
                                    class="fa fa-angle-down"></i></a>
                            <ul class="dropdown-menu dropdown-menu-lg-start" data-bs-popper="dynamic"
                                id="categoriesDropDownNav">
                            </ul> --}}
                        </li>

                        <li class="nav-item">
                            <form action="{{ route('jobs.search') }}" method="POST" class="d-sm-flex" id="searchForm">
                                <input class="form-control me-2" name="searchTerm" type="search"
                                    placeholder="Search jobs..." aria-label="Search" id="searchTerm" required="">
                                <button class="btn btn-warning btn-sm" type="submit"><span class="fas fa-search"
                                        aria-hidden="true"></span></a></button>
                            </form>
                        </li>
                    </ul>

                    <ul class="navbar-nav mt-lg-0 mt-2">
                        <li class="nav-item me-lg-3">
                            <a href="{{ route('jobs.create') }}" class="btn btn-primary"><i
                                    class="fa fa-window-maximize"></i>&nbsp;&nbsp;Post a job</a>
                        </li>
                        @auth
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle {{ Request::url() == 'profile-jobs' || Request::url() == 'profile' || Request::url() == 'jobs-search' ? 'active' : '' }}" href="#" data-bs-toggle="dropdown"
                                    aria-expanded="true"><i
                                        class="fa fa-user"></i>&nbsp;{{ auth()->user()->last_name }}&nbsp;<i
                                        class="fa fa-angle-down"></i></a>
                                <ul class="dropdown-menu dropdown-menu-lg-start" data-bs-popper="dynamic"
                                    id="categoriesDropDownNav">
                                    <li><a class="dropdown-item" href="{{ route('profile.edit') }}"><i class="fa fa-user"></i>&nbsp;My Profile</a></li>
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <a class="dropdown-item" href="route('logout')"
                                                onclick="event.preventDefault();
                                                this.closest('form').submit();"><i class="fa fa-sign-out-alt"></i>&nbsp;{{ __('Log Out') }}
                                            </a>
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link {{ Request::url() == '/>' ? 'active' : '' }}"
                                    href="{{ route('login') }}"><i class="fa fa-sign-in-alt"></i> Login</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ Request::url() == '/>' ? 'active' : '' }}"
                                    href="{{ route('getstarted') }}"><i class="fa fa-user-plus"></i>
                                    Signup</a>
                            </li>
                        @endauth
                    </ul>
                </div>

                <div class="mobile-position">
                    <nav class="navigation">
                        <div class="theme-switch-wrapper">
                            <label class="theme-switch" for="checkbox">
                                <input type="checkbox" id="checkbox">
                                <div class="mode-container">
                                    <i class="gg-sun"></i>
                                    <i class="gg-moon"></i>
                                </div>
                            </label>
                        </div>
                    </nav>
                </div>

            </nav>
        </div>
    </header>

    @yield('content')

    <section class="w3l-footer-29-main">
        <div class="footer-29 py-5">
            <div class="container py-lg-4">
                <div class="row footer-top-29">
                    <div class="col-lg-4 col-md-6 footer-list-29 footer-1 pe-lg-5">
                        <div class="footer-logo mb-4">
                            <h2><a class="navbar-brand" href="/">
                                    <span class="sublog">DALMA</span> Project
                                </a></h2>
                        </div>
                        <p></p>

                        <div class="w3l-two-buttons mt-4">
                            <a href="{{ route('jobs.index') }}" class="btn btn-primary btn-style"> Get Started </a>
                        </div>

                        <div class="main-social-footer-29 mt-5">
                            <a href="#facebook" class="facebook"><span class="fab fa-facebook-f"></span></a>
                            <a href="#twitter" class="twitter"><span class="fab fa-twitter"></span></a>
                            <a href="#instagram" class="instagram"><span class="fab fa-instagram"></span></a>
                            <a href="#linkedin" class="linkedin"><span class="fab fa-linkedin-in"></span></a>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6 footer-list-29 footer-2 mt-sm-0 mt-5">

                        <ul>
                            <h6 class="footer-title-29">Links</h6>
                            <li><a href="{{ route('about') }}">About Us</a></li>
                            <li><a href="#services">Services</a></li>
                            <li><a href="{{ route('contact') }}">Contact us</a></li>

                        </ul>
                    </div>

                    <div class="col-lg-2 col-md-6 footer-list-29 footer-3 mt-lg-0 mt-5">
                        <!-- <h6 class="footer-title-29">Jobs</h6>
                        <ul>
                            <li><a href="#traning">Web Design</a></li>
                            <li><a href="#traning">Development</a></li>
                            <li><a href="#traning">Marketing Plans</a></li>
                            <li><a href="#marketplace">Digital Services</a></li>
                            <li><a href="#experts">Email Marketing</a></li>
                            <li><a href="#platform">Product Selling</a></li>
                        </ul> -->

                    </div>
                    <div class="col-lg-2 col-md-6  footer-list-29 footer-4 mt-lg-0 mt-5">
                        <!-- <h6 class="footer-title-29">More Info</h6> -->
                        <ul>
                            <!-- <li><a href="#seo">Offline SEO</a></li>
                            <li><a href="#traning">Development</a></li>
                            <li><a href="#hack">Growth Hacking</a></li>
                            <li><a href="#studio">Film Studio</a></li>
                            <li><a href="#branding">Branding</a></li>
                            <li><a href="#experts">Email Marketing</a></li>
                            <li><a href="#marketplace">Lead Generation</a></li> -->
                        </ul>
                    </div>
                    <div class="col-lg-2 col-md-6  footer-list-29 footer-4 mt-lg-0 mt-5">
                        <h6 class="footer-title-29">Support</h6>
                        <ul>
                            <li><a href="#awards">Awards</a></li>
                            <li><a href="#secutiry">Security</a></li>

                            <li><a href="#proj">Products</a></li>
                            <li><a href="#efaq">faQ</a></li>
                            <li><a href="#help">Help</a></li>
                            <li><a href="#mail">Mail Us</a></li>
                            <li><a href="#terms">Terms
                                </a></li>
                            <li><a href="#policy">Privacy Policy</a></li>

                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <section class="w3l-copyright text-center">
            <div class="container">
                <p class="copy-footer-29">© 2024 DALMA Project. All rights reserved.</p>
            </div>

            <button onclick="topFunction()" id="movetop" title="Go to top">
                <span class="fas fa-arrow-up"></span>
            </button>
            <script>
                window.onscroll = function() {
                    scrollFunction()
                };

                function scrollFunction() {
                    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                        document.getElementById("movetop").style.display = "block";
                    } else {
                        document.getElementById("movetop").style.display = "none";
                    }
                }

                function topFunction() {
                    document.body.scrollTop = 0;
                    document.documentElement.scrollTop = 0;
                }
            </script>
        </section>
    </section>

    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/theme-change.js') }}"></script>
    <script src="{{ asset('swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/iziToast.min.js') }}"></script>
    <script src="{{ asset('js/moment.js') }}"></script>
    <script src="{{ asset('js/functions.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>

    @yield('footer_scripts')
</body>

</html>
