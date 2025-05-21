@extends('layouts.dashboard')

@section('title')
Job Create
@endsection

@section('header_styles')
<link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
<style>
    .step-2 {
        display: none;
    }

</style>
@endsection

@section('subtitle')
Job Create
@endsection

@section('content')
<main class="mt-3 p-2">

    <div class="card p-2">
        <form action="{{ route('jobs.store') }}" id="jobCreateForm">
            @csrf
            <div class="card-body  step-1">
                <div class="row" id="jobFormSection">

                    <div class="col-md-6 mb-2">
                        <label for="categoryID">Category / Industry</label>
                        <select name="category_id" id="categoryID" class="form-select">
                        </select>
                    </div>

                    <div class="col-md-6 mb-2">
                        <label for="subcategoryID">Sub-category</label>
                        <select name="subcategory_id" id="subcategoryID" class="form-select">
                        </select>
                    </div>

                    <div class="col-md-6 mb-2">
                        <label for="employmentType">Employment Type</label>
                        <select name="type" id="employmentType" class="form-select">
                            <option value="">Select One</option>
                            <option value="Internship">Internship</option>
                            <option value="Part-time">Part Time</option>
                            <option value="Full Time">Full Time</option>
                            <option value="Contract">Contract</option>
                            <option value="Freelance">Freelance</option>
                            <option value="Temporary">Temporary</option>
                        </select>
                    </div>

                    <div class="col-md-6 mb-2">
                        <label for="jobType">Job Type</label>
                        <select name="job_type" id="jobType" class="form-select">
                            <option value="">Select One</option>
                            <option value="Remote">Remote</option>
                            <option value="On-site">On-Site</option>
                            <option value="High-breed">High-breed</option>
                        </select>
                    </div>

                    <div class="col-md-6 mb-2">
                        <label for="experienceLevel">Experience Level</label>
                        <select name="experience_level" id="experienceLevel" class="form-select">
                            <option value="">Select One</option>
                            <option value="Entry">Entry Level</option>
                            <option value="Intermediate">Intermediate Level</option>
                            <option value="Expert">Expert Level</option>
                        </select>
                    </div>

                    <div class="col-md-6 mb-2">
                        <label for="location">Location</label>
                        <input type="text" class="form-control" name="location" id="location">
                    </div>
                </div>

                <div class="card-footer bg-white">
                    <div class="text-end">
                        {{-- <a class="btn btn-outline-primary" disabled id="toggleprevioussection"><i
                                                class="fa fa-arrow-left"></i>&nbsp;
                                            Back</a> --}}
                        <a class="btn btn-primary btn-lg" id="startButton">Next&nbsp;>></a>
                    </div>
                </div>
            </div>

            <div class="card-body step-2">
                <div class="row">
                    
                    <div class="col-md-6 form-group">
                        <label for="educationLevel">Education Level</label>
                        <select name="education_level" id="educationLevel" class="form-select">
                            <option value="">Select One</option>
                            <option value="Certificate">Certificate</option>
                            <option value="Diploma">Diploma</option>
                            <option value="Degree">Degree</option>
                            <option value="Masters">Masters</option>
                            <option value="Doctorate">Doctorate</option>
                        </select>
                    </div>

                    <div class="col-md-6 form-group">
                        <label for="skills">Skills</label>

                        <div class="form-group">
                            <select name="skills" id="skills" class="form-control" multiple style="width:100%;">

                            </select>
                        </div>
                    </div>

                    <div class="col-md-6 form-group">
                        <label for="lastName">Salary range</label>
                        <input type="text" class="form-control" name="salary_range" id="salaryRange">
                    </div>

                    <div class="col-md-6 form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" name="title" id="title">
                    </div>

                    <div class="col-md-6 form-group">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" class="form-control"></textarea>
                    </div>

                    <div class="col-md-6 form-group">
                        <label for="noOfPositions">No of positions</label>
                        <input type="number" name="no_of_positions" id="noOfPositions" class="form-control">
                    </div>

                    <div class="col-md-6 form-group">
                        <label for="startDate">Application deadline</label>
                        <input type="date" name="applicationEndDate" id="applicationEndDate" class="form-control" min="{{ date('Y-m-d') }}" required>
                    </div>

                    <div class="col-md-6 form-group">
                        <label for="startDate">Job Start Date</label>
                        <input type="date" name="start_date" id="startDate" class="form-control" min="{{ date('Y-m-d') }}" required>
                    </div>

                    <br>
                </div>
                <div id="jobFeedback"></div>

                <div class="card-footer bg-white">
                    <div class="d-flex align-items-center justify-content-between mt-3">
                        <a class="btn btn-warning btn-lg" id="toggleprevioussection">
                            << Back</a>

                                <button type="submit" class="btn btn-primary  btn-lg" id="jobSubmit"><i class="fa fa-server"></i> Save</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

</main>
@endsection

@section('footer_scripts')
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/select2.min.js') }}"></script>
<script src="{{ asset('js/jobs/create.js') }}"></script>
@endsection
