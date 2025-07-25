@extends('layouts.dashboard')

@section('title')
    Jobs @parent
@endsection

@section('subtitle')
    My Jobs
@endsection

@section('header_styles')
    <style>
        .job-card {
            transition: all 0.3s ease;
            border-left: 4px solid #0d6efd;
        }

        .job-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
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
            font-weight: 500;
        }

        .deadline-badge {
            background-color: #fff3cd;
            color: #856404;
        }

        .applicants-btn {
            background-color: #f8f9fa;
            color: #212529;
            border: 1px solid #dee2e6;
        }

        .applicants-btn:hover {
            background-color: #e9ecef;
        }

        .job-description {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
        }
    </style>
@endsection

@section('content')
    <main class="container py-4">

        <div class="alert alert-info alert-dismissible fade show" role="alert">
            <i class="bi bi-info-circle-fill"></i>&nbsp;<strong>Note:</strong> You can post your jobs here for advertisement
            on our platform and get most qualied and talented applicants.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>

        <div class="d-flex justify-content-between align-items-center mb-2">
            <a href="{{ route('jobs.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i>Post New Job
            </a>
        </div>

        <div class="row g-2">
            @foreach ($jobs as $item)
                <div class="col-12">
                    <div class="job-card card mb-2 h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <h3 class="h5 card-title fw-bold mb-1">{{ $item->title }}</h3>
                                    <span class="badge salary-badge mb-2">Monthly: {{ $item->salary_range }}</span>
                                </div>
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-danger dropdown-toggle" type="button"
                                        id="jobActionsDropdown{{ $item->id }}" data-bs-toggle="dropdown"
                                        aria-expanded="false">Action <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="jobActionsDropdown{{ $item->id }}">
                                        <li><a class="dropdown-item" href="{{ route('jobs.edit', $item->ref_no) }}"><i
                                                    class="bi bi-pencil-square me-2"></i>Edit</a>
                                        </li>

                                        <li><a class="dropdown-item text-info"
                                                href="{{ route('job.applications', $item->ref_no) }}"><i
                                                    class="bi bi-people me-2"></i>View Applicants</a></li>
                                        <li><a class="dropdown-item text-success"
                                                href="{{ route('applications.selected', $item->ref_no) }}">
                                                <i class="bi bi-check-circle me-2"></i>View Selected Applicants</a></li>

                                        <li><a class="dropdown-item text-danger"
                                                href="{{ route('jobs.destroy', $item->id) }}"
                                                data-jobid="{{ $item->id }}" id="deleteJobToggle"><i
                                                    class="bi bi-trash me-2"></i>Delete</a></li>
                                    </ul>
                                </div>
                            </div>

                            <div class="mb-1">
                                <p class="card-text job-description">{{ $item->description }}</p>

                                <a href="#" class="text-primary" data-bs-toggle="modal"
                                    data-bs-target="#jobDescriptionModal{{ $item->id }}">Read more</a>
                            </div>

                            <div class="mb-1">
                                @foreach ($item->skills as $skill)
                                    <span class="skill-badge">{{ $skill->name }}</span>
                                @endforeach
                            </div>

                            <div class="d-flex justify-content-between align-items-center">
                                <a href="{{ route('job.applications', $item->ref_no) }}"
                                    class="btn applicants-btn rounded-pill">
                                    <i class="fas fa-users me-2"></i>
                                    {{ $item->applications_count }}
                                    Applicant{{ $item->applications_count != 1 ? 's' : '' }}
                                </a>

                                <div class="text-end">
                                    @if ($item->application_end_date !== null)
                                        <span class="badge deadline-badge">
                                            <i class="fas fa-clock me-1"></i>
                                            Deadline: {{ date('j M Y', strtotime($item->application_end_date)) }}
                                        </span>
                                    @else
                                        <span class="badge deadline-badge">
                                            <i class="fas fa-clock me-1"></i>
                                            No deadline specified
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Job Description Modal -->
                <div class="modal fade" id="jobDescriptionModal{{ $item->id }}" tabindex="-1"
                    aria-labelledby="jobDescriptionModalLabel{{ $item->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="jobDescriptionModalLabel{{ $item->id }}">
                                    {{ $item->title }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>

                            <div class="modal-body">

                                <div class="d-flex flex-wrap gap-2 justify-content-between">

                                    <div class="mb-1">
                                        <h6>Salary Range</h6>
                                        <p class="fw-bold">{{ $item->salary_range }} per month</p>
                                    </div>

                                    <div class="mb-1">
                                        <h6>Job Description</h6>
                                        <p class="fw-bold">{{ $item->description }}</p>
                                    </div>

                                    <div class="mb-1">
                                        <h6>Job Type</h6>
                                        <p class="fw-bold">{{ $item->job_type }}</p>
                                    </div>

                                    <div class="mb-1">
                                        <h6>Experience Level</h6>
                                        <p class="fw-bold">{{ $item->experience_level }}</p>
                                    </div>

                                    <div class="mb-1">
                                        <h6>Location</h6>
                                        <p class="fw-bold">{{ $item->location }}</p>
                                    </div>

                                    <div class="mb-1">
                                        <h6>Education Level</h6>
                                        <p class="fw-bold">{{ $item->education_level }}</p>
                                    </div>

                                    <div class="mb-1">
                                        <h6>Application Deadline</h6>
                                        <p class="fw-bold">{{ date('j M Y', strtotime($item->application_end_date)) }}</p>
                                    </div>

                                    <div class="mb-1">
                                        <h6>Start Date</h6>
                                        <p class="fw-bold">{{ date('j M Y', strtotime($item->start_date)) }}</p>
                                    </div>
                                </div>

                                <div>
                                    <h6 class="fw-bold">Required Skills</h6>
                                    <div>
                                        @foreach ($item->skills as $skill)
                                            <span class="badge bg-primary me-1">{{ $skill->name }}</span>
                                        @endforeach
                                    </div>
                                </div>

                                @php
                                    $requirements = json_decode($item->requirements);
                                    $qualifications = json_decode($item->qualifications);
                                @endphp

                                <div class="mb-2">
                                    <h6 class="fw-bold">Requirements</h6>
                                    @if ($requirements)
                                        <ul>
                                            @foreach ($requirements as $requirement)
                                                <li>{{ $requirement }}</li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <p>No requirements specified</p>
                                    @endif
                                </div>

                                <div class="mb-2">
                                    <h6 class="fw-bold">Qualifications</h6>
                                    @if ($qualifications)
                                        <ul>
                                            @foreach ($qualifications as $qualification)
                                                <li>{{ $qualification }}</li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <p>No qualifications specified</p>
                                    @endif
                                </div>

                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <a href="{{ route('job.applications', $item->ref_no) }}" class="btn btn-primary">
                                    View Applicants
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="row mt-4">
            <div class="col-12">
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center">
                        {!! $jobs->links() !!}
                    </ul>
                </nav>
            </div>
        </div>
    </main>
@endsection

@section('footer_scripts')
    <script src="{{ asset('js/sweetalert.js') }}"></script>
    <script>
        // Initialize Bootstrap tooltips
        document.addEventListener('DOMContentLoaded', function() {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            });

            document.addEventListener('click', async function(e) {
                const deleteJobToggle = e.target.getAttribute('id');
                if (deleteJobToggle == "deleteJobToggle") {
                    e.preventDefault();
                    var jobid = e.target.dataset.jobid;
                    new swal({
                            title: 'Are you sure?',
                            text: 'You want to delete this job?',
                            icon: 'warning',
                            buttons: true,
                            dangerMode: true,
                        })
                        .then(async (willDelete) => {
                            if (willDelete) {
                                const response = await fetch('employer-jobs-destroy/' + jobid);
                                if (response.ok) {
                                    new swal({
                                        title: 'Success',
                                        text: 'Job deleted successfully',
                                        icon: 'success',
                                        buttons: true,
                                    })
                                    window.setTimeout(function() {
                                        window.location.reload();
                                    }, 3000);
                                } else {
                                    new swal({
                                        title: 'Error',
                                        text: 'Failed to delete job',
                                        icon: 'error',
                                        buttons: true,
                                    })
                                }
                            }
                        });
                }
            })
        });
    </script>
@endsection
