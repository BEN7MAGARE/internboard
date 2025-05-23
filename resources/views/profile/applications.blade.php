@extends('layouts.dashboard')

@section('title')
Applications @parent
@endsection

@section('subtitle')
Applications
@endsection

@section('header_styles')
<link rel="stylesheet" href="{{ asset('assets/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/profile.css') }}">
@endsection

@section('content')
<main class="mt-3 p-2">
    <div class="card p-2">
        <div class="card-header">
            <form action="" id="filterApplicantsForm">
                <div class="row">

                    <div class="col-md-5">
                        <select name="job_id" id="job_id" class="form-select">
                            <option value="">All Jobs</option>
                            @foreach ($jobs as $job)
                            <option value="{{ $job->id }}">{{ $job->title }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-2">
                        <select name="status" id="status" class="form-select">
                            <option value="">All</option>
                            <option value="pending">Pending</option>
                            <option value="accepted">Accepted</option>
                            <option value="rejected">Rejected</option>
                        </select>
                    </div>

                    <div class="col-md-2">
                        <input type="date" name="start_date" id="start_date" class="form-control">
                    </div>

                    <div class="col-md-2">
                        <input type="date" name="end_date" id="end_date" class="form-control">
                    </div>

                    <div class="col-md-1">
                        <button type="submit" class="btn btn-primary"><i class="bi bi-search"></i></button>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-body table-container">
            <table class="table table-striped table-hover table-bordered table-sm">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Applicant</th>
                        <th>Job Title</th>
                        <th>Job Type</th>
                        <th>Employment Type</th>
                        <th>Location</th>
                        <th>Application Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($applications as $application)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $application->applicant->first_name." ".$application->applicant->last_name }}</td>
                        <td>{{ $application->job->title }}</td>
                        <td>{{ $application->job->job_type }}</td>
                        <td>{{ $application->job->type }}</td>
                        <td>{{ $application->job->location }}</td>
                        <td>{{ $application->created_at->format('j M Y') }}</td>
                        <td>
                            @if ($application->status == "pending")
                            <span class="badge bg-warning">Pending</span>
                            @elseif ($application->status == "accepted")
                            <span class="badge bg-success">Accepted</span>
                            @else
                            <span class="badge bg-danger">Rejected</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('jobs.show', $application->job->id) }}" class="btn btn-primary btn-sm">View</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-2 text-end">
                {{ $applications->links() }}
            </div>
        </div>
    </div>
</main>
@endsection

@section('footer_scripts')
<script src="{{ asset('js/select2.min.js') }}"></script>
<script src="{{ asset('js/profile.js') }}"></script>
@endsection
