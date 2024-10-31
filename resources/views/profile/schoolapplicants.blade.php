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
                    <div class="row">
                        @foreach ($applications as $item)
                            <div class="col-md-6 mb-4">
                                <div class="card shadow-sm">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $item->student_anme }}</h5>
                                        <p class="card-text">
                                            <strong>Applied for:</strong> {{ $item->title }}<br>
                                            <strong>Company:</strong> {{ $item->company_name }}
                                        </p>
                                        <span>Status: {{ $item->status }}</span>
                                    </div>
                                    <div class="card-body d-flex justify-between">
                                        <button type="button" class="btn btn-primary" id="jobApplicationDetails"
                                            data-id="{{ $item->id }}">View Details</button>
                                        <button type="button" class="btn btn-primary job" id="viewJobDetails"
                                            data-id="{{ $item->ref_no }}">View Job</button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="jobDetailsModalToggle" aria-hidden="true" aria-labelledby="jobDetailsModalToggleLabel"
        tabindex="-1">
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
    <script src="{{ asset('assets/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/job.js') }}"></script>
    {{-- <script src="{{ asset('assets/js/profile.js') }}"></script> --}}
@endsection
