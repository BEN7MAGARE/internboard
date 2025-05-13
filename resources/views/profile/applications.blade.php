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
            <form action="" id="applicationsFilterForm">
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Job Title</label>
                            <select name="job_id" id="" class="form-control">
                                <option value="">Select Job</option>
                                @foreach ($jobs as $job)
                                <option value="{{ $job->id }}">{{ $job->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Start Date</label>
                            <input type="date" name="start_date" id="" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">End Date</label>
                            <input type="date" name="end_date" id="" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Status</label>
                            <select name="status" id="" class="form-control">
                                <option value="">Select Status</option>
                                <option value="pending">Pending</option>
                                <option value="accepted">Accepted</option>
                                <option value="rejected">Rejected</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-md"><i class="bi bi-filter-circle-fill"></i></button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-body">

        </div>
    </div>
</main>
@endsection

@section('footer_scripts')
<script src="{{ asset('js/select2.min.js') }}"></script>
<script src="{{ asset('js/profile.js') }}"></script>
@endsection
