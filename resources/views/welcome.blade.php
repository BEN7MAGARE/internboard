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
                        <p data-aos="fade-up" data-aos-delay="200" class="translatable">Find job opportunities that match
                            your skill set</p>
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
                                    <input type="text" class="form-control" name="searchLocation" id="searchLocation"
                                        placeholder="Location">
                                </div>

                                <div class="col-md-1 mb-1">
                                    <button type="submit" class="btn btn-danger"><i
                                            class="bi bi-search text-white"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="mt-4" data-aos="fade-up" data-aos-delay="400" id="categoriesWithJobs">                            
                    </div>
                </div>
            </div>
        </section>

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
                        <p class="translatable">We aim to allievate poverty in informal settlements by providing training
                            and
                            imparting skills on employability and entrepreneurship curriculum to youths in disadvantaged and
                            informal settlements.</p>
                        <a href="{{ route('about') }}" class="read-more"><span class="translatable">Read More</span><i
                                class="bi bi-arrow-right"></i></a>
                    </div>

                    <div class="col-xl-7">
                        <div class="row gy-4 icon-boxes">

                            <div class="col-md-6" data-aos="fade-up" data-aos-delay="200">
                                <div class="icon-box">
                                    <i class="bi bi-buildings"></i>
                                    <h3 class="translatable">Employability Training</h3>
                                    <p class="translatable">Empowering TVET graduates from Informal Settlements in Kenya.
                                    </p>

                                    <div class="text-end mt-2">
                                        <a href="{{ route('elearning.employability') }}"
                                            class="read-more translatable btn btn-primary">Learn
                                            More</a>
                                    </div>
                                </div>

                            </div>

                            <div class="col-md-6" data-aos="fade-up" data-aos-delay="300">
                                <div class="icon-box">
                                    <i class="bi bi-pie-chart"></i>
                                    <h3 class="translatable">Entrepreneurship Training</h3>
                                    <p class="translatable">Empowering TVET graduates from Informal Settlements in Kenya.
                                    </p>

                                    <div class="text-end mt-2">
                                        <a href="{{ route('elearning.entrepreneurship') }}"
                                            class="read-more translatable btn btn-primary">Learn More</a>
                                    </div>
                                </div>

                            </div>

                            <div class="col-md-6" data-aos="fade-up" data-aos-delay="400">
                                <div class="icon-box">
                                    <i class="bi bi-award"></i>
                                    <h3 class="translatable">Employment Opportunities</h3>
                                    <p class="translatable">Employers can access this skilled pool of youths to fill
                                        employment positions in their firms.</p>

                                    <div class="text-end mt-2">
                                        <a href="{{ route('jobs.index') }}"
                                            class="read-more translatable btn btn-primary">See opportunities</a>
                                    </div>
                                </div>

                            </div>

                            <div class="col-md-6" data-aos="fade-up" data-aos-delay="500">
                                <div class="icon-box">
                                    <i class="bi bi-graph-up-arrow"></i>
                                    <h3 class="translatable">Elleviate Poverty</h3>
                                    <p class="translatable">This platform encompasses jobs advertisement and employment
                                        opportunities for youths in disadvantaged and informal settlements.</p>

                                    <div class="text-end mt-2">
                                        <a href="{{ route('about') }}"
                                            class="read-more translatable btn btn-primary">Read More</a>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </section>

        <section id="" class="">
            <div class="container-fluid" data-aos="fade-up">
                <h2>Recent Jobs</h2>
                <p>Check out the latest job opportunities</p>
            </div>
            <div class="container-fluid">

                <div class="row bg-light pt-4 pb-4 slider" id="job-slider">
                    @foreach ($jobs as $item)
                        @php
                            $skilltext = '';
                            foreach ($item->skills as $key => $skill) {
                                if ($key < 3) {
                                    $skilltext .= "<span>$skill->name</span>";
                                }
                            }
                        @endphp
                        <a href="{{ route('jobs.show', $item->ref_no) }}">
                        <div class="slide slide-box" data-id="{{ $item->id }}" data-ref_no="{{ $item->ref_no }}">
                            <div class="card p-3">

                                <div class="title">
                                    <i class="text-danger">{{ $item->corporate->name }}</i>
                                    <h6>{{ substr($item->title, 0, 70) . '...' }}</h6>
                                </div>

                                <div class="row gap-2">
                                    <div class="col-md-12">
                                        <div class="d-flex flex-wrap gap-2">
                                            <span class="alert p-1 rounded alert-success">Salary:
                                                {{ $item->salary_range }}</span>
                                            <span class="alert p-1 rounded alert-success">Positions:
                                                {{ $item->no_of_positions }}</span>
                                        </div>

                                        <div class="desciption p-2">
                                            @php
                                                $description = $item->description;
                                            @endphp
                                            @if (strlen($description) > 150)
                                                <p>{{ substr($description, 0, 150) . ' . . . .' }}</p>
                                            @else
                                                <p>{{ $description }}</p>
                                            @endif
                                        </div>

                                        <small class="skills ml-2">{!! $skilltext !!}</small>

                                        <div class="location d-flex justify-content-between p-2">
                                            <div>
                                                <small>
                                                    <i
                                                        class="bi bi-geo-alt-fill text-danger"></i>&nbsp;<span>{{ $item->location }}</span>
                                                </small>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                
                            </div>
                        </div>
                        </a>
                    @endforeach
                </div>
                <div class="slider-nav-main mt-1">
                    <div>
                        <i class="bi bi-arrow-left-circle-fill text-danger" id="slider-job-home-prev"></i>
                        <i class="bi bi-arrow-right-circle-fill text-danger" id="slider-job-home-next"></i>
                    </div>
                </div>
            </div>
        </section>

        <section id="" class="">
            <div class="container-fluid" data-aos="fade-up">
                <h2>Top Employers</h2>
                <p>Here are the employers who are committed to providing opportunities for youths in disadvantaged and
                    informal settlements.</p>
            </div>
            <div class="container-fluid">
                <div class="mt-4 d-flex align-item-center justify-content-center gap-2 flex-wrap" id="brandsSection">
                    @foreach ($corporates as $item)
                        <a href="/corporate/{{ $item->ref_no }}">
                            <div class="brand-image">
                                <img src="{{ asset('images/' . $item->logo) }}" alt="{{ $item->name }}"
                                    class="img-fluid" width="90px">
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    </main>
@endsection

@section('footer_scripts')
    <script src="{{ asset('js/functions.js') }}"></script>
    <script src="{{ asset('js/welcome.js') }}"></script>
    
@endsection
