@extends('layouts.main')

@section('title')
    Home @parent
@endsection

@section('header_styles')
@endsection

@section('content')
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
                        <a class="btn btn-primary btn-style mt-2" href="{{ route('jobs.create') }}">Post a job </a>
                        <a class="btn btn-outline-primary btn-style mt-2" href="#">The Curriculum</a>
                    </div>
                </div>
                <div class="col-lg-5 w3l-slider-right-info mt-lg-0 mt-5 ps-lg-5 align-items-center">
                    <div class="w3l-main-slider banner-slider">

                        <div class="slider-info">
                            <div class="w3l-slidehny-img banner-top1">
                                <img src="{{ asset('images/skills.png') }}" alt=""
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
                                                    src="{{ asset('images/heroimg.jpg') }}" alt="">
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
                                                    src="{{ asset('images/g2.jpg') }}" alt="">
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
                                                    src="{{ asset('images/hire.jpeg') }}" alt="">
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
                                {{-- <div class="position-relative py-5">
                                    <a href="#small-dialog1"
                                        class="popup-with-zoom-anim play-view text-center position-absolute">
                                        <span class="video-play-icon">
                                            <span class="fa fa-play"></span>
                                        </span>
                                    </a>
                                </div> --}}
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
                        <img src="{{ asset('images/g8.jpg') }}" alt="" class="img-fluid radius-image">
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
                                <p>Beneficiary for sponsorship in this project are drawn from TVET colleges in informal
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
            <div class="header-secw3">
                <h3 class="title-w3l">Partners</h3>
            </div>
            <div class="w3l-project">
                <div class="row py-5 align-items-center">
                    <div class="swiper init-swiper">
                        <div class="swiper-wrapper align-items-center">
                            <div class="swiper-slide"><img src="{{ asset('images/eu.png') }}" class="img-fluid"
                                    alt=""></div>
                            <div class="swiper-slide"><img src="{{ asset('images/auda.png') }}" class="img-fluid"
                                    alt=""></div>
                            <div class="swiper-slide"><img src="{{ asset('images/SIFA_0.png') }}" class="img-fluid"
                                    alt=""></div>
                            <div class="swiper-slide"><img src="{{ asset('images/msdp.jpg') }}" class="img-fluid"
                                    alt=""></div>
                            <div class="swiper-slide"><img src="{{ asset('images/logo.png') }}" class="img-fluid"
                                    alt=""></div>
                            <div class="swiper-slide"><img src="{{ asset('images/aiccad_logo.png') }}"
                                    class="img-fluid" alt=""></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- <section id="hero" class="hero">
        <div class="container position-relative">
            <div class="row gy-5" data-aos="fade-in">
                <div
                    class="col-lg-12 order-2 order-lg-1 d-flex flex-column justify-content-center text-center text-lg-start">
                    <h2>Career resources are top priority for your students and graduates, so don’t hold back! </h2>
                    <p>Transform your careers guide board into a career center with the career development resources your
                        students and graduates expect.
                        Students and Alumni look to their collesges as a trusted place to help them on their career journey.
                        Offer them career resources for every step along the way: Boost students and graduates engagement
                        with relevant and valuable
                        Opportunities while in college and beyond...
                    </p>

                    <div class="d-flex justify-content-center justify-content-lg-start">

                        <a href="{{ route('getstarted') }}" class="btn-get-started">Get Started</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="icon-boxes position-relative">
            <div class="container position-relative">
                <div class="row gy-4 mt-3 ">
                    <div class="col-lg-4 col-md-6" id="intro-divs" data-aos="fade-up" data-aos-delay="100">
                        <div class="icon-box">
                            <h4 class="title"><a href="{{ route('jobs.create') }}" class="stretched-link">Corporate</a>
                            </h4>
                            <p class="text">You have internship, employment position your want to get the best employee?
                            </p>
                            <a href="{{ route('jobs.create') }}" class="btn btn-outline-primary">Post it here <i
                                    class="fa-solid fa-arrow-right-long"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6" id="intro-divs" data-aos="fade-up" data-aos-delay="200">
                        <div class="icon-box">
                            <h4 class="title"><a href="{{ route('jobs.index') }}"
                                    class="stretched-link">University/College</a></h4>
                            <p class="text">Get first notified of opportunities when they are available so you can connect
                                your students. </p>
                            <a href="{{ route('jobs.index') }}" class="btn btn-outline-primary">Get notified of openings <i
                                    class="fa-solid fa-arrow-right-long"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6" id="intro-divs" data-aos="fade-up" data-aos-delay="300">
                        <div class="icon-box">
                            <h4 class="title"><a href="{{ route('jobs.index') }}" class="stretched-link">Students</a></h4>
                            <p>Access internship and employment opporunities from leading companies in Kenya and Beyond.
                            </p>
                            <a href="{{ route('jobs.index') }}" class="btn btn-outline-primary">Register to apply <i
                                    class="fa-solid fa-arrow-right-long"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <main id="main">

        <section id="clients" class="clients section">
            <div class="container">
                <div class="swiper init-swiper">

                    <div class="swiper-wrapper align-items-center">
                        <div class="swiper-slide"><img src="{{ asset('assets/img/eu.png') }}" class="img-fluid"
                                alt=""></div>
                        <div class="swiper-slide"><img src="{{ asset('assets/img/auda.png') }}" class="img-fluid"
                                alt=""></div>
                        <div class="swiper-slide"><img src="{{ asset('assets/img/SIFA_0.png') }}" class="img-fluid"
                                alt=""></div>
                        <div class="swiper-slide"><img src="{{ asset('assets/img/msdp.jpg') }}" class="img-fluid"
                                alt=""></div>
                        <div class="swiper-slide"><img src="{{ asset('assets/img/logo.png') }}" class="img-fluid"
                                alt=""></div>
                        <div class="swiper-slide"><img src="{{ asset('assets/img/aiccad_logo.png') }}" class="img-fluid"
                                alt=""></div>
                    </div>
                </div>
            </div>
        </section>

        <section id="about" class="about section">

            <div class="container section-title text-center" data-aos="fade-up">
                <h2><b>About Us</b></h2>
                <p>Daraja La Mafanikio - Bridge to Success: Empowering TVET graduates from Informal Settlements in
                    Kenya through Access to Digital Tools.</p>
            </div>

            <div class="container">

                <div class="row gy-4">
                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                        <img src="{{ asset('assets/img/skills.png') }}" class="img-fluid rounded-4 mb-4" alt="">
                    </div>
                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="250">
                        <div class="content ps-0 ps-lg-5">

                            <ul>
                                <li><i class="bi bi-check-circle-fill"></i> <span>To provide employability and
                                        entrepreneurship skills through physical and e-learning platform to
                                        trainees and graduates in the selected 6 TVET institutions serving the most
                                        vulnerable in the
                                        Kibera and Mukuru informal settlement.</span></li>
                                <li><i class="bi bi-check-circle-fill"></i> <span>To Mobilize SMEs proprietors, business
                                        owners, support towards youth employment to 400 vulnerable
                                        youths from 6 selected TVETs in the informal settlements through a designed and
                                        implemented
                                        web-based/USSD platform and app.</span></li>
                                <li><i class="bi bi-check-circle-fill"></i> <span>To improve access to Vocational Skills
                                        Training to 210 vulnerable youths from Kibera and Mukuru
                                        informal settlements to gain employable skills relevant to the labor market.</span>
                                </li>
                                <li><i class="bi bi-check-circle-fill"></i> <span>To disseminate lessons learned and best
                                        practices to stakeholders and partners at the national,
                                        regional, and continental levels.</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </section>

        <section id="services" class="services sections-bg">
            <div class="container" data-aos="fade-up">
                <div class="row gy-4" data-aos="fade-up" data-aos-delay="100">

                    <div class="col-lg-6 col-md-6">
                        <div class="service-item position-relative alert alert-info">
                            <h3>Internship Advertisement</h3>
                            <h5>We provide a a plartform to get the best students for intership opportunities in your
                                institution. You can access hundreds of applicants and sieve the best fit for you. </h5>
                            <a href="#" class="readmore stretched-link">Read more <i
                                    class="bi bi-arrow-right"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6">
                        <div class="service-item position-relative alert alert-info">

                            <h3>Job Advertisement</h3>
                            <h5>Hire recent undergraduates, graduates, masters and doctorate students conveniently by
                                advertising you job on our platform and choose the most qualified employee for your
                                organization </h5>
                            <a href="#" class="readmore stretched-link">Read more <i
                                    class="bi bi-arrow-right"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6">
                        <div class="service-item position-relative alert alert-info">
                            <h3>Access to opportunities</h3>
                            <h5>Students and graduates can access, apply and get job opportunities as soon as they are
                                advertised on our platform. </h5>
                            <a href="#" class="readmore stretched-link">Read more <i
                                    class="bi bi-arrow-right"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6">
                        <div class="service-item position-relative alert alert-info">
                            <h3>Institutions / Universities </h3>
                            <h5>Institutions can connect their students to opportunities in various industries through this
                                robust platform. They can receive</h5>
                            <a href="#" class="readmore stretched-link">Read more <i
                                    class="bi bi-arrow-right"></i></a>
                        </div>
                    </div>

                </div>

            </div>
        </section>

    </main> --}}
@endsection
