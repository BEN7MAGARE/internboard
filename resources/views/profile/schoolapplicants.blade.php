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
        <div class="row">
            @foreach ($applications as $item)
            <div class="col-md-6 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title"><b>Student</b> : {{ $item->applicant->first_name }} {{ $item->applicant->last_name }}</h5>
                        <p class="card-text">
                            <strong>Applied for:</strong> {{ $item->job->title }}<br>
                            <strong>Company:</strong> {{ $item->job->corporate->name }}
                        </p>
                        <p class="p-0 m-0">Salary: {{ $item->job->salary_range }}</p>
                        <p class="p-0 m-0">Status: {{ $item->status }}</p>
                    </div>
                    <div class="card-footer bg-white">
                        <button type="button" class="btn btn-outline-primary" id="jobApplicationDetails" data-id="{{ $item->id }}">View Details</button>
                        <button type="button" class="btn btn-outline-primary" id="viewJobDetails" data-id="{{ $item->job_id }}" data-bs-toggle="modal" data-bs-target="#jobDetailsModalToggle">View Job</button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
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
<script src="{{ asset('js/functions.js') }}"></script>
<script src="{{ asset('js/job.js') }}"></script>
@endsection
