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

                <div class="col-xl-12">

                    <div class="card">
                        <div class="card-body pt-3">

                            @php
                                $jobs = json_decode($student->profile?->work);
                                $education = json_decode($student->profile?->education);
                            @endphp

                            <div class="tab-content pt-2">

                                <p class="small">{{ $student->profile?->summary }}</p>

                                <h5 class="card-title">Profile Details</h5>
                                <div class="row">
                                    <div class="mt-2">
                                        <table class="table table-hover">
                                            <tr>
                                                <td><b>Full Name</b></td>
                                                <td>{{ $student->first_name . ' ' . $student->last_name }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><b>Education</b></td>
                                                @if (!is_null($education) && !empty($education))
                                                    <td>
                                                        {{ $education[0]?->level . ' in ' . $education[0]?->course }}
                                                    </td>
                                                @else
                                                    <td></td>
                                                @endif

                                            </tr>
                                            <tr>
                                                <td><b>Specialization</b></td>
                                                <td>
                                                    {{ $student->profile?->level . ' ' . $student->profile?->specialization . $student->profile?->years_of_experience }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><b>Address</b></td>
                                                <td>{{ $student->address }}</td>
                                            </tr>
                                            <tr>
                                                <td><b>Phone</b></td>
                                                <td>{{ $student->phone }}</td>
                                            </tr>
                                            <tr>
                                                <td><b>Email</b></td>
                                                <td>{{ $student->email }}</td>
                                            </tr>
                                        </table>
                                    </div>

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
    </section>

@endsection

@section('footer_scripts')
    <script src="{{ asset('assets/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/profile.js') }}"></script>
@endsection
