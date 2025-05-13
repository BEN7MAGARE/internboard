@extends('layouts.dashboard')

@section('title')
Student Profile @parent
@endsection

@section('header_styles')
<link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endsection

@section('content')
<main class="mt-3 p-2">
    <div class="card p-2">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header bg-white">
                        <h5>Student Summary</h5>
                    </div>
                    <div class="card-body">
                        @php
                        $jobs = json_decode($student->profile?->work);
                        $education = json_decode($student->profile?->education);
                        @endphp
                        <div class="tab-content">
                            <p class="small">{{ $student->profile?->summary }}</p>
                            <div class="row">

                                <div class="col-md-3">
                                    @if ($student->image !== null)
                                    <img src="{{ asset('profilepictures/' . $student->image) }}" alt="Profile" class="rounded-circle img-fluid">
                                    @else
                                    <img src="{{ asset('images/avatar.png') }}" alt="Profile" class="rounded-circle img-fluid">
                                    @endif
                                </div>

                                <div class="col-md-9">
                                    <div class="row">
                                        <div class="col-4">
                                            <span><b>Full Name</b></span>
                                        </div>
                                        <div class="col-8">
                                            <span>{{ $student->first_name . ' ' . $student->last_name }}</span>
                                        </div>
                                        <hr>
                                        <div class="col-4">
                                            <span><b>Education</b></span>
                                        </div>
                                        <div class="col-8">
                                            @if (!is_null($education) && !empty($education))
                                            <span>{{ $education[0]?->level . ' in ' . $education[0]?->course }}</span>
                                            @endif
                                        </div>
                                        <hr>
                                        <div class="col-4">
                                            <span><b>Specialization</b></span>
                                        </div>
                                        <div class="col-8">
                                            <span>{{ $student->profile?->level . ' ' . $student->profile?->specialization . $student->profile?->years_of_experience }}</span>
                                        </div>
                                        <hr>
                                        <div class="col-4">
                                            <span><b>Address</b></span>
                                        </div>
                                        <div class="col-8">
                                            <span>{{ $student->address }}</span>
                                        </div>
                                        <hr>
                                        <div class="col-4">
                                            <span><b>Phone</b></span>
                                        </div>
                                        <div class="col-8">
                                            <span>{{ $student->phone }}</span>
                                        </div>
                                        <hr>
                                        <div class="col-4">
                                            <span><b>Email</b></span>
                                        </div>
                                        <div class="col-8">
                                            <span>{{ $student->email }}</span>
                                        </div>
                                        <hr>
                                    </div>

                                </div>
                            </div>

                            @php
                            $skills = $student->skills;
                            @endphp
                            @if ($skills->isNotEmpty())
                            <div class="skills-section mb-3">
                                <h5 class="mb-2">Skills</h5>
                                <div class="skills">
                                    @foreach ($student->skills as $item)
                                    <span>{{ $item->name }}</span>
                                    @endforeach
                                </div>
                            </div>
                            @endif
                            <div class="row">
                                @if ($student->role === 'student')
                                <div class="col-md-6">
                                    @if (!empty($jobs) && !is_null($jobs))
                                    <h5 class="text-info">Work Experience</h5>
                                    @foreach ($jobs as $job)
                                    <div class="card alert alert-primary">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $job->title }}</h5>
                                            <h6 class="card-subtitle mb-2 text-muted">
                                                {{ $job->company }}</h6>
                                            <p class="card-text">
                                                <strong>Duration:</strong>
                                                {{ date('M Y', strtotime($job->start_date)) }} -
                                                {{ date('M Y', strtotime($job->end_date)) }}
                                            </p>
                                        </div>
                                    </div>
                                    @endforeach
                                    @endif
                                </div>

                                <div class="col-md-6">
                                    @if (!empty($education) && !is_null($education))
                                    <h5 class="text-info">Education Background</h5>
                                    @foreach ($education as $item)
                                    <div class="card alert alert-warning">
                                        <div class="card-body">
                                            <h5 class="card-title">
                                                {{ $item->level . ' in ' . $item->course }}</h5>
                                            <h6 class="card-subtitle mb-2 text-muted">
                                                {{ $item->institution }}</h6>
                                            <p class="card-text">
                                                <strong>Duration:</strong>
                                                {{ date('Y', strtotime($item->start_date)) }} -
                                                {{ date('Y', strtotime($item->end_date)) }}
                                            </p>
                                        </div>
                                    </div>
                                    @endforeach
                                    @endif
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection

@section('footer_scripts')
<script src="{{ asset('js/select2.min.js') }}"></script>
<script src="{{ asset('js/profile.js') }}"></script>
@endsection
