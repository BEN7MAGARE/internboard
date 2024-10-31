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

                    <div class="card">
                        <div class="card-header bg-white">
                            <h4 class="card-title">Our Students</h4>
                        </div>

                        <div class="row">
                            <!-- Example applicant card -->
                            <div class="col-md-6 mb-4">
                                <div class="card shadow-sm">
                                    <div class="card-body">
                                        <h5 class="card-title">John Doe</h5>
                                        <p class="card-text">
                                            <strong>Applied for:</strong> Software Developer<br>
                                            <strong>Company:</strong> Tech Solutions Inc.
                                        </p>
                                        <button type="button" class="btn btn-primary">View Details</button>
                                    </div>
                                </div>
                            </div>

                            <!-- Repeat the card for each applicant -->
                            <div class="col-md-6 mb-4">
                                <div class="card shadow-sm">
                                    <div class="card-body">
                                        <h5 class="card-title">Jane Smith</h5>
                                        <p class="card-text">
                                            <strong>Applied for:</strong> Data Analyst<br>
                                            <strong>Company:</strong> Data Insights LLC
                                        </p>
                                        <button type="button" class="btn btn-primary">View Details</button>
                                    </div>
                                </div>
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
