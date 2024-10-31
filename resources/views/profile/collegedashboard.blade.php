@extends('layouts.app')

@section('title')
    Students @parent
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
                    <div class="row dashboard">
                        <div class="col-xxl-4 col-md-4 mb-3">
                            <a href="{{ route('college.students') }}">
                                <div class="card shadow-sm border-0">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0">
                                                <i class="bi bi-people-fill text-secondary fs-2"></i>
                                                <!-- Bootstrap Icon -->
                                            </div>
                                            <div class="ms-3">
                                                <h6 class="card-title mb-0">Total Students</h6>
                                                <h2 class="card-text mb-0">{{ $studentscount }}</h2>
                                                <small class="text-muted updatedText"></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-xxl-4 col-md-4 mb-3">
                            <a href="{{ route('college.applicants', 'pending') }}">
                                <div class="card shadow-sm border-0">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0">
                                                <i class="bi bi-people-fill text-primary fs-2"></i>
                                            </div>
                                            <div class="ms-3">
                                                <h6 class="card-title mb-0">Job Applications</h6>
                                                <h2 class="card-text mb-0">{{ $applicationscount[0]->applicant_count }}</h2>
                                                <small class="text-muted updatedText"></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-xxl-4 col-md-4 mb-3">
                            <a href="{{ route('college.applicants', 'selected') }}">
                                <div class="card shadow-sm border-0">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0">
                                                <i class="bi bi-people-fill text-info fs-2"></i>
                                            </div>
                                            <div class="ms-3">
                                                <h6 class="card-title mb-0">Selected for interview</h6>
                                                <h2 class="card-text mb-0">{{ $selectedcount[0]->applicant_count }}</h2>
                                                <small class="text-muted updatedText"></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-xxl-4 col-md-4 mb-3">
                            <a href="{{ route('college.applicants', 'hired') }}">
                                <div class="card shadow-sm border-0">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0">
                                                <i class="bi bi-people-fill text-success fs-2"></i>
                                            </div>
                                            <div class="ms-3">
                                                <h6 class="card-title mb-0">Hired Students</h6>
                                                <h2 class="card-text mb-0">{{ $hiredcount[0]->applicant_count }}</h2>
                                                <small class="text-muted updatedText"></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection

@section('footer_scripts')
    <script src="{{ asset('assets/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/moment.js') }}"></script>
    <script src="{{ asset('assets/js/dashboard.js') }}"></script>
@endsection
