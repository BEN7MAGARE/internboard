@extends('layouts.dashboard')

@section('title')
Students @parent
@endsection

@section('header_styles')
<link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endsection

@section('subtitle')
Students
@endsection

@section('content')
<main class="mt-3 p-2">
    <section class="main-content">
        <div class="row">
            <div class="col-xl-12">
                <div class="row dashboard">
                    <div class="col-xxl-4 col-md-4 mb-3">
                        <a href="{{ route('college.students') }}">
                            <div class="card shadow-sm border-0">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <i class="bi bi-people-fill text-secondary fs-2"></i>
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
                {{-- <div class="row mt-4">
                        <h4>Latest Opportunities</h4>
                        <div class="swiper">
                            <div class="row" id="latestJobsSection"></div>
                        </div>
                    </div> --}}
            </div>

        </div>
    </section>
</main>

<div class="modal fade" id="jobDetailsModalToggle" aria-hidden="true" aria-labelledby="jobDetailsModalToggleLabel" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-primary" id="jobModalTitle"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="jobDetailsSection">

            </div>

            <div class="modal-footer" id="jobActionSection">

            </div>
        </div>
    </div>
</div>
@endsection

@section('footer_scripts')
<script src="{{ asset('js/select2.min.js') }}"></script>
<script src="{{ asset('js/dashboard.js') }}"></script>
@endsection
