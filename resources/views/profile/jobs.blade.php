@extends('layouts.main')

@section('title')
    Profile @parent
@endsection

@section('header_styles')
    <link rel="stylesheet" href="{{ asset('assets/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/profile.css') }}">
@endsection

@section('content')
    <section class="main-content">
        <div class="page-title" data-aos="fade">
            <nav class="breadcrumbs">
                <div class="container">
                    <ol>
                        <li><a href="/">Home</a></li>
                        <li class="current">My Jobs</li>
                    </ol>
                </div>
            </nav>
        </div>

        <div class="container mt-2 mb-2">
            <div class="row">
                <div class="col-xl-3 mb-4 card">
                    @include('profile.partials.sidebarnav')
                </div>

                <div class="col-xl-9">

                    <div class="text-end mb-2">
                        <a href="{{ route('jobs.create') }}" class="btn btn-secondary btn-md"><i
                                class="fa fa-plus"></i>&nbsp;Post new job</a>
                    </div>

                    @foreach ($jobs as $key => $item)
                        @php
                            $skillhtml = '';
                            foreach ($item->skills as $skill) {
                                $skillhtml .= "<span>$skill->name</span>&nbsp;";
                            }
                        @endphp
                        <div class="job bg-white" data-id='{{ $item->id }}'>
                            <div class="title">
                                <h5>{{ $item->title }}</h5>
                            </div>

                            <div class="salary p-2">
                                <span>Monthly: {{ $item->salary_range }}</span>
                            </div>

                            <div class="desciption">
                                <p>{{ $item->description }}</p>
                            </div>

                            <div class="skills p-2">{!! $skillhtml !!}</div>
                            <div class="location mt-1 d-flex justify-content-between  p-2">
                                <div><a href="{{ route('job.applications', $item->id) }}"
                                        class="btn btn-secondary btn-sm">{{ $item->applications_count }} Applicants</a>
                                </div>

                                @if ($item->application_end_date !== null)
                                    <div>Application Deadline: {{ date('j M Y', strtotime($item->application_end_date)) }}
                                    </div>
                                @else
                                    <div>Application Deadline: <span class="text-warning">Not Specified</span></div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                    <section id="job-pagination" class="job-pagination section mt-3 bg-white p-2">
                        <div class="container">
                            <div class="d-flex justify-content-center">
                                <ul>
                                    {!! $jobs->links() !!}
                                </ul>
                            </div>
                        </div>
                    </section>
                </div>

            </div>
        </div>
    </section>
@endsection

@section('footer_scripts')
    <script src="{{ asset('js/select2.min.js') }}"></script>
    <script src="{{ asset('js/profile.js') }}"></script>
@endsection
