@extends('layouts.app')

@section('title')
    Profile @parent
@endsection

@section('header_styles')
    <link rel="stylesheet" href="{{ asset('assets/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/profile.css') }}">
@endsection

@section('content')
    <section class="section profile" style="background:#EAFAF1;">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 mb-4">
                    @include('profile.partials.sidebarnav')
                </div>

                <div class="col-xl-9">

                    <div class="card">
                        <div class="card-header bg-white">
                            <h5>{{ $job->title }}</h5>
                            <p>{{ $job->description }}</p>
                        </div>

                        <div class="card-body p-">
                            <h6><b>Applicants</b></h6>

                            @foreach ($job->applications as $key => $item)
                                <div class="job">
                                    <div class="title">
                                        <h5><b>{{ $item->applicant->first_name . ' ' . $item->applicant->last_name }}</b>
                                        </h5>
                                        @if (!is_null($item->profile))
                                            @php
                                                $education = json_decode($item->profile->education);
                                            @endphp
                                            <p class="m-0 p-1">
                                                {{ $item->profile->level . ' in ' . $item->profile->specialization . ' with ' . $item->profile->years_of_experience . ' years of experience' }}
                                            </p>
                                            @if (!is_null($education))
                                                <p class="m-0 p-0"><b>Education:</b>
                                                    {{ $education[0]->level . ' in ' . $education[0]->course }}</p>
                                            @else
                                                <p class="m-0 p-0"><b>Education:</b> Missing</p>
                                            @endif
                                        @endif
                                        <p></p>
                                    </div>
                                    <div class="desciption p-2">
                                        <p class="p-0 m-0"><b>Reason:</b> {{ $item->reason }}</p>
                                        <p class="p-0 m-0"><b>Cover Letter: </b>{{ $item->cover_letter }}</p>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between">
                                    <a href="{{ route('application.cvdownload',$item->id) }}" class="btn btn-outline-primary btn-sm">Download CV</a>
                                    @php
                                        $files = json_decode($item->files, 1);
                                    @endphp
                                    @foreach ($files as $file)
                                        <a href="#" class="btn btn-outline-primary btn-">Download</a>
                                    @endforeach
                                </div>

                        @endforeach
                    </div>
                </div>

            </div>
        </div>
        </div>
    </section>
@endsection

@section('footer_scripts')
    <script src="{{ asset('assets/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/profile.js') }}"></script>
@endsection
