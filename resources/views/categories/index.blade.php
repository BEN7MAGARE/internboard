@extends('layouts.dashboard')

@section('title')
    Categories @parent
@endsection

@section('header_styles')
    <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
@endsection

@section('subtitle')
    Categories
@endsection

@section('content')
    <main class="mt-2 p-2">
        <div class="card">

            <div class="card-header">
                <ul class="nav nav-tabs nav-tabs-bordered d-flex" id="borderedTabJustified" role="tablist">

                    <li class="nav-item flex-fill" role="presentation">
                        <button class="nav-link w-100 active" id="categories-tab" data-bs-toggle="tab"
                            data-bs-target="#categoriesTab" type="button" role="tab" aria-controls="categories"
                            aria-selected="true">Categories</button>
                    </li>

                    <li class="nav-item flex-fill" role="presentation">
                        <button class="nav-link w-100" id="subcategories-tab" data-bs-toggle="tab"
                            data-bs-target="#subcategoriesTab" type="button" role="tab" aria-controls="subcategories"
                            aria-selected="false">Sub-Categories</button>
                    </li>

                    <li class="nav-item flex-fill" role="presentation">
                        <button class="nav-link w-100" id="jobs-tab" data-bs-toggle="tab" data-bs-target="#jobsTab"
                            type="button" role="tab" aria-controls="jobs" aria-selected="true">Jobs</button>
                    </li>
                </ul>
            </div>

            <div class="card-body tab-content p-2">

                <div class="tab-pane fade show active" id="categoriesTab" role="tabpanel" aria-labelledby="categories-tab">

                    <div class="d-flex justify-content-end gap-2 p-2">
                        <a href="#" class="btn btn-primary" id="createCategoryToggle" data-bs-toggle="modal"
                            data-bs-target="#createCategoryModal"><i class="bi bi-plus"></i> Add Category</a>

                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Actions
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <li><a class="dropdown-item text-danger" href="#" id="deleteCategory"><i
                                            class="bi bi-trash"></i>&nbsp;Delete</a></li>
                                <li><a class="dropdown-item text-info" href="#" id="exportCategory"><i
                                            class="bi bi-file-earmark-excel"></i>&nbsp;Export</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="table-container">
                        <table class="table table-striped table-hover table-bordered table-sm scrollableTable">
                            <thead>
                                <tr>
                                    <th scope="col"><input type="checkbox" name="category_id[]" value=""
                                            id="allCategorySelect"></th>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Slug</th>
                                    <th scope="col">Jobs</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($categories as $category)
                                    <tr>
                                        <td><input type="checkbox" name="category_id[]" value="{{ $category->id }}"></td>
                                        <td>{{ $loop->iteration }}</th>
                                        <td>{{ $category->name }}</td>
                                        <td>{{ $category->slug }}</td>
                                        <td>{{ $category->jobs_count }}</td>
                                        <td>{{ $category->description }}</td>
                                        <td>
                                            <button type="button" class="btn btn-warning btn-sm" id="editCategoryToggle"
                                                data-bs-toggle="modal" data-bs-target="#createCategoryModal"
                                                data-id="{{ $category->id }}"><i class="bi bi-pencil-square"></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="pagination text-end">
                        {{ $categories->links() }}
                    </div>
                </div>

                <div class="tab-pane fade" id="subcategoriesTab" role="tabpanel" aria-labelledby="subcategories-tab">

                    <div class="d-flex justify-content-end gap-2 p-2">
                        <a href="#" class="btn btn-primary" id="createSubcategoryToggle" data-bs-toggle="modal"
                            data-bs-target="#createSubcategoryModal"><i class="bi bi-plus"></i> Add Sub-Category</a>

                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Actions
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">

                                <li><a class="dropdown-item text-danger" href="#" id="deleteSubcategory"><i
                                            class="bi bi-trash"></i>&nbsp;Delete</a></li>
                                <li><a class="dropdown-item text-info" href="#" id="exportSubcategory"><i
                                            class="bi bi-file-earmark-excel"></i>&nbsp;Export</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="table-container">
                        <table class="table table-striped table-hover table-bordered table-sm scrollableTable">
                            <thead>
                                <tr>
                                    <th scope="col"><input type="checkbox" name="subcategory_id[]" value=""
                                            id="allSubcategorySelect">
                                    </th>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Slug</th>
                                    <th scope="col">Jobs</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($subcategories as $subcategory)
                                    <tr>
                                        <th><input type="checkbox" name="subcategory_id[]"
                                                value="{{ $subcategory->id }}">
                                        </th>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $subcategory->name }}</td>
                                        <td>{{ $subcategory->slug }}</td>
                                        <td>{{ $subcategory->jobs_count }}</td>
                                        <td>{{ $subcategory->category->name }}</td>
                                        <td>{{ $subcategory->description }}</td>
                                        <td>
                                            <button type="button" class="btn btn-warning btn-sm"
                                                id="editSubcategoryToggle" data-bs-toggle="modal"
                                                data-bs-target="#createSubcategoryModal"
                                                data-id="{{ $subcategory->id }}"><i
                                                    class="bi bi-pencil-square"></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="pagination text-end">
                        {{ $subcategories->links() }}
                    </div>
                </div>

                <div class="tab-pane fade" id="jobsTab" role="tabpanel" aria-labelledby="jobs-tab">
                    <div class="d-flex justify-content-end gap-2 p-2">
                        <a href="#" class="btn btn-primary" id="createJobToggle" data-bs-toggle="modal"
                            data-bs-target="#createJobModal"><i class="bi bi-plus"></i> Add Job</a>

                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Actions
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">

                                <li><a class="dropdown-item text-success" href="#" id="approveJob"><i
                                            class="bi bi-check-circle"></i>&nbsp;Approve</a></li>
                                <li><a class="dropdown-item text-info" href="#" id="exportJob"><i
                                            class="bi bi-file-earmark-excel"></i>&nbsp;Export</a></li>
                                <li><a class="dropdown-item text-danger" href="#" id="deleteJob"><i
                                            class="bi bi-trash"></i>&nbsp;Delete</a></li>
                            </ul>
                        </div>
                    </div>
                    <form action="{{ route('jobs.json.search') }}" method="post" id="searchJobForm">
                        @csrf
                        <div class="row alert alert-primary">

                            <div class="col-md-2 mb-1">
                                <select name="corporate_id" class="form-select form-select-sm" id="searchEmployerID">

                                </select>
                            </div>

                            <div class="col-md-2 mb-1">
                                <select name="category_id" class="form-select form-select-sm" id="searchJobCategoryID">

                                </select>
                            </div>

                            <div class="col-md-2 mb-1">
                                <select name="type" id="searchEmploymentType" class="form-select form-select-sm">
                                    <option value="">Job Type</option>
                                    <option value="Internship">Internship</option>
                                    <option value="Part-time">Part Time</option>
                                    <option value="Full Time">Full Time</option>
                                    <option value="Contract">Contract</option>
                                    <option value="Freelance">Freelance</option>
                                    <option value="Temporary">Temporary</option>
                                </select>
                            </div>

                            <div class="col-md-2 mb-1">
                                <select name="job_type" id="searchJobType" class="form-select form-select-sm">
                                    <option value="">Work Type</option>
                                    <option value="Remote">Remote</option>
                                    <option value="On-site">On-Site</option>
                                    <option value="High-breed">High-breed</option>
                                </select>
                            </div>

                            <div class="col-md-2 mb-1">
                                <select name="experience_level" id="searchEexperienceLevel"
                                    class="form-select form-select-sm">
                                    <option value="">Experience Level</option>
                                    <option value="Entry">Entry Level</option>
                                    <option value="Intermediate">Intermediate Level</option>
                                    <option value="Expert">Expert Level</option>
                                </select>
                            </div>

                            <div class="col-md-1 mb-1">
                                <select name="education_level" id="searchEducationLevel"
                                    class="form-select form-select-sm">
                                    <option value="">Education Level</option>
                                    <option value="Certificate">Certificate</option>
                                    <option value="Diploma">Diploma</option>
                                    <option value="Degree">Degree</option>
                                    <option value="Masters">Masters</option>
                                    <option value="Doctorate">Doctorate</option>
                                </select>
                            </div>

                            <div class="col-md-1">
                                <button type="submit" class="btn btn-primary"><i class="bi bi-search"></i></button>
                            </div>

                        </div>
                    </form>
                    <div class="table-container">
                        <div id="jobActionsFeedback"></div>
                        <table class="table table-striped table-hover table-bordered table-sm scrollableTable">

                            <thead>
                                <tr>
                                    <th scope="col"><input type="checkbox" value="" id="allJobSelect"></th>
                                    <th scope="col">#</th>
                                    <th scope="col">Ref</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">Work</th>
                                    <th scope="col">Experience</th>
                                    <th scope="col">Location</th>
                                    <th scope="col">Education</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">App.Deadline</th>
                                    <th scope="col">StartDate</th>
                                    <th scope="col">Salary</th>
                                    <th scope="col">Positions</th>
                                    <th scope="col">Approved</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>

                            <tbody id="jobList">
                                @foreach ($jobs as $job)
                                    <tr>
                                        <th><input type="checkbox" name="job_id[]" value="{{ $job->id }}"
                                                id="jobSelect">
                                        </th>
                                        <th scope="row">{{ $job->id }}</th>
                                        <td>{{ $job->ref_no }}</td>
                                        <td>{{ $job->type }}</td>
                                        <td>{{ $job->job_type }}</td>
                                        <td>{{ $job->experience_level }}</td>
                                        <td>{{ $job->location }}</td>
                                        <td>{{ $job->education_level }}</td>
                                        <td>{{ $job->title }}</td>
                                        <td>{{ $job->application_end_date }}</td>
                                        <td>{{ $job->start_date }}</td>
                                        <td>{{ $job->salary_range }}</td>
                                        <td>{{ $job->no_of_positions }}</td>
                                        <td>{{ $job->approved ? 'Yes' : 'No' }}</td>
                                        <td>
                                            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                                id="editJobToggle" data-bs-target="#createJobModal"
                                                data-id="{{ $job->id }}"><i
                                                    class="bi bi-pencil-square"></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>

                    <div class="pagination text-end" id="jobPagination">
                        {{ $jobs->links() }}
                    </div>
                </div>
            </div>
        </div>
    </main>
    <div class="modal fade" id="createCategoryModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="createCategoryModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="createCategoryModalLabel">Create Category</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('categories.store') }}" method="POST" id="createCategoryForm">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="id" id="categoryID" value="">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" id="categoryName" required>
                        </div>

                        {{-- <div class="mb-3">
                        <label for="slug" class="form-label">Slug</label>
                        <input type="text" class="form-control" id="slug" name="slug" required>
                    </div>
                     --}}
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" name="description" id="categoryDescription"></textarea>
                        </div>

                    </div>
                    <div id="categoryFeedback"></div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="createSubcategoryModal" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="createSubcategoryModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="createSubcategoryModalLabel">Create Sub-Category</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('subcategories.store') }}" method="POST" id="createSubcategoryForm">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="id" id="subcategoryID" value="">
                        <div class="mb-3">
                            <label for="category_id" class="form-label">Category</label>
                            <select name="category_id" class="form-select" id="categoryIDOptions" required>

                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" id="subcategoryName" required>
                        </div>

                        {{-- <div class="mb-3">
                        <label for="slug" class="form-label">Slug</label>
                        <input type="text" class="form-control" id="slug" name="slug" required>
                    </div>
                     --}}
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" name="description" id="subcategoryDescription"></textarea>
                        </div>
                    </div>
                    <div id="subcategoryFeedback"></div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="createJobModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="createJobModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="ccreateJobModalLabel">Create Job</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('jobs.store') }}" method="POST" id="createJobForm">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="id" id="jobID" value="">
                        <div class="row">

                            <div class="col-md-6 mb-2">
                                <label for="jobEmployerID" class="form-label">Employer/Corporate</label>
                                <select name="corporate_id" class="form-select form-select-sm" id="jobEmployerID"
                                    required>

                                </select>
                            </div>

                            <div class="col-md-6 mb-2">
                                <label for="jobCategoryID" class="form-label">Category/Industry</label>
                                <select name="category_id" class="form-select form-select-sm" id="jobCategoryID"
                                    required>

                                </select>
                            </div>

                            <div class="col-md-6 mb-2">
                                <label for="jobSubCategoryID" class="form-label">Sub-Category</label>
                                <select name="subcategory_id" class="form-select form-select-sm" id="jobSubCategoryID">

                                </select>
                            </div>

                            <div class="col-md-6 mb-2">
                                <label for="employmentType">Employment Type</label>
                                <select name="type" id="employmentType" class="form-select form-select-sm">
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
                                <select name="job_type" id="jobType" class="form-select form-select-sm">
                                    <option value="">Select One</option>
                                    <option value="Remote">Remote</option>
                                    <option value="On-site">On-Site</option>
                                    <option value="High-breed">High-breed</option>
                                </select>
                            </div>

                            <div class="col-md-6 mb-2">
                                <label for="experienceLevel">Experience Level</label>
                                <select name="experience_level" id="experienceLevel" class="form-select form-select-sm">
                                    <option value="">Select One</option>
                                    <option value="Entry">Entry Level</option>
                                    <option value="Intermediate">Intermediate Level</option>
                                    <option value="Expert">Expert Level</option>
                                </select>
                            </div>

                            <div class="col-md-6 mb-2">
                                <label for="location">Location</label>
                                <input type="text" class="form-control form-control-sm" name="location"
                                    id="location">
                            </div>

                            <div class="col-md-6 mb-2">
                                <label for="educationLevel">Education Level</label>
                                <select name="education_level" id="educationLevel" class="form-select form-select-sm">
                                    <option value="">Select One</option>
                                    <option value="Certificate">Certificate</option>
                                    <option value="Diploma">Diploma</option>
                                    <option value="Degree">Degree</option>
                                    <option value="Masters">Masters</option>
                                    <option value="Doctorate">Doctorate</option>
                                </select>
                            </div>

                            <div class="col-md-6 mb-2">
                                <label for="skills">Skills</label>

                                <div class="form-group" id="skillsOptions">
                                    <select name="skills" id="skills" class="form-control" multiple
                                        style="width:100%;" data-control="select2" data-dropdown-parent="#skillsOptions">

                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6 mb-2">
                                <label for="lastName">Salary range</label>
                                <input type="text" class="form-control" name="salary_range" id="salaryRange">
                            </div>

                            <div class="col-md-6 mb-2">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" name="title" id="title">
                            </div>

                            <div class="col-md-6 mb-2">
                                <label for="description">Description</label>
                                <textarea name="description" id="description" class="form-control"></textarea>
                            </div>

                            <div class="col-md-6 mb-2">
                                <label for="noOfPositions">No of positions</label>
                                <input type="number" name="no_of_positions" id="noOfPositions" class="form-control">
                            </div>

                            <div class="col-md-6 mb-2">
                                <label for="startDate">Application deadline</label>
                                <input type="date" name="applicationEndDate" id="applicationEndDate"
                                    class="form-control" min="{{ date('Y-m-d') }}" required>
                            </div>

                            <div class="col-md-6 mb-2">
                                <label for="startDate">Job Start Date</label>
                                <input type="date" name="start_date" id="startDate" class="form-control"
                                    min="{{ date('Y-m-d') }}" required>
                            </div>
                        </div>
                    </div>
                    <div id="jobFeedback"></div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('footer_scripts')
    <script src="{{ asset('js/select2.min.js') }}"></script>
    <script src="{{ asset('js/functions.js') }}"></script>
    <script src="{{ asset('js/jobs/category.js') }}"></script>
    <script src="{{ asset('js/jobs/create.js') }}"></script>
@endsection
