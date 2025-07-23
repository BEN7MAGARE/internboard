@extends('layouts.main')

@section('title')
    Jobs @parent
@endsection

@section('header_styles')
    <style>
        .job-card {
            transition: all 0.3s ease;
            border-left: 4px solid var(--bs-primary);
            margin-bottom: 1.5rem;
        }

        .job-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .company-logo {
            max-height: 80px;
            max-width: 100%;
            object-fit: contain;
        }

        .company-name {
            font-weight: 400;
            color: var(--bs-dark);
        }

        .skill-badge {
            background-color: #e9ecef;
            color: #495057;
            margin-right: 8px;
            margin-bottom: 8px;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.85rem;
            display: inline-block;
        }

        .salary-badge {
            background-color: #d4edda;
            color: #155724;
            font-weight: 400;
        }

        .deadline-badge {
            background-color: #fff3cd;
            color: #856404;
        }

        .filter-card {
            position: sticky;
            top: 20px;
        }

        .job-description {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .empty-state {
            padding: 3rem;
            text-align: center;
            color: #6c757d;
        }

        .empty-state i {
            font-size: 3rem;
            margin-bottom: 1rem;
            color: #dee2e6;
        }

        .breadcrumb {
            background-color: transparent;
            padding: 0;
        }

        .breadcrumb-item.active {
            color: var(--bs-primary);
        }
    </style>
@endsection

@section('content')

    <main id="main">
        <section class="main-content">
            <div class="page-title mt-2" data-aos="fade">
                <nav class="breadcrumbs">
                    <div class="container-fluid">
                        <h4 class="display-7 mb-0 text-danger">Find Your Next Opportunity</h1>
                    </div>
                </nav>
            </div>

            <div class="job-section">
                <div class="container-fluid mt-2 mb-2">
                    <div class="row">
                        <div class="col-md-9">
                            <div class="card p-2 mb-2">
                                <form action="{{ route('jobs.search') }}" method="post" id="jobsSearchForm">

                                    <div class="row">
                                        @csrf
                                        <div class="col-md-3 mb-2">
                                            <select name="category_id" id="searchCategoryID" class="form-select">

                                            </select>
                                        </div>

                                        <div class="col-md-3 mb-2">
                                            <select name="type" id="searchEmploymentType" class="form-select">
                                                <option value="">Employment Type</option>
                                                <option value="Internship">Internship</option>
                                                <option value="Part-time">Part Time</option>
                                                <option value="Full Time">Full Time</option>
                                                <option value="Contract">Contract</option>
                                                <option value="Freelance">Freelance</option>
                                                <option value="Temporary">Temporary</option>
                                            </select>
                                        </div>

                                        <div class="col-md-3 mb-2">
                                            <select name="job_type" id="searchJobType" class="form-select">
                                                <option value="">Job Type</option>
                                                <option value="Remote">Remote</option>
                                                <option value="On-site">On-Site</option>
                                                <option value="High-breed">High-breed</option>
                                            </select>
                                        </div>

                                        <div class="col-md-2 mb-2">
                                            <input type="text" class="form-control" name="searchLocation"
                                                id="searchLocation" placeholder="Location">
                                        </div>

                                        <div class="col-md-1 mb-1">
                                            <button type="submit" class="btn btn-danger"><i
                                                    class="bi bi-search text-white"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div>
                                {{-- @if (count($jobs) <= 0)
                                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                        You may need to update your profile to see jobs
                                        that match your skill set <a href="{{ route('profile.edit') }}"
                                            class="btn btn-primary btn-sm">Update your Profile </a>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @else --}}
                                    <div id="jobrendersection">

                                        @foreach ($jobs as $item)
                                            @php
                                                $skilltext = '';
                                                foreach ($item->skills as $key => $skill) {
                                                    $skilltext .= "<span>$skill->name</span>";
                                                }
                                            @endphp
                                            <a href="{{ route('jobs.show', $item->ref_no) }}">
                                            <div class="job card bg-white rounded p-3 job-card"
                                                data-id="{{ $item->id }}" data-ref_no="{{ $item->ref_no }}">

                                                <div class="title">
                                                    <h6>{{ $item->title }}</h6>
                                                </div>

                                                <div class="d-flex gap-2">

                                                    <div class="text-center d-none d-md-block">
                                                        @if ($item->corporate->logo !== null)
                                                            <img src="{{ asset('corporate_logos/' . $item->corporate->logo) }}"
                                                                alt="{{ $item->corporate->name }}"
                                                                class="img-fluid company-logo">
                                                            <p class="company-name"><i>{{ $item->corporate->name }}</i></p>
                                                        @else
                                                            <p class="company-name"><i>{{ $item->corporate->name }}</i></p>
                                                        @endif
                                                        <div class="mt-2">
                                                            <a href="{{ url('jobs/' . $item->ref_no . '/apply') }}" class="btn btn-primary btn-sm">Apply Now</a>
                                                        </div>
                                                    </div>

                                                    <div class="">
                                                        
                                                        <div class="d-flex flex-wrap gap-2">
                                                            <span class="salary-badge p-1 rounded">Level:
                                                                {{ $item->experience_level }}</span>
                                                            <span class="salary-badge p-1 rounded">Salary:
                                                                {{ $item->salary_range }}</span>
                                                            <span class="salary-badge p-1 rounded">Work Type:
                                                                {{ $item->job_type }}</span>
                                                            <span class="salary-badge p-1 rounded">Positions:
                                                                {{ $item->no_of_positions }}</span>
                                                        </div>

                                                        <div class="desciption p-2">
                                                            @php
                                                                $description = $item->description;
                                                            @endphp
                                                            @if (strlen($description) > 150)
                                                                <p>{{ substr($description, 0, 150) . ' . . . .' }}</p>
                                                            @else
                                                                <p>{{ $description }}</p>
                                                            @endif
                                                        </div>

                                                        <div class="skills ml-2">{!! $skilltext !!}</div>

                                                        <div class="location d-flex justify-content-between p-2">

                                                            <div>
                                                                <small>
                                                                    <i class="bi bi-geo-alt-fill text-danger"></i>&nbsp;<span>{{ $item->location }}</span>
                                                                </small>
                                                            </div>

                                                            <div>
                                                                <small>Application Deadline:
                                                                    {!! $item->application_end_date !== null
                                                                        ? "<span class='text-danger'>" . date('j M Y', strtotime($item->application_end_date)) . '</span>'
                                                                        : "<span class='text-danger'>Not specified</span>" !!}</small>
                                                            </div>

                                                        </div>

                                                    </div>
                                                </div>

                                            </div>
                                            </a>
                                        @endforeach

                                    </div>

                                    <section id="job-pagination" class="job-pagination section mt-3 bg-white p-2">
                                        <div class="container">
                                            <div class="d-flex justify-content-center" id="jobPagination">
                                                <ul>
                                                    {!! $jobs->links() !!}
                                                </ul>
                                            </div>
                                        </div>
                                    </section>
                                {{-- @endif --}}

                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card mt-1">
                                <div class="card-header bg-white">
                                    <h5>Filter Options</h5>
                                </div>
                                <div class="card-body">
                                    <p>Experience</p>
                                    <div class="form-check d-flex align-items-center">
                                        <input class="form-check-input me-2" type="checkbox" id="experienceCheckEntry"
                                            name="experienceLevel" value="Entry">&nbsp;
                                        <label class="form-check-label" for="experienceCheckEntry">Entry Level</label>
                                    </div>

                                    <div class="form-check d-flex align-items-center">
                                        <input class="form-check-input me-2" type="checkbox"
                                            id="experienceCheckIntermediate" name="experienceLevel"
                                            value="Intermediate">&nbsp;
                                        <label class="form-check-label" for="experienceCheckIntermediate">Intermediate
                                            Level</label>
                                    </div>

                                    <div class="form-check d-flex align-items-center">
                                        <input class="form-check-input me-2" type="checkbox" id="experienceCheckExpert"
                                            name="experienceLevel" value="Expert">&nbsp;
                                        <label class="form-check-label" for="experienceCheckExpert">Expert Level</label>
                                    </div>
                                    <hr>

                                    <p>Education</p>
                                    <div class="form-check d-flex align-items-center">
                                        <input class="form-check-input me-2 mb-0" type="checkbox"
                                            id="educationLevelCertificate" name="educationLevel" value="Expert">&nbsp;
                                        <label class="form-check-label"
                                            for="educationLevelCertificate">Certificate</label>
                                    </div>
                                    <div class="form-check d-flex align-items-center">
                                        <input class="form-check-input me-2 mb-0" type="checkbox"
                                            id="educationLevelDiploma" name="educationLevel" value="Expert">&nbsp;
                                        <label class="form-check-label" for="educationLevelDiploma">Diploma</label>
                                    </div>
                                    <div class="form-check d-flex align-items-center">
                                        <input class="form-check-input me-2 mb-0" type="checkbox"
                                            id="educationLevelDegree" name="educationLevel" value="Expert">&nbsp;
                                        <label class="form-check-label" for="educationLevelDegree">Degree</label>
                                    </div>
                                    <div class="form-check d-flex align-items-center">
                                        <input class="form-check-input me-2 mb-0" type="checkbox"
                                            id="educationLevelMasters" name="educationLevel" value="Expert">&nbsp;
                                        <label class="form-check-label" for="educationLevelMasters">Masters</label>
                                    </div>
                                    <div class="form-check d-flex align-items-center">
                                        <input class="form-check-input me-2 mb-0" type="checkbox"
                                            id="educationLevelDoctorate" name="educationLevel" value="Expert">&nbsp;
                                        <label class="form-check-label" for="educationLevelDoctorate">Doctorate</label>
                                    </div>
                                    <hr>
                                    <p>Sort by Location</p>
                                    <div id="jobLocations"></div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
        </section>

        <div class="modal fade" id="jobDetailsModalToggle" aria-hidden="true"
            aria-labelledby="jobDetailsModalToggleLabel" tabindex="-1">
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
    </main>
@endsection

@section('footer_scripts')
    <script src="{{ asset('js/moment.min.js') }}"></script>
    <script src="{{ asset('js/functions.js') }}"></script>
    <script src="{{ asset('js/job.js') }}"></script>
@endsection
