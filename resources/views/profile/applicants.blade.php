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
                <div class="col-xl-3 mb-4 card">
                    @include('profile.partials.sidebarnav')
                </div>

                <div class="col-xl-9">

                    <div class="card">
                        <div class="card-header bg-white">
                            <h4><b>{{ $job->title }}</b></h4>
                            <p>{{ $job->description }}</p>
                        </div>

                        <form action="{{ route('applications.select') }}" method="post" id="applicantsSelectForm">
                            @csrf
                            <div class="card-body">
                                <h4><b>Applicants</b></h4>
                                <div class="scrollable-div">
                                    @foreach ($job->applications as $key => $item)
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-12 title">
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
                                            </div>

                                            <div class="col-md-12 desciption p-2">
                                                <p class="p-0 m-0"><b>Reason:</b> {{ $item->reason }}</p>
                                                <p class="p-0 m-0"><b>Cover Letter: </b>{{ $item->cover_letter }}</p>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-10">
                                                    <a href="{{ route('student.details', $item->id) }}"
                                                        class="btn btn-light btn-lg" target="__blank"><i
                                                            class="bi bi-arrow-down-circle"></i><br> View Profile</a>

                                                    <a href="{{ route('application.cvdownload', $item->id) }}"
                                                        class="btn btn-light btn-lg" target="__blank"><i
                                                            class="bi bi-arrow-down-circle"></i> <br>Download CV</a>
                                                    @php
                                                        $files = json_decode($item->files, 1);
                                                    @endphp
                                                    @foreach ($files as $file)
                                                        <a href="{{ route('download.file', $file) }}"
                                                            class="btn btn-light btn-lg" target="__blank"><i
                                                                class="bi bi-arrow-down-circle"></i> <br>Download</a>
                                                    @endforeach
                                                </div>

                                                <div class="col-md-2 mt-2">
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input applicantSelectToggle"
                                                            type="checkbox" role="switch"
                                                            id="applicantSelectToggle{{ $item->id }}"
                                                            value="{{ $item->id }}" {{ $item->status == "selected"?"checked":"" }}>
                                                        <label class="form-check-label"
                                                            for="applicantSelectToggle{{ $item->id }}">Select </label>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                    @endforeach
                                </div>

                                <div class="mt-3">
                                    <div class="form-group mb-2">
                                        <label for="invitationLetter">Write invitation letter</label>
                                        <textarea name="invitationLetter" id="invitationLetter" class="form-control form-control-lg"></textarea>
                                    </div>
                                    <div id="invitationFeedback"></div>
                                    <div class="form-group text-end">
                                        <button type="submit" class="btn btn-primary">Save and send invitation</button>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection

@section('footer_scripts')
    <script src="{{ asset('assets/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/job.js') }}"></script>
@endsection
