@extends('layouts.main')

@section('title')
Home @parent
@endsection

@section('header_styles')
@endsection

@section('content')
<main class="main">

    <section id="hero" class="hero section dark-background">
        <img src="{{ asset('images/bridge.jpg') }}" alt="" data-aos="fade-in">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 data-aos="fade-up" data-aos-delay="100" class="translatable">Job Opportunities</h2>
                    <p data-aos="fade-up" data-aos-delay="200" class="translatable">Find job opportunities that match your skill set</p>
                </div>

                <div class="col-md-12 mt-4" data-aos="fade-up" data-aos-delay="300">
                    <form action="{{ route('jobs.search') }}" method="post" id="jobsSearchForm">
                        <div class="row">
                            @csrf
                            <div class="col-md-3 mb-2">
                                <select name="category_id" id="searchCategoryID" class="form-select">

                                </select>
                            </div>

                            <div class="col-md-3 mb-2">
                                <select name="type" id="searchEmploymentType" class="form-select">
                                    <option value="">Employment Type</option>
                                    <option value="Internship" class="translatable">Internship</option>
                                    <option value="Part-time" class="translatable">Part Time</option>
                                    <option value="Full Time" class="translatable">Full Time</option>
                                    <option value="Contract" class="translatable">Contract</option>
                                    <option value="Freelance" class="translatable">Freelance</option>
                                    <option value="Temporary" class="translatable">Temporary</option>
                                </select>
                            </div>

                            <div class="col-md-3 mb-2">
                                <select name="job_type" id="searchJobType" class="form-select">
                                    <option value="">Job Type</option>
                                    <option value="Remote" class="translatable">Remote</option>
                                    <option value="On-site" class="translatable">On-Site</option>
                                    <option value="High-breed" class="translatable">High-breed</option>
                                </select>
                            </div>

                            <div class="col-md-2 mb-2">
                                <input type="text" class="form-control" name="searchLocation" id="searchLocation" placeholder="Location">
                            </div>

                            <div class="col-md-1 mb-1">
                                <button type="submit" class="btn btn-danger"><i class="bi bi-search text-white"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="mt-4" data-aos="fade-up" data-aos-delay="400">
                    <h5 class="translatable">Get started quickly by industries</h5>
                    <div class="mt-2 d-flex flex-wrap gap-3 gy-4" id="categoriesWithJobs"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Clients Section -->
    <section id="clients" class="clients section">

        <div class="container-fluid" data-aos="fade-up">

            <div class="d-flex justify-content-center align-items-center gap-3 gy-4">

                <div class="col-xl-2 col-md-3 col-6 client-logo">
                    <img src="{{ asset('images/auda.png') }}" class="img-fluid" alt="">
                </div>

                <div class="col-xl-2 col-md-3 col-6 client-logo">
                    <img src="{{ asset('images/SIFA_0.png') }}" class="img-fluid" alt="">
                </div>
                <div class="col-xl-2 col-md-3 col-6 client-logo">
                    <img src="{{ asset('images/msdp.jpg') }}" class="img-fluid" alt="">
                </div>
                <div class="col-xl-2 col-md-3 col-6 client-logo">
                    <img src="{{ asset('images/logo.png') }}" class="img-fluid" alt="">
                </div>
                <div class="col-xl-2 col-md-3 col-6 client-logo">
                    <img src="{{ asset('images/aiccad_logo.png') }}" class="img-fluid" alt="">
                </div>
            </div>
        </div>
    </section>

    <section id="about" class="about section light-background">

        <div class="container-fluid" data-aos="fade-up" data-aos-delay="100">
            <div class="row align-items-xl-center gy-5">

                <div class="col-xl-5 content">
                    <h3 class="translatable">About Us</h3>
                    <h2>Daraja La Mafanikio - Bridge to Success</h2>
                    <p class="translatable">We aim to allievate poverty in informal settlements by providing training and
                        imparting skills on employability and entrepreneurship curriculum to youths in disadvantaged and
                        informal settlements.</p>
                    <a href="{{ route('about') }}" class="read-more"><span class="translatable">Read More</span><i class="bi bi-arrow-right"></i></a>
                </div>

                <div class="col-xl-7">
                    <div class="row gy-4 icon-boxes">

                        <div class="col-md-6" data-aos="fade-up" data-aos-delay="200">
                            <div class="icon-box">
                                <i class="bi bi-buildings"></i>
                                <h3 class="translatable">TVET graduates</h3>
                                <p class="translatable">Empowering TVET graduates from Informal Settlements in Kenya.
                                </p>
                            </div>
                        </div>

                        <div class="col-md-6" data-aos="fade-up" data-aos-delay="300">
                            <div class="icon-box">
                                <i class="bi bi-pie-chart"></i>
                                <h3 class="translatable">Employers</h3>
                                <p class="translatable">Employers can access this skilled pool of youths to fill employment positions in their firms.
                                </p>
                            </div>
                        </div>

                        <div class="col-md-6" data-aos="fade-up" data-aos-delay="400">
                            <div class="icon-box">
                                <i class="bi bi-award"></i>
                                <h3 class="translatable">Employability and Entrepreneurship</h3>
                                <p class="translatable">We have skillful employability and entrepreneurship curriculum to equip youths with skills to be competitive in the job market.</p>
                            </div>
                        </div>

                        <div class="col-md-6" data-aos="fade-up" data-aos-delay="500">
                            <div class="icon-box">
                                <i class="bi bi-graph-up-arrow"></i>
                                <h3 class="translatable">Training</h3>
                                <p class="translatable">We provide specially curated training on employability and entrepreneurship to youths in disadvantaged and informal settlements.</p>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="features section">
        <div class="container-fluid section-title" data-aos="fade-up">
            <h2 class="translatable">What we Do</h2>
            <p></p>
        </div><!-- End Section Title -->
        <div class="container-fluid">

            <div class="row gy-4 align-items-center features-item">
                <div class="col-lg-5 order-2 order-lg-1" data-aos="fade-up" data-aos-delay="200">
                    <h3 class="translatable">Employability and Entrepreneurship Training</h3>
                    <p class="translatable">
                        We provide specially curated training on employability and entrepreneurship to youths in disadvantaged and informal settlements.
                    </p>
                    <a href="{{ route('elearning') }}" class="btn btn-get-started translatable">Access Training Materials</a>
                </div>
                <div class="col-lg-7 order-1 order-lg-2 d-flex align-items-center" data-aos="zoom-out" data-aos-delay="100">
                    <div class="image-stack">
                        <img src="{{ asset('images/training.avif') }}" alt="" class="stack-front">
                        <img src="{{ asset('images/bridge.jpg') }}" alt="" class="stack-back">
                    </div>
                </div>
            </div><!-- Features Item -->

            <div class="row gy-4 align-items-stretch justify-content-between features-item ">
                <div class="col-lg-6 d-flex align-items-center features-img-bg" data-aos="zoom-out">
                    <img src="{{ asset('images/jobs.avif') }}" class="img-fluid" alt="">
                </div>
                <div class="col-lg-5 d-flex justify-content-center flex-column" data-aos="fade-up">
                    <h3 class="translatable">Employment Opportunities</h3>
                    <p class="translatable">Employers can access this skilled pool of youths to fill employment positions in their firms.</p>
                    <ul>
                        <li><i class="bi bi-check"></i><span class="translatable">We connect employers to skilled graduates</span></li>
                        <li><i class="bi bi-check"></i><span class="translatable">Employers can access this skilled pool of youths to fill employment positions in their firms.</span></li>
                        <li><i class="bi bi-check"></i> <span class="translatable">Employers can access this skilled pool of youths to fill employment positions in their firms.</span></li>
                    </ul>
                    <a href="{{ route('jobs.create') }}" class="btn btn-get-started align-self-start translatable">Get Started</a>
                </div>
            </div>
        </div>
    </section>

    {{-- <section class="top-employers">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="translatable">Top Employers</h2>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">

                

            </div>
        </div>
    </section> --}}
</main>

@endsection

@section('footer_scripts')
<script src="{{ asset('js/functions.js') }}"></script>
<script>
    $(document).ready(function() {
        getCategoriesOptions(['#searchCategoryID']);
        getCategoriesWithJobs('#categoriesWithJobs');
    });
</script>
@endsection
