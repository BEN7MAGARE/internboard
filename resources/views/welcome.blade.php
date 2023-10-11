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
                <div class="col-lg-7 order-2 order-lg-1 d-flex flex-column justify-content-center text-center text-lg-start">
                    <h2>Career resources are top priority for your members, so don’t hold back. </h2>
                    <p>Transform your job board into a career center with the career development resources your members
                        expect. Members look to their associations as a trusted place to help them on their career journey.
                        Offer them career resources for every step along the way:
                        Boost member engagement with relevant and valuable career articles that speak directly to your
                        members.
                        Deliver additional member value with industry-specific career coaches.
                        Increase retention with career paths to help members plan their next career step.
                        Build up your members by offering one centralized location for resume/CV review, LinkedIn profile
                        makeover, and interview prep.
                        Learn how to provide the career benefits your members have wanted all along.
                    </p>


                    <div class="d-flex justify-content-center justify-content-lg-start">

                        <a href="{{ route('getstarted') }}" class="btn-get-started">Get Started</a>
                    </div>
                </div>
                <div class="col-lg-5 order-1 order-lg-2">
                    <img src="{{ asset('assets/img/heroimg.png') }}" class="img-fluid" alt="" data-aos="zoom-out"
                        data-aos-delay="100">
                </div>
            </div>
        </div>

        <div class="icon-boxes position-relative">
            <div class="container position-relative">
                <div class="row gy-4 mt-3 ">

                    <div class="col-lg-4 col-md-6" id="intro-divs" data-aos="fade-up" data-aos-delay="100">
                        <div class="icon-box">
                            <h4 class="title"><a href="{{ route('employer.create') }}" class="stretched-link">Corporate</a>
                            </h4>

                            <p class="text">You have internship, employment position your want to get the best employee?
                            </p>

                            {{-- <p class="text">Do you have any internship / employment vacancy and you are seeking students with skill and talent to fill those
                                position?</p> --}}

                            <a href="{{ route('employer.create') }}">Post it here <i
                                    class="fa-solid fa-arrow-right-long"></i></a>

                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6" id="intro-divs" data-aos="fade-up" data-aos-delay="200">
                        <div class="icon-box">
                            <h4 class="title"><a href="" class="stretched-link">University / College</a></h4>
                            <p class="text">Get first notified of opportunities when they are available so you can connect
                                your students. </p>
                            <a href="{{ route('college.create') }}">Get notified of
                                openings <i class="fa-solid fa-arrow-right-long"></i></a>

                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6" id="intro-divs" data-aos="fade-up" data-aos-delay="300">
                        <div class="icon-box">
                            <h4 class="title"><a href="" class="stretched-link">Students</a></h4>
                            <p>Access internship and employment opporunities from leading companies in Kenya and Beyond.
                            </p>
                            {{-- <p class="text">Are you pursuing undergraduate/post-graduate degree or diploma and would like to get access
                                to internship/employment opportunities at a top institution? </p> --}}
                            <a href="{{ route('student.create') }}">Register to apply <i
                                    class="fa-solid fa-arrow-right-long"></i></a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>

    {{-- <section class="call-to-action">
        <div class="container">
            <div class="text-center">
                <a href="{{ route('getstarted') }}" class="btn btn-primary btn-lg">Get started <i class="fa fa-arrow-right"></i></a>
            </div>
        </div>
    </section> --}}


    <main id="main">

        {{-- <section id="about" class="about">
            <div class="container" data-aos="fade-up">

                <div class="row gy-4">
                    <div class="col-lg-6">
                        <h3>The Platform</h3>
                        <img src="assets/img/about.jpg" class="img-fluid rounded-4 mb-4" alt="">
                    </div>

                    <div class="col-lg-6">
                        <div class="content ps-0 ps-lg-5">
                            <p style="width: 100%;">

                            </p>
                            <ul>
                                <li><i class="bi bi-check-circle-fill"></i> </li>
                                <li><i class="bi bi-check-circle-fill"></i> </li>
                                <li><i class="bi bi-check-circle-fill"></i> </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section> --}}

        <section id="services" class="services sections-bg">
            <div class="container" data-aos="fade-up">
                <div class="row gy-4" data-aos="fade-up" data-aos-delay="100">

                    <div class="col-lg-4 col-md-6">
                        <div class="service-item  position-relative">
                            <h3>Internship Advertisement</h3>
                            <p>We provide a a plartform to get the best students for intership opportunities in your
                                institution. You can access hundreds of applicants and sieve the best fit for you. </p>
                            <a href="#" class="readmore stretched-link">Read more <i
                                    class="bi bi-arrow-right"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <div class="service-item position-relative">

                            <h3>Job Advertisement</h3>
                            <p>Hire recent undergraduates, graduates, masters and doctorate students conveniently by
                                advertising you job on our platform and choose the most qualified employee for your
                                organization </p>
                            <a href="#" class="readmore stretched-link">Read more <i
                                    class="bi bi-arrow-right"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <div class="service-item position-relative">
                            <h3>Access to opportunities</h3>
                            <p>Students and graduates can access, apply and get job opportunities as soon as they are
                                advertised on our platform. </p>
                            <a href="#" class="readmore stretched-link">Read more <i
                                    class="bi bi-arrow-right"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <div class="service-item position-relative">
                            <h3>Institutions / Universities </h3>
                            <p>Institutions can connect their students to opportunities in various industries through this
                                robust platform. They can receive</p>
                            <a href="#" class="readmore stretched-link">Read more <i
                                    class="bi bi-arrow-right"></i></a>
                        </div>
                    </div>


                </div>

            </div>
        </section>

        {{-- <section id="faq" class="faq">
            <div class="container" data-aos="fade-up">

                <div class="row gy-4">

                    <div class="col-lg-4">
                        <div class="content px-xl-5">
                            <h3>Frequently Asked <strong>Questions</strong></h3>
                            <p>
                                You can also get started by browsing answers for common challenges that users may encounter on our platform.
                            </p>
                        </div>
                    </div>

                    <div class="col-lg-8">

                        <div class="accordion accordion-flush" id="faqlist" data-aos="fade-up" data-aos-delay="100">

                            <div class="accordion-item">
                                <h3 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#faq-content-1">
                                        <span class="num">1.</span>
                                        Non consectetur a erat nam at lectus urna duis?
                                    </button>
                                </h3>
                                <div id="faq-content-1" class="accordion-collapse collapse" data-bs-parent="#faqlist">
                                    <div class="accordion-body">
                                        Feugiat pretium nibh ipsum consequat. Tempus iaculis urna id volutpat lacus laoreet
                                        non curabitur gravida. Venenatis lectus magna fringilla urna porttitor rhoncus dolor
                                        purus non.
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <h3 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#faq-content-2">
                                        <span class="num">2.</span>
                                        Feugiat scelerisque varius morbi enim nunc faucibus a pellentesque?
                                    </button>
                                </h3>
                                <div id="faq-content-2" class="accordion-collapse collapse" data-bs-parent="#faqlist">
                                    <div class="accordion-body">
                                        Dolor sit amet consectetur adipiscing elit pellentesque habitant morbi. Id interdum
                                        velit laoreet id donec ultrices. Fringilla phasellus faucibus scelerisque eleifend
                                        donec pretium. Est pellentesque elit ullamcorper dignissim. Mauris ultrices eros in
                                        cursus turpis massa tincidunt dui.
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <h3 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#faq-content-3">
                                        <span class="num">3.</span>
                                        Dolor sit amet consectetur adipiscing elit pellentesque habitant morbi?
                                    </button>
                                </h3>
                                <div id="faq-content-3" class="accordion-collapse collapse" data-bs-parent="#faqlist">
                                    <div class="accordion-body">
                                        Eleifend mi in nulla posuere sollicitudin aliquam ultrices sagittis orci. Faucibus
                                        pulvinar elementum integer enim. Sem nulla pharetra diam sit amet nisl suscipit.
                                        Rutrum tellus pellentesque eu tincidunt. Lectus urna duis convallis convallis
                                        tellus. Urna molestie at elementum eu facilisis sed odio morbi quis
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <h3 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#faq-content-4">
                                        <span class="num">4.</span>
                                        Ac odio tempor orci dapibus. Aliquam eleifend mi in nulla?
                                    </button>
                                </h3>
                                <div id="faq-content-4" class="accordion-collapse collapse" data-bs-parent="#faqlist">
                                    <div class="accordion-body">
                                        Dolor sit amet consectetur adipiscing elit pellentesque habitant morbi. Id interdum
                                        velit laoreet id donec ultrices. Fringilla phasellus faucibus scelerisque eleifend
                                        donec pretium. Est pellentesque elit ullamcorper dignissim. Mauris ultrices eros in
                                        cursus turpis massa tincidunt dui.
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <h3 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#faq-content-5">
                                        <span class="num">5.</span>
                                        Tempus quam pellentesque nec nam aliquam sem et tortor consequat?
                                    </button>
                                </h3>
                                <div id="faq-content-5" class="accordion-collapse collapse" data-bs-parent="#faqlist">
                                    <div class="accordion-body">
                                        Molestie a iaculis at erat pellentesque adipiscing commodo. Dignissim suspendisse in
                                        est ante in. Nunc vel risus commodo viverra maecenas accumsan. Sit amet nisl
                                        suscipit adipiscing bibendum est. Purus gravida quis blandit turpis cursus in
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>


                </div>

            </div>
        </section> --}}

    </main>
@endsection
