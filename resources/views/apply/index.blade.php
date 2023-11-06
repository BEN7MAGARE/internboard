@extends('layouts.app')

@section('title')
    Applications @parent
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
        @if (auth()->user()->role === 'student')
            <div class="container">
                <div class="row">
                    <div class="col-xl-3 mb-4">

                        <div class="card">

                            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                                @if (auth()->user()->image !== null)
                                    <img src="{{ asset('profiles/' . auth()->user()->image) }}" alt="Profile"
                                        class="rounded-circle">
                                @else
                                    <img src="assets/img/avatar.png" alt="Profile" class="rounded-circle">
                                @endif

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
                                        aria-current="true">My
                                        Profile</a>
                                    <a href="{{ route('applications.index') }}"
                                        class="list-group-item list-group-item-action active">My Applications</a>
                                    <a href="#" class="list-group-item list-group-item-action">My Jobs</a>
                                    <a href="#" class="list-group-item list-group-item-action"><i
                                            class="fa fa-sign-out text-warning"></i> Logout</a>

                                </div>
                            </div>

                        </div>

                    </div>

                    <div class="col-xl-9">

                        <div class="card">
                            <div class="card-body pt-3">

                                <div class="accordion" id="accordionExample">
                                    @foreach ($applications as $application)
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                    data-bs-target="#collapseOne" aria-expanded="true"
                                                    aria-controls="collapseOne">
                                                    {!! '<strong>' . $application->job->corporate->name . '</strong>' . ': &nbsp;&nbsp;' . $application->job->title !!}
                                                </button>
                                            </h2>

                                            <div id="collapseOne" class="accordion-collapse collapse"
                                                data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <div class="reason mb-2">
                                                        <p><b>Reason</b></p>
                                                        <p>{{ $application->reason }}</p>
                                                    </div>
                                                    <div class="reason mb-2">
                                                        <p><b>Cover Letter</b></p>
                                                        <p>{{ $application->cover_letter }}</p>
                                                    </div>
                                                    <div class="section-action d-flex justify-content-between">
                                                        <a href="" class="btn btn-outline-primary">Edit</a>
                                                        <a href="" class="btn btn-outline-danger">Cancel</a>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    @endforeach

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        @endif
        @if (auth()->user()->role == "corporate")

        @endif
    </section>
@endsection

@section('footer_scripts')
    <script src="{{ asset('assets/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/profile.js') }}"></script>
@endsection
