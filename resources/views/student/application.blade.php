@extends('layouts.dashboard')

@section('title')
    My Job Applications @parent
@endsection

@section('header_styles')
    <style>
        .application-card {
            border-left: 4px solid;
            transition: all 0.3s ease;
        }
        .application-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        .application-card.pending {
            border-left-color: #ffc107;
        }
        .application-card.rejected {
            border-left-color: #dc3545;
        }
        .application-card.hired {
            border-left-color: #28a745;
        }
        .accordion-button {
            font-weight: 500;
        }
        .accordion-button:not(.collapsed) {
            color: #2c3e50;
            background-color: #f8f9fa;
            box-shadow: none;
        }
        .job-company {
            color: #3490dc;
            font-weight: 600;
        }
        .application-meta {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
            margin-bottom: 0.5rem;
        }
        .application-meta-item {
            display: flex;
            align-items: center;
            gap: 0.3rem;
            font-size: 0.9rem;
        }
        .application-content {
            padding: 1rem 0;
            border-top: 1px solid #eee;
            margin-top: 1rem;
        }
        .empty-state {
            text-align: center;
            padding: 3rem;
            background: #f8fafc;
            border-radius: 0.5rem;
        }
        .empty-state-icon {
            font-size: 3rem;
            color: #b8c2cc;
            margin-bottom: 1rem;
        }
    </style>
@endsection

@section('subtitle')
    My Applications
@endsection

@section('content')
    <main class="container py-4">

        <div class="text-end mb-4">
            <a href="{{ route('jobs.index') }}" class="btn btn-primary">
                <i class="fas fa-search mr-1"></i> Browse Jobs
            </a>
        </div>

        @if ($applications->isNotEmpty())
            <div class="accordion" id="applicationsAccordion">
                @foreach ($applications as $application)
                    @php
                        $statusClass = match ($application->status) {
                            'pending' => 'warning',
                            'selected' => 'primary',
                            'hired' => 'success',
                            'rejected' => 'danger',
                            default => 'warning',
                        };
                        $statusText = match ($application->status) {
                            'pending' => 'Under Review',
                            'selected' => 'Selected',
                            'hired' => 'Hired',
                            'rejected' => 'Not Selected',
                            default => 'Pending',
                        };
                    @endphp

                    <div class="card mb-3 application-card {{ $application->status }}">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button d-flex flex-column align-items-start py-3" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#collapse{{ $loop->iteration }}"
                                    aria-expanded="false" aria-controls="collapse{{ $loop->iteration }}">
                                    <div class="d-flex w-100 justify-content-between align-items-center mb-1">
                                        <span class="job-company">{{ $application->job->corporate->name }}</span>
                                        <span class="badge bg-{{ $statusClass }}">{{ $statusText }}</span>
                                    </div>
                                    <h5 class="mb-1">{{ $application->job->title }}</h5>
                                    <div class="application-meta">
                                        <span class="application-meta-item">
                                            <i class="far fa-calendar-alt"></i>
                                            Applied {{ $application->created_at->diffForHumans() }}
                                        </span>
                                        <span class="application-meta-item">
                                            <i class="fas fa-money-bill-wave"></i>
                                            {{ $application->preferred_pay ?? 'Pay not specified' }}
                                        </span>
                                    </div>
                                </button>
                            </h2>

                            <div id="collapse{{ $loop->iteration }}" class="accordion-collapse collapse"
                                data-bs-parent="#applicationsAccordion">
                                <div class="accordion-body pt-0">
                                    @if($application->status == 'selected')
                                    <div class="alert alert-primary">
                                        <h6>You have been selected for this job. Please wait for further instructions.</h6>
                                        <p class="text-muted">
                                            <strong>Interview Method:</strong> {{ $application->job->interview_method }} <br>
                                            <strong>Interview Date:</strong> {{ $application->job->interview_date }} <br>
                                            <strong>Interview Place:</strong> {{ $application->job->interview_place }} <br>
                                        </p>
                                    </div>
                                    @endif
                                    @if($application->status == 'hired')
                                    <div class="alert alert-success">
                                        <h6>You have been hired for this job. Please wait for further instructions.</h6>
                                    </div>
                                    @endif
                                    @if($application->status == 'rejected')
                                    <div class="application-content">
                                        <h6 class="text-muted mb-3">Application Details</h6>

                                        @if($application->reason)
                                        <div class="mb-3">
                                            <h6>Why you're a good fit</h6>
                                            <p class="text-muted">{{ $application->reason }}</p>
                                        </div>
                                        @endif

                                        @if($application->cover_letter)
                                        <div class="mb-4">
                                            <h6>Cover Letter</h6>
                                            <p class="text-muted">{{ $application->cover_letter }}</p>
                                        </div>
                                        @endif

                                        <div class="d-flex justify-content-between border-top pt-3">
                                            <a href="{{ route('jobs.show', $application->job->id) }}"
                                               class="btn btn-outline-primary btn-sm">
                                                <i class="far fa-eye mr-1"></i> View Job
                                            </a>
                                            <div class="action-buttons">
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#editApplicationModal"
                                                   class="btn btn-outline-secondary btn-sm"
                                                   data-id="{{ $application->id }}" id="editApplicationToggle">
                                                    <i class="bi bi-pencil-square mr-1"></i> Edit
                                                </a>
                                                <a href="#" class="btn btn-outline-danger btn-sm ml-2"
                                                   data-id="{{ $application->id }}" id="deleteApplicationToggle">
                                                    <i class="bi bi-trash mr-1"></i> Delete
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="empty-state">
                <div class="empty-state-icon">
                    <i class="far fa-file-alt"></i>
                </div>
                <h4>No applications yet</h4>
                <p class="text-muted mb-4">You haven't applied to any jobs yet. Find your next opportunity!</p>
                <a href="{{ route('jobs.index') }}" class="btn btn-primary">
                    <i class="fas fa-search mr-1"></i> Browse Jobs
                </a>
            </div>
        @endif
    </main>

    <div class="modal" id="editApplicationModal" aria-hidden="true" aria-labelledby="editApplicationModalToggleLabel"
    tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editApplicationModalToggleLabel">Edit Application</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="{{ route('job.apply') }}" method="post" enctype="multipart/form-data"
                id="editApplicationForm">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="job_id" id="jobID" value="">
                    <input type="hidden" name="id" id="applicationID" value="">
                    <div class="card-body">

                        <div class="row mb-2">
                            <div class="col-md-12 form-group mb-4">
                                <label for="prefferedpay" class="mb-2">Preffered Pay</label><br>
                                <input type="text" class="form-control form-control-lg" name="preferred_pay"
                                    id="applicationPrefferedPay" required>
                            </div>

                            <div class="col-md-12 form-group mb-4">
                                <label for="applicationReason" class="mb-2">Why are you applying for this
                                    job</label>
                                <textarea class="form-control form-control-lg" name="reason" id="applicationReason"></textarea>
                            </div>

                            <div class="col-md-12 mb-4">
                                <label for="cover_letter" class="mb-2">Cover letter</label>
                                <textarea name="cover_letter" id="cover_letter" class="form-control form-control-lg" rows="5"></textarea>
                            </div>

                            <div class="col-md-12 form-group">
                                <label for="otherFiles" class="mb-2">Attach other relavant
                                    documents</label><br>
                                <input type="file" name="files" id="applicationOtherFiles" multiple>
                                <div id="filesError"></div>
                            </div>

                        </div>
                        <div id="applyFeedback"></div>
                    </div>
                </div>

                <div class="modal-footer">
                    <div class="card-footer bg-white d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary btn-md" id="jobApplySubmit">Submit</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>

@endsection

@section('footer_scripts')
    <script src="{{ asset('js/functions.js') }}"></script>
    <script src="{{ asset('js/application.js') }}"></script>
@endsection
