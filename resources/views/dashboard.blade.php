@extends('layouts.dashboard')

@section('title')
    Dashboard @parent
@endsection

@section('header_styles')
@endsection

@section('subtitle')
    Dashboard
@endsection

@section('content')
    <section class="w3l-main-content">
        <main class="mt-3 p-2">
            <section class="content">
                <div class="row">

                    <div class="col-md-3">
                        <div class="card stat-card">
                            <div class="stat-number">
                                {{ $jobcount }}
                            </div>
                            <div class="stat-label translatable">Jobs</div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card stat-card" style="border-left-color: var(--success-color);">
                            <div class="stat-number" style="color: var(--success-color);">
                                {{ $corporatecount }}
                            </div>
                            <div class="stat-label translatable">Employers</div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card stat-card" style="border-left-color: var(--accent-color);">
                            <div class="stat-number" style="color: var(--accent-color);">
                                {{ $applicationcount }}
                            </div>
                            <div class="stat-label translatable">Applications</div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card stat-card" style="border-left-color: var(--primary-color);">
                            <div class="stat-number" style="color: var(--primary-color);">
                                {{ $studentcount }}
                            </div>
                            <div class="stat-label translatable">Students</div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card stat-card" style="border-left-color: var(--success-color);">
                            <div class="stat-number" style="color: var(--success-color);">
                                {{ $workercount }}
                            </div>
                            <div class="stat-label translatable">Workers</div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card stat-card" style="border-left-color: var(--accent-color);">
                            <div class="stat-number" style="color: var(--accent-color);">
                                {{ $collegecount }}
                            </div>
                            <div class="stat-label translatable">Colleges</div>
                        </div>
                    </div>
                </div>

                <div class="card">


                </div>
            </div>
            </section>
        </main>
    </section>
@endsection

@section('footer_scripts')
    <script src="{{ asset('assets/js/dashboard.js') }}"></script>
@endsection
