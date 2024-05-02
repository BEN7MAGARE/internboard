@extends('layouts.app')

@section('title')
    Profile @parent
@endsection

@section('header_styles')
    <link rel="stylesheet" href="{{ asset('assets/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/profile.css') }}">
    <script>
        $.fn.modal.Constructor.prototype.enforceFocus = function() {};
    </script>
@endsection

@section('content')
    <section class="section profile" style="background:#EAFAF1;">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 mb-4">

                    <div class="card">

                        <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                            <img src="assets/img/avatar.png" alt="Profile" class="rounded-circle">
                            <h2>{{ !is_null(auth()->user()->title) ? auth()->user()->title . '. ' . auth()->user()->first_name . ' ' . auth()->user()->last_name : ' ' . auth()->user()->first_name . ' ' . auth()->user()->last_name }}
                            </h2>

                            <h3>{{ auth()->user()->profile?->specialization }}</h3>

                            <div class="social-links mt-2">
                                <a href="{{ auth()->user()->twitter }}" class="twitter text-primary"><i
                                        class="bi bi-twitter"></i></a>
                                <a href="{{ auth()->user()->facebook }}" class="facebook text-primary"><i
                                        class="bi bi-facebook"></i></a>
                                <a href="{{ auth()->user()->instagram }}" class="instagram text-primary"><i
                                        class="bi bi-instagram"></i></a>
                                <a href="{{ auth()->user()->linkedin }}" class="linkedin text-primary"><i
                                        class="bi bi-linkedin"></i></a>
                            </div>
                        </div>

                        <div class="card-footer bg-white">
                            <div class="list-group">
                                <a href="{{ route('profile.edit') }}" class="list-group-item list-group-item-action"
                                    aria-current="true">My Profile</a>
                                <a href="{{ route('applications.index') }}"
                                    class="list-group-item list-group-item-action">My Applications</a>

                                <a href="{{ route('profile.jobs') }}"
                                    class="list-group-item list-group-item-action active">My
                                    Jobs</a>

                                <a href="#" class="list-group-item list-group-item-action"><i
                                        class="fa fa-sign-out text-warning"></i> Logout</a>

                            </div>
                        </div>

                    </div>

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
                                        <h6>{{ $item->reason }}</h6>
                                    </div>
                                    <div class="desciption p-2">
                                        <p>{{ $item->cover_letter }}</p>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between">
                                    <a href="#" class="btn btn-outline-primary btn-sm">Download CV</a>
                                    @php
                                        $files = json_decode($item->files, 1);
                                    @endphp
                                    @foreach ($files as $file)
                                        <a href="#" class="btn btn-outline-primary btn-">Download</a>
                                    @endforeach
                                </div>
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
