@extends('layouts.dashboard')

@section('title')
Applicants @parent
@endsection

@section('header_styles')
<link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
@endsection

@section('subtitle')
Applicants
@endsection

@section('content')
<main class="mt-3 p-2">

    <div class="card p-2">
        <div class="card-header bg-white">
            <h4><b>{{ $job->title }}</b></h4>
            <p>{{ $job->description }}</p>
        </div>

        <form action="{{ route('applications.select') }}" method="post" id="applicantsSelectForm">
            @csrf
            <div class="card-body">
                @if ($job->applications_count > 0)
                <h5><b>Applicants</b></h5>
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
                                {{ $education[0]->level . ' in ' . $education[0]->course }}
                            </p>
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
                                <a href="{{ route('student.details', $item->id) }}" class="btn btn-light" target="__blank"><i class="fa fa-user"></i><br> View Profile</a>

                                <a href="{{ route('application.cvdownload', $item->id) }}" class="btn btn-light" target="__blank"><i class="fa fa-arrow-down"></i> <br>Download CV</a>
                                @php
                                $files = json_decode($item->files, 1);
                                @endphp
                                @foreach ($files as $file)
                                <a href="{{ route('download.file', $file) }}" class="btn btn-light" target="__blank"><i class="fa fa-arrow-down"></i> <br>Download</a>
                                @endforeach
                            </div>

                            <div class="col-md-2 mt-2">
                                <div class="form-check form-switch">
                                    <input class="form-check-input applicantSelectToggle" type="checkbox" role="switch" id="applicantSelectToggle{{ $item->id }}" value="{{ $item->id }}" {{ $item->status == 'selected' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="applicantSelectToggle{{ $item->id }}">Select
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="text-center">
                    <p class="text-danger">No applicants yet</p>
                </div>
                @endif

                @if ($job->applications_count > 0)
                <div class="mt-3">
                    <div class="form-group mb-2">
                        <label for="invitationLetter">Write invitation letter</label>
                        <textarea name="invitationLetter" id="invitationLetter" class="form-control form-control-lg"></textarea>
                    </div>
                    <div id="invitationFeedback"></div>
                    <div class="form-group text-end">
                        <button type="submit" class="btn btn-primary" id="submitInvitation">Save and send invitation</button>
                    </div>
                </div>
                @endif

            </div>

        </form>
    </div>

</main>
@endsection

@section('footer_scripts')
<script src="{{ asset('js/select2.min.js') }}"></script>
<script src="{{ asset('js/job.js') }}"></script>
@endsection
