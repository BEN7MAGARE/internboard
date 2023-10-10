@extends('layouts.app')

@section('title')
    Job Create
@endsection

@section('header_styles')
@endsection

@section('content')
    <main id="main">
        <section class="job-section">
            <div class="container d-flex align-items-center justify-content-center">
                <div class="col-lg-7">
                    <div class="card">
                        <div class="card-header bg-white text-center">
                            <h5 class="mt-2"><b>New Job Post</b></h5>
                        </div>
                        <form action="{{ route('jobs.store') }}" id="jobCreateForm">
                            @csrf
                            <div class="card-body">
                                <div class="row" id="jobFormSection">

                                    <div class="col-md-12 form-group">
                                        <label for="categoryID">Industry</label>
                                        <select name="category_id" id="categoryID" class="form-select" required>

                                        </select>
                                    </div>

                                    <div class="col-md-12 form-group">
                                        <label for="employmentType">Employment Type</label>
                                        <select name="type" id="employmentType" class="form-select" required>
                                            <option value="">Select One</option>
                                            <option value="Internship">Internship</option>
                                            <option value="Part-time">Part Time</option>
                                            <option value="Full Time">Full Time</option>
                                            <option value="Contract">Contract</option>
                                            <option value="Freelance">Freelance</option>
                                            <option value="Temporary">Temporary</option>
                                        </select>
                                    </div>

                                    <div class="col-md-12 form-group">
                                        <label for="jobType">Job Type</label>
                                        <select name="job_type" id="jobType" class="form-select" required>
                                            <option value="">Select One</option>
                                            <option value="Remote">Remote</option>
                                            <option value="On-site">On-Site</option>
                                            <option value="High-breed">High-breed</option>
                                        </select>
                                    </div>

                                    <div class="col-md-12 form-group">
                                        <label for="experienceLevel">Experience Level</label>
                                        <select name="experience_level" id="experienceLevel" class="form-select" required>
                                            <option value="">Select One</option>
                                            <option value="Entry">Entry Level</option>
                                            <option value="Intermediate">Intermediate Level</option>
                                            <option value="Expert">Expert Level</option>
                                        </select>
                                    </div>

                                    <div class="col-md-12 form-group">
                                        <label for="location">Location</label>
                                        <input type="text" class="form-control" name="location" id="location" required>
                                    </div>

                                    {{-- <div class="col-md-12 form-group"><label for="educationLevel">Education
                                            Level</label><select name="education_level" id="educationLevel"
                                            class="form-select" required>
                                            <option value="">Select One</option>
                                            <option value="Certificate">Certificate</option>
                                            <option value="Diploma">Diploma</option>
                                            <option value="Degree">Degree</option>
                                            <option value="Masters">Masters</option>
                                            <option value="Doctorate">Doctorate</option>
                                        </select></div>
                                    <div class="col-md-12 form-group"><label for="skills">Skills</label><select
                                            name="skills" id="skills" class="form-select" required>
                                            <option value="">Select One</option>
                                        </select></div>
                                    <div class="col-md-12 form-group"><label for="lastName">Salary range</label><input
                                            type="text" class="form-control form-control" name="salary_range"
                                            id="salaryRange" required></div>
                                    <div class="col-md-12 form-group"><label for="title">Title</label><input
                                            type="text" class="form-control form-control" name="title" id="title"
                                            required></div>
                                    <div class="col-md-12 form-group"><label for="description">Description</label>
                                        <textarea name="description" id="description" class="form-control form-control-lg"></textarea>
                                    </div> --}}
                                    {{-- <div class="col-md-12 form-group"><label for="description">Start Date</label><input type="date" name="start_date" id="startDate" class="form-control form-control-lg"></div> --}}

                                </div>
                                <div id="jobFeedback"></div>
                            </div>

                            <div class="card-footer bg-white">
                                <div class="d-flex align-items-center justify-content-between">
                                    <button class="btn btn-outline-primary" disabled id="toggleprevioussection"><i
                                            class="fa fa-arrow-left"></i>&nbsp;
                                        Back</button>
                                    <button class="btn btn-primary" id="startButton">Next&nbsp;<i
                                            class="fa fa-arrow-right"></i></button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

@section('footer_scripts')
    <script src="{{ asset('assets/js/job.js') }}"></script>
@endsection
