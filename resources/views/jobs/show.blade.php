@extends('layouts.main')

@section('title')
    Job Apply
@endsection

@section('header_styles')
    <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/iziToast.min.css') }}">
@endsection

@section('content')
    <main class="main">
        <section class="main-content">
            <div class="page-title" data-aos="fade">
                <nav class="breadcrumbs">
                    <div class="container-fluid mt-3">
                        <ol>
                            <li><a href="/" class="translatable">Home</a></li>
                            <li class="current translatable">Job Opportunities</li>
                        </ol>
                    </div>
                </nav>
            </div>

            <section class="job-section">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="job-details-section">
                                <div class="salary mb-2">
                                    <span class="translatable">{{ $job->type }}</span>
                                    <span class="translatable">Work {{ $job->job_type }}</span>
                                    <span class="translatable">NO of positions:
                                        <b>{{ $job->no_of_positions }}</b></span>
                                    <span>{{ $job->salary_range }}</span>
                                </div>
                                <div class="desciption p-2 translatable">{{ $job->description }}</div>
                                <hr>
                                <h5 class="d-flex justify-content-between p-2"><b class="translatable">Skills</b> <span
                                        class="float-right">Level:
                                        <b class="translatable">{{ $job->experience_level }}</b></span></h5>
                                <hr>
                                <div class="skills p-2">
                                    @if ($job->skills !== null)
                                        @foreach ($job->skills as $item)
                                            <span class="translatable">{{ $item->name }}</span>
                                        @endforeach
                                    @else
                                        <span class="translatable">No skills specified</span>
                                    @endif
                                </div>
                                <hr>
                                <div class="requirements p-2">
                                    <p><b class="translatable">Requirements</b></p>
                                    <ul>
                                        @if ($job->requirements !== null)
                                            @foreach (json_decode($job->requirements, true) as $item)
                                                <li class="translatable">{{ $item }}</li>
                                            @endforeach
                                        @else
                                            <li class="translatable">No requirements specified</li>
                                        @endif
                                    </ul>
                                </div>
                                <hr>
                                <div class="qualifications p-2">
                                    <p><b class="translatable">Qualifications</b></p>
                                    <ul>
                                        @if ($job->qualifications !== null)
                                            @foreach (json_decode($job->qualifications, true) as $item)
                                                <li class="translatable">{{ $item }}</li>
                                            @endforeach
                                        @else
                                            <li class="translatable">No qualifications specified</li>
                                        @endif
                                    </ul>
                                </div>
                                <hr>
                                <div class="education d-flex justify-content-between p-2">
                                    <span class="translatable">Education Level: <i class="fa fa-graduation-cap text-primary"></i>
                                        <b class="translatable">{{ $job->education_level }}</b></span><span class="translatable">Starts on: <i
                                            class="fa-regular fa-calendar-days text-primary"></i>
                                        <b class="translatable">{{ $job->start_date }}</b></span>
                                </div>
                                <hr>
                                <div class="location mt-3 d-flex justify-content-between p-2">
                                    <div><i class="fa-solid fa-location-dot"></i> <span>{{ $job->location }}</span></div>
                                    <div class="translatable">Posted: {{ $job->created_at->diffForHumans() }}</div>
                                </div>
                            </div>
                            <div class="text-end mt-2">
                                <a href="/jobs/{{ $job->ref_no }}/apply"
                                    class="read-more translatable btn btn-primary">Apply Now <i
                                        class="fa-solid fa-angles-right"></i></a>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="user p-3">
                                <div class="text-center">
                                    <img src="{{ asset('corporate_logos/' . $corporate->logo == null || $corporate->logo == '' ? 'images/logoavatar.png' : $corporate->logo) }}"
                                        alt="{{ $corporate->name }}" class="img-fluid"
                                        style="width: 150px; height: 150px; border-radius: 50%;">

                                    <p class="mb-1">
                                        {{ $corporate->name }}
                                        <span>{{ $corporate->address }}</span>
                                    </p>
                                </div>
                                <p class="p-2 translatable">Total Jobs Posted: {{ $corporate->jobs_count }}</p>
                            </div>
                        </div>

                    </div>
                </div>
            </section>
        </section>
    </main>
@endsection

@section('footer_scripts')
    <script src="{{ asset('js/iziToast.min.js') }}"></script>
    <script src="{{ asset('js/functions.js') }}"></script>
    <script src="{{ asset('js/application.js') }}"></script>
@endsection
