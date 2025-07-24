@extends('layouts.dashboard')

@section('title')
    Job Create
@endsection

@section('header_styles')
    <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
    <style>
        .step-2,
        .step-3 {
            display: none;
        }
    </style>
@endsection

@section('subtitle')
    Job Create
@endsection

@section('content')
    <main class="mt-3 p-2">

        <div class="alert alert-info alert-dismissible fade show" role="alert">
            <i class="bi bi-info-circle-fill"></i>&nbsp;<strong>Note:</strong> You can post your jobs here for advertisement
            on our platform and get most qualied and talented applicants.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>

        <div class="card p-2">
            <form action="{{ route('jobs.store') }}" id="createJobForm">
                @csrf
                <div class="card-body  step-1">
                    <div class="row" id="jobFormSection">
                        <input type="hidden" name="id" id="jobID" value="">
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
                            <select name="job_type" id="jobType" class="form-select" required>
                                <option value="">Select One</option>
                                <option value="Remote">Remote</option>
                                <option value="On-site">On-Site</option>
                                <option value="High-breed">High-breed</option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-2">
                            <label for="experienceLevel">Experience Level</label>
                            <select name="experience_level" id="experienceLevel" class="form-select" required>
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
                    <div id="step1Feedback"></div>
                    <div class="mt-2">
                        <div class="text-end">
                            {{-- <a class="btn btn-outline-primary" disabled id="toggleprevioussection"><i
                                                class="fa fa-arrow-left"></i>&nbsp;
                                            Back</a> --}}
                            <button type="button" class="btn btn-primary" id="startButton">Next&nbsp;>></button>
                        </div>
                    </div>
                </div>

                <div class="card-body step-2">
                    <div class="row">

                        <div class="col-md-6 form-group">
                            <label for="educationLevel">Education Level</label>
                            <select name="education_level" id="educationLevel" class="form-select">
                                <option value="">Select One</option>
                                <option value="No Education">No Education</option>
                                <option value="Certificate">Certificate</option>
                                <option value="Diploma">Diploma</option>
                                <option value="Degree">Degree</option>
                                <option value="Masters">Masters</option>
                                <option value="Doctorate">Doctorate</option>
                            </select>
                        </div>

                        <div class="col-md-6 form-group">
                            <label for="skills">Skills</label><br>
                            <div class="d-flex justify-content-between">
                                <i class="bi bi-info-circle-fill">Select multiple skills</i>
                                <a href="javascript:void(0);" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#createSkillModal"><i class="bi bi-plus" data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="Add Skill"></i></a>
                            </div>
                            <div class="form-group">
                                <select name="skills" id="skills" class="form-control" multiple style="width:100%;">
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6 form-group">
                            <label for="salaryRange" class="form-label">Salary Range (KES)</label>
                            <select name="salary_range" id="salaryRange" class="form-select" required>
                                <option value="" disabled selected>Select salary range</option>
                                <option value="0-9999">Less than 10,000</option>
                                <option value="10000-19999">10,000 – 19,999</option>
                                <option value="20000-29999">20,000 – 29,999</option>
                                <option value="30000-49999">30,000 – 49,999</option>
                                <option value="50000-99999">50,000 – 99,999</option>
                                <option value="100000-149999">100,000 – 149,999</option>
                                <option value="150000-199999">150,000 – 199,999</option>
                                <option value="200000-299999">200,000 – 299,999</option>
                                <option value="300000-499999">300,000 – 499,999</option>
                                <option value="500000-999999">500,000 – 999,999</option>
                                <option value="1000000+">1,000,000 and above</option>
                            </select>
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
                            <input type="date" name="application_end_date" id="applicationEndDate"
                                class="form-control" min="{{ date('Y-m-d') }}" required>
                        </div>

                        <div class="col-md-6 form-group">
                            <label for="startDate">Job Start Date</label>
                            <input type="date" name="start_date" id="startDate" class="form-control"
                                min="{{ date('Y-m-d') }}" required>
                        </div>

                        <br>
                    </div>

                    <div id="step2Feedback"></div>

                    <div class="mt-2">
                        <div class="d-flex align-items-center justify-content-between mt-3">
                            <button type="button" class="btn btn-warning toggleStep1">
                                << Back</button>

                                    <button type="button" class="btn btn-primary toggleStep3"><i
                                            class="fa fa-server"></i> Next >></button>
                        </div>
                    </div>
                </div>

                <div class="card-body step-3">
                    <div class="row">

                        <div class="col-md-12 d-flex align-items-end gap-2 mb-2">
                            <div class="flex-grow-1">
                                <label for="jobQualification" class="form-label">Qualifications</label>
                                <input type="text" class="form-control" name="qualification" id="jobQualification">
                            </div>
                            <div>
                                <button type="button" class="btn btn-primary" id="addQualificationToggle">
                                    <i class="bi bi-plus"></i>
                                </button>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Qualification</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="jobQualificationsTableBody">
                                </tbody>
                            </table>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-12 d-flex align-items-end gap-2 mb-2">
                            <div class="flex-grow-1">
                                <label for="jobRequirement" class="form-label">Requirements</label>
                                <input type="text" class="form-control" name="requirement" id="jobRequirement">
                            </div>
                            <div>
                                <button type="button" class="btn btn-primary" id="addRequirementToggle">
                                    <i class="bi bi-plus"></i>
                                </button>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Requirement</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="jobRequirementsTableBody">
                                </tbody>
                            </table>
                        </div>

                    </div>

                    <div id="jobFeedback"></div>

                    <div class="mt-2">
                        <div class="d-flex align-items-center justify-content-between mt-3">
                            <button type="button" class="btn btn-warning toggleStep2">
                                << Back</button>

                                    <button type="submit" class="btn btn-primary" id="jobSubmit"><i
                                            class="fa fa-server"></i> Save</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="modal fade" id="createSkillModal" tabindex="-1" aria-labelledby="createSkillModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createSkillModalLabel">Create Skill</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('skills.store') }}" method="POST" id="createSkillForm">

                        <div class="modal-body">
                            @csrf
                            <div class="mb-3">
                                <label for="skillCategoryID" class="form-label">Category</label>
                                <select name="category_id" id="skillCategoryID" class="form-control" required>

                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="skillName" class="form-label">Skill Name</label>
                                <input type="text" class="form-control" id="skillName" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="skillDescription" class="form-label">Description</label>
                                <textarea class="form-control" id="skillDescription" name="description"></textarea>
                            </div>
                        </div>
                        <div id="skillFeedback"></div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </main>
@endsection

@section('footer_scripts')
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/select2.min.js') }}"></script>
    <script src="{{ asset('js/functions.js') }}"></script>
    <script src="{{ asset('js/jobs/create.js') }}"></script>
@endsection
