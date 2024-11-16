<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title') - DALMA Project</title>
    <link href="//fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,700;1,400;1,600&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ route('css/style-starter.css') }}">
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
                            <a class="nav-link {{ Request::url() =="/>"?'active':'' }}" aria-current="page" href="/">Home</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link {{ Request::url() == "elearning" ? 'active' : '' }}" href="{{ route('elearning') }}">E-Learning</a>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle {{ Request::url() == "jobs" || Request::url() == "jobs/create" || Request::url() == "jobs-search" ? 'active' : '' }}" href="#" data-bs-toggle="dropdown"
                                aria-expanded="true">Jobs / Opportunities <i class="fa fa-angle-down"></i></a>
                            <ul class="dropdown-menu dropdown-menu-lg-start" data-bs-popper="dynamic"
                                id="categoriesDropDownNav">
                            </ul>
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

                        <li class="nav-item">
                            <a class="nav-link {{ Request::url() =="/>"?'active':'' }}" href="{{ route('login') }}"><i class="fa fa-sign-in-alt"></i> Login</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link {{ Request::url() =="/>"?'active':'' }}" href="{{ route('getstarted') }}"><i class="fa fa-user-plus"></i>
                                Signup</a>
                        </li>

                        <li class="nav-item me-lg-3">
                            <a href="{{ route('jobs.create') }}" class="btn btn-primary"><i
                                    class="fa fa-window-maximize"></i>&nbsp;&nbsp;Post a job</a>
                        </li>
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

    <section class="w3l-main-content" id="home">
        <div class="container">
            <div class="row align-items-center w3l-slider-grids">
                <div class="col-lg-7 w3l-slider-left-info">
                    <h6 class="title-subhny mb-2">We are</h6>
                    <h3 class="mb-2 title"><span>Daraja La Mafanikio</span></h3>
                    <h3 class="mb-4 title"><small>Bridge to Success</small></h3>
                    <p class="w3banr-p">We aim to allievate poverty in informal settlements by providing training and
                        imparting skills on employability and entrepreneurship curriculum to youths in disadvantaged and
                        informal settlements. </p>
                    <div class="w3l-buttons mt-sm-5 mt-2">
                        <a class="btn btn-primary btn-style mt-2" href="/about">Access the curriculum </a>
                        <a class="btn btn-outline-primary btn-style mt-2" href="{{ route('jobs.create') }}"> Post a job
                        </a>
                    </div>
                </div>
                <div class="col-lg-5 w3l-slider-right-info mt-lg-0 mt-5 ps-lg-5 align-items-center">
                    <div class="w3l-main-slider banner-slider">

                        <div class="slider-info">
                            <div class="w3l-slidehny-img banner-top1">
                                <img src="{{ asset('assets/img/Header.png') }}" alt=""
                                    class="radius-image img-fluid">
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="w3l-grids-3 py-3">
        <div class="container py-md-5 py-3">
            <div class="row align-items-center">
                <div class="col-lg-6 header-sec">
                    <h6 class="title-subhny mb-2">About Us</h6>
                    <h3 class="title-w3l">
                        Empowering TVET graduates from Informal Settlements in Kenya.
                    </h3>
                </div>
                <div class="col-lg-6 header-sec-paraw3 ps-lg-4">
                    <p class="">We have specially curated curriculum delivered through e-learning and in person
                        to a
                        select group of disadvantaged youths in informal settlements across Kenya to impart in them
                        skills ad technical know-how to fit the job market. We also provide a platform for employers to
                        access this skilled pool of youths to fill employment positions in their firms. </p>
                </div>
            </div>
            <div class="row bottom_grids text-left mt-lg-5 align-items-center">
                <div class="col-lg-4 col-md-6 mt-3">
                    <div class="grid-block">
                        <a href="#grids" class="d-block">
                            <div class="grid-block-infw3">
                                <div class="grid-block-icon"><span class="fas fa-book-reader text-warning"></span>
                                </div>
                                <h4 class="my-3">Training</h4>
                            </div>
                            <p class="">To provide employability and entrepreneurship skills through physical and
                                e-learning platform to trainees and graduates in the selected 6 TVET institutions
                                serving the most vulnerable
                                in the
                                Kibera and Mukuru informal settlement.</p>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mt-3">
                    <div class="grid-block active">
                        <a href="#grids" class="d-block">
                            <div class="grid-block-infw3">
                                <div class="grid-block-icon"><span class="fa fa-user-shield"></span></div>
                                <h4 class="my-3">Sponsorship</h4>
                            </div>
                            <p class="">We are sponsoring most vulnerable students from informal settlemnts and
                                provide them with resources to access the specially
                                curated training curriculum that impart employment and entrepreneural skills to
                                fit employment needs in the job market.</p>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mt-3">
                    <div class="grid-block">
                        <a href="#grids" class="d-block">
                            <div class="grid-block-infw3">
                                <div class="grid-block-icon"><span class="fa fa-briefcase text-warning"
                                        aria-hidden="true"></span>
                                </div>
                                <h4 class="my-3">Employment Mobilization</h4>
                            </div>
                            <p class="">To Mobilize SMEs proprietors, business owners, support towards youth
                                employment
                                to 400 vulnerable
                                youths from 6 selected TVETs in the informal settlements through a designed and
                                implemented web-based/USSD platform and app. </p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="w3l-circles-sec" id="circle">
        <div class="midd-w3 py-5">
            <div class="container py-lg-5 py-3">
                <div class="w3l-circles">
                    <div class="w3l-circles-infhny">
                        <div class="title-content text-left">
                            <h6 class="title-subhny mb-2">Open the future</h6>
                            <h3 class="title-w3l two">Digital Tools and Training</h3>
                        </div>
                        <p class="mt-md-4 mt-3">We provide access to digital tools and training to most vulnerable
                            youths informal settlements that improves their technical skills that in turn help them
                            improve their future. </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="w3l-img-grids" id="gridsimg">
        <div class="blog py-5" id="classes">
            <div class="container py-lg-5">
                <div class="row align-items-center">
                    <div class="col-lg-4 col-md-6 item mt-lg-0 mt-5">
                        <div class="w3img-grids-info">
                            <div class="w3img-grids-info-gd position-relative">
                                <a href="#services">
                                    <div class="page">
                                        <div class="photobox photobox_triangular photobox_scale-rotated">
                                            <div class="photobox__previewbox media-placeholder">
                                                <img class="img-fluid photobox__preview media-placeholder__media radius-image"
                                                    src="assets/images/g1.jpg" alt="">
                                            </div>
                                            <div class="photobox__info-wrapper">
                                                <div class="photobox__info"><span>Post Jobs</span></div>
                                            </div>
                                        </div>
                                    </div>
                                </a>

                                <div class="w3img-grids-info-gd-content mt-4">
                                    <a href="{{ route('jobs.create') }}" class="titile-img d-block">
                                        <h4 class="mb-2">Advertise Jobs</h4>
                                    </a>
                                    <p class="">Post jobs on this platform and get a large pool of suitable
                                        candidates
                                        and select the best to fill you job need. </p>
                                </div>

                            </div>

                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 item mt-lg-0 mt-5">
                        <div class="w3img-grids-info">
                            <div class="w3img-grids-info-gd position-relative">
                                <a href="#services">
                                    <div class="page">

                                        <div class="photobox photobox_triangular photobox_scale-rotated">
                                            <div class="photobox__previewbox media-placeholder">
                                                <img class="img-fluid photobox__preview media-placeholder__media radius-image"
                                                    src="assets/images/g2.jpg" alt="">
                                            </div>
                                            <div class="photobox__info-wrapper">
                                                <div class="photobox__info"><span>Select </span></div>
                                            </div>
                                        </div>

                                    </div>
                                </a>
                                <div class="w3img-grids-info-gd-content mt-4">
                                    <a href="#gridsimg" class="titile-img d-block">
                                        <h4 class="mb-2">Interview</h4>
                                    </a>
                                    <p class="">Select and invite the best profiles from a pool of applicants
                                        curated
                                        from a wide spectrum of disciplines. </p>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 item mt-lg-0 mt-5">
                        <div class="w3img-grids-info">
                            <div class="w3img-grids-info-gd position-relative">
                                <a href="#services">
                                    <div class="page">
                                        <div class="photobox photobox_triangular photobox_scale-rotated">
                                            <div class="photobox__previewbox media-placeholder">
                                                <img class="img-fluid photobox__preview media-placeholder__media radius-image"
                                                    src="assets/images/g3.jpg" alt="">
                                            </div>
                                            <div class="photobox__info-wrapper">
                                                <div class="photobox__info"><span> Integration</span></div>
                                            </div>

                                        </div>
                                    </div>
                                </a>
                                <div class="w3img-grids-info-gd-content mt-4">
                                    <a href="#gridsimg" class="titile-img d-block">
                                        <h4 class="mb-2">Employ</h4>
                                    </a>
                                    <p class="">Employ and help us improve lives by considering students that are
                                        most
                                        suitable for roles or positions you may have. </p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="w3l-video" id="video">
        <div class="video-mid-w3 py-5">
            <div class="container py-md-5 py-3">
                <!--/row-1-->
                <div class="row">
                    <div class="col-lg-6 mt-lg-0 mb-5 align-self pe-lg-3">
                        <div class="title-content text-left">
                            <h6 class="title-subhny mb-2">Time to grow</h6>
                            <h3 class="title-w3l two">Make better ideas happen fast
                            </h3>
                        </div>
                        <p class="mt-md-4 mt-3">Get Best Talent for your company and achieve success by having
                            committed
                            and dedicated employees ready to advance you vision. </p>
                        <div class="w3l-two-buttons">
                            <a href="{{ route('jobs.create') }}" class="btn btn-style btn-primary mt-lg-5 mt-4">Post a
                                job </a>
                            <a href="{{ route('contact') }}" class="btn btn-style btn-white mt-lg-5 mt-4 ms-2">
                                Contact
                                Us</a>
                        </div>
                    </div>
                    <div class="col-lg-6 videow3-right ps-lg-5">
                        <div class="w3l-index5 py-5">
                            <div class="history-info align-self text-center py-5 my-lg-5">
                                <div class="position-relative py-5">
                                    <a href="#small-dialog1"
                                        class="popup-with-zoom-anim play-view text-center position-absolute">
                                        <span class="video-play-icon">
                                            <span class="fa fa-play"></span>
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="w3l-products w3l-faq-block py-5" id="projects">
        <div class="container py-md-5 py-2">
            <div class="header-secw3 text-center mb-5">
                <h6 class="title-subhny mb-2">faqs</h6>
                <h3 class="title-w3l mb-4">Ask Your Questions

                </h3>
            </div>
            <div class="row">
                <div class="col-lg-6 mx-auto pe-lg-5">
                    <div class="w3hny-business-img">
                        <img src="assets/images/g8.jpg" alt="" class="img-fluid radius-image">
                    </div>

                </div>
                <div class="col-lg-6 mt-lg-0 mt-sm-5 mt-4">
                    <div class="accordion">
                        <div class="accordion-item">
                            <button id="accordion-button-1" aria-expanded="true"><span class="accordion-title">How to
                                    be
                                    a beneficiary of this program</span><span class="icon"
                                    aria-hidden="true"></span></button>
                            <div class="accordion-content">
                                <p>Beneficiary for sponsorship in this are drawn from TVET colleges in informal
                                    settlements who are vulnearble and unable to access opportunities due to lack of
                                    resources. </p>
                            </div>
                        </div>
                        <!-- <div class="accordion-item">
                            <button id="accordion-button-2" aria-expanded="false"><span class="accordion-title">How to
                                    choose a best web template?</span><span class="icon"
                                    aria-hidden="true"></span></button>
                            <div class="accordion-content">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                    incididunt ut labore et dolore magna aliqua. Elementum sagittis vitae et leo duis
                                    ut. Ut pretium.</p>
                            </div>
                        </div> -->
                        <!-- <div class="accordion-item">
                            <button id="accordion-button-3" aria-expanded="false"><span class="accordion-title">How to
                                    download a
                                    template?</span><span class="icon" aria-hidden="true"></span></button>
                            <div class="accordion-content">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                    incididunt ut labore et dolore magna aliqua. Elementum sagittis vitae et leo duis
                                    ut. Ut tortor.</p>
                            </div>
                        </div> -->
                        <!-- <div class="accordion-item">
                            <button id="accordion-button-4" aria-expanded="false"><span class="accordion-title">Why
                                    should i choose a
                                    free website?</span><span class="icon" aria-hidden="true"></span></button>
                            <div class="accordion-content">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                    incididunt ut labore et dolore magna aliqua. Elementum sagittis vitae et leo duis
                                    ut. Ut potenti.</p>
                            </div>
                        </div> -->

                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="w3l-project-main">
        <div class="container py-md-5 py-2">
            <div class="header-secw3 text-center mb-5">
                <h3 class="title-w3l mb-4">Partners</h3>
            </div>
            <div class="w3l-project py-md-5 py-4">
                <div class="row py-5 align-items-center">
                    <div class="swiper init-swiper">
                        <div class="swiper-wrapper align-items-center">
                            <div class="swiper-slide"><img src="{{ asset('assets/img/eu.png') }}" class="img-fluid"
                                    alt=""></div>
                            <div class="swiper-slide"><img src="{{ asset('assets/img/auda.png') }}"
                                    class="img-fluid" alt=""></div>
                            <div class="swiper-slide"><img src="{{ asset('assets/img/SIFA_0.png') }}"
                                    class="img-fluid" alt=""></div>
                            <div class="swiper-slide"><img src="{{ asset('assets/img/msdp.jpg') }}"
                                    class="img-fluid" alt=""></div>
                            <div class="swiper-slide"><img src="{{ asset('assets/img/logo.png') }}"
                                    class="img-fluid" alt=""></div>
                            <div class="swiper-slide"><img src="{{ asset('assets/img/aiccad_logo.png') }}"
                                    class="img-fluid" alt=""></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

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

    <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('js/theme-change.js') }}"></script>
    <script src="{{ asset('js/jquery-1.9.1.min.js') }}"></script>

    <script>
        const items = document.querySelectorAll(".accordion button");

        function toggleAccordion() {
            const itemToggle = this.getAttribute('aria-expanded');
            for (i = 0; i < items.length; i++) {
                items[i].setAttribute('aria-expanded', 'false');
            }
            if (itemToggle == 'false') {
                this.setAttribute('aria-expanded', 'true');
            }
        }
        items.forEach(item => item.addEventListener('click', toggleAccordion));
    </script>

    <script>
        $(window).on("scroll", function() {
            var scroll = $(window).scrollTop();
            if (scroll >= 80) {
                $("#site-header").addClass("nav-fixed");
            } else {
                $("#site-header").removeClass("nav-fixed");
            }
        });
        $(".navbar-toggler").on("click", function() {
            $("header").toggleClass("active");
        });
        $(document).on("ready", function() {
            if ($(window).width() > 991) {
                $("header").removeClass("active");
            }
            $(window).on("resize", function() {
                if ($(window).width() > 991) {
                    $("header").removeClass("active");
                }
            });
        });
    </script>

    <script>
        $(function() {
            $('.navbar-toggler').click(function() {
                $('body').toggleClass('noscroll');
            })
        });
    </script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>

</body>

</html>
