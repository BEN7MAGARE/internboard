@extends('layouts.dashboard')

@section('title')
    Job Edit
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
    Job Edit
@endsection

@section('content')
    <main class="mt-3 p-2">

        <div class="card p-2">
            <form action="{{ route('jobs.store') }}" id="createJobForm">
                @csrf
                <div class="card-body  step-1">
                    <div class="row" id="jobFormSection">

                        <input type="hidden" name="id" id="jobID" value="{{ $job->id }}">

                        <div class="col-md-6 mb-2">
                            <label for="categoryID">Category / Industry</label>
                            <select name="category_id" id="categoryID" class="form-select">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ $job->category_id == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 mb-2">
                            <label for="subcategoryID">Sub-category</label>
                            <select name="subcategory_id" id="subcategoryID" class="form-select">
                                @foreach ($subCategories as $subCategory)
                                    <option value="{{ $subCategory->id }}" {{ $job->subcategory_id == $subCategory->id ? 'selected' : '' }}>
                                        {{ $subCategory->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 mb-2">
                            <label for="employmentType">Employment Type</label>
                            <select name="type" id="employmentType" class="form-select">
                                <option value="">Select One</option>
                                <option value="Internship" {{ $job->type == 'Internship' ? 'selected' : '' }}>Internship</option>
                                <option value="Part-time" {{ $job->type == 'Part-time' ? 'selected' : '' }}>Part Time</option>
                                <option value="Full Time" {{ $job->type == 'Full Time' ? 'selected' : '' }}>Full Time</option>
                                <option value="Contract" {{ $job->type == 'Contract' ? 'selected' : '' }}>Contract</option>
                                <option value="Freelance" {{ $job->type == 'Freelance' ? 'selected' : '' }}>Freelance</option>
                                <option value="Temporary" {{ $job->type == 'Temporary' ? 'selected' : '' }}>Temporary</option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-2">
                            <label for="jobType">Job Type</label>
                            <select name="job_type" id="jobType" class="form-select" required>
                                <option value="">Select One</option>
                                <option value="Remote" {{ $job->job_type == 'Remote' ? 'selected' : '' }}>Remote</option>
                                <option value="On-site" {{ $job->job_type == 'On-site' ? 'selected' : '' }}>On-Site</option>
                                <option value="High-breed" {{ $job->job_type == 'High-breed' ? 'selected' : '' }}>High-breed</option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-2">
                            <label for="experienceLevel">Experience Level</label>
                            <select name="experience_level" id="experienceLevel" class="form-select" required>
                                <option value="">Select One</option>
                                <option value="Entry" {{ $job->experience_level == 'Entry' ? 'selected' : '' }}>Entry Level</option>
                                <option value="Intermediate" {{ $job->experience_level == 'Intermediate' ? 'selected' : '' }}>Intermediate Level</option>
                                <option value="Expert" {{ $job->experience_level == 'Expert' ? 'selected' : '' }}>Expert Level</option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-2">
                            <label for="location">Location</label>
                            <input type="text" class="form-control" name="location" id="location" value="{{ $job->location }}">
                        </div>

                    </div>

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
                                <option value="No Education" {{ $job->education_level == 'No Education' ? 'selected' : '' }}>No Education</option>
                                <option value="Certificate" {{ $job->education_level == 'Certificate' ? 'selected' : '' }}>Certificate</option>
                                <option value="Diploma" {{ $job->education_level == 'Diploma' ? 'selected' : '' }}>Diploma</option>
                                <option value="Degree" {{ $job->education_level == 'Degree' ? 'selected' : '' }}>Degree</option>
                                <option value="Masters" {{ $job->education_level == 'Masters' ? 'selected' : '' }}>Masters</option>
                                <option value="Doctorate" {{ $job->education_level == 'Doctorate' ? 'selected' : '' }}>Doctorate</option>
                            </select>
                        </div>

                        <div class="col-md-6 form-group">
                            <label for="skills">Skills</label>

                            <div class="form-group">
                                <select name="skills" id="skills" class="form-control" multiple style="width:100%;">
                                    @foreach ($skills as $skill)
                                        <option value="{{ $skill->id }}">{{ $skill->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6 form-group">
                            <label for="lastName">Salary range</label>
                            <input type="text" class="form-control" name="salary_range" id="salaryRange" value="{{ $job->salary_range }}">
                        </div>

                        <div class="col-md-6 form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" name="title" id="title" value="{{ $job->title }}">
                        </div>

                        <div class="col-md-6 form-group">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" class="form-control">{{ $job->description }}</textarea>
                        </div>

                        <div class="col-md-6 form-group">
                            <label for="noOfPositions">No of positions</label>
                            <input type="number" name="no_of_positions" id="noOfPositions" class="form-control" value="{{ $job->no_of_positions }}">
                        </div>

                        <div class="col-md-6 form-group">
                            <label for="startDate">Application deadline</label>
                            <input type="date" name="applicationEndDate" id="applicationEndDate" class="form-control"
                                min="{{ date('Y-m-d') }}" required value="{{ $job->applicationEndDate }}">
                        </div>

                        <div class="col-md-6 form-group">
                            <label for="startDate">Job Start Date</label>
                            <input type="date" name="start_date" id="startDate" class="form-control"
                                min="{{ date('Y-m-d') }}" required value="{{ $job->start_date }}">
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
                                    @foreach (json_decode($job->qualifications) as $qualification)
                                        <tr>
                                            <td>{{ $qualification }}</td>
                                            <td>
                                                <button type="button" class="btn btn-danger btn-sm" id="deleteQualificationToggle"><i class="bi bi-trash"></i></button>
                                            </td>
                                        </tr>
                                    @endforeach
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
                                    @foreach (json_decode($job->requirements) as $requirement)
                                        <tr>
                                            <td>{{ $requirement }}</td>
                                            <td>
                                                <button type="button" class="btn btn-danger btn-sm" id="deleteRequirementToggle"><i class="bi bi-trash"></i></button>
                                            </td>
                                        </tr>
                                    @endforeach
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

    </main>
@endsection

@section('footer_scripts')
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/select2.min.js') }}"></script>
    <script src="{{ asset('js/functions.js') }}"></script>
    <script src="{{ asset('js/jobs/edit.js') }}"></script>
@endsection
