@extends('layouts.app')

@section('title')
    Home @parent
@endsection

@section('header_styles')
@endsection

@section('content')
    <section id="hero" class="hero">
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
                {{-- <div class="col-lg-5 order-1 order-lg-2">
                    <img src="{{ asset('assets/img/heroimg.png') }}" class="img-fluid" alt="" data-aos="zoom-out"
                        data-aos-delay="100">
                </div> --}}
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

                            {{-- <div class="position-relative mt-4">
                                <img src="assets/img/about-2.jpg" class="img-fluid rounded-4" alt="">
                                <a href="https://www.youtube.com/watch?v=Y7f98aduVJ8"
                                    class="glightbox pulsating-play-btn"></a>
                            </div> --}}
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

    </main>
@endsection
