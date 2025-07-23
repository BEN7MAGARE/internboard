@extends('layouts.dashboard')

@section('title')
Applicants @parent
@endsection

@section('header_styles')
<link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
<style>
    .applicant-card {
        transition: all 0.3s ease;
        border-left: 4px solid #0d6efd;
        margin-bottom: 1.5rem;
    }
    .applicant-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    }
    .applicant-header {
        background-color: #f8f9fa;
        border-bottom: 1px solid #e9ecef;
    }
    .action-btn {
        min-width: 120px;
        margin-right: 8px;
        margin-bottom: 8px;
    }
    .status-badge {
        font-size: 0.8rem;
        padding: 5px 10px;
        border-radius: 20px;
    }
    .selected-badge {
        background-color: #d4edda;
        color: #155724;
    }
    .pending-badge {
        background-color: #fff3cd;
        color: #856404;
    }
    .scrollable-div {
        max-height: 70vh;
        overflow-y: auto;
        padding-right: 10px;
    }
    .education-item {
        margin-bottom: 5px;
    }
    .file-download-btn {
        margin-right: 8px;
        margin-bottom: 8px;
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
</style>
@endsection

@section('subtitle')
Applicants Management
@endsection

@section('content')
<main class="container py-4">
    <div class="card mb-4">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h3 class="h4 mb-1"><strong>{{ $job->title }}</strong></h3>
                    <p class="mb-0">{{ $job->description }}</p>
                </div>
                <span class="badge bg-primary translatable">
                    {{ $job->applications_count }} Applicant{{ $job->applications_count != 1 ? 's' : '' }}
                </span>
            </div>
        </div>

        <form action="{{ route('applications.select') }}" method="post" id="applicantsSelectForm">
            @csrf
            <div class="card-body">
                @if ($job->applications_count > 0)
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="mb-0"><strong class="translatable">Applicant Details</strong></h5>
                    <div class="text-muted translatable">
                        Showing {{ $job->applications->count() }} candidates
                    </div>
                </div>

                <div class="scrollable-div">
                    @foreach ($job->applications as $item)
                    <div class="card applicant-card mb-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="me-3">
                                            <i class="fas fa-user-circle fa-3x text-secondary"></i>
                                        </div>
                                        <div>
                                            <h4 class="h5 mb-1">
                                                <strong>{{ $item->applicant->first_name }} {{ $item->applicant->last_name }}</strong>
                                                @if($item->status == 'selected')
                                                <span class="status-badge selected-badge ms-2 translatable">Selected</span>
                                                @else
                                                <span class="status-badge pending-badge ms-2 translatable">Pending</span>
                                                @endif
                                            </h4>
                                            
                                            @if (!is_null($item->profile))
                                            <p class="mb-1 text-muted">
                                                <i class="fas fa-briefcase me-1"></i>
                                                {{ $item->profile->level }} in {{ $item->profile->specialization }} with {{ $item->profile->years_of_experience }} years experience
                                            </p>
                                            @php
                                            $education = json_decode($item->profile->education);
                                            @endphp
                                            @if (!is_null($education))
                                            <div class="education-item">
                                                <p class="mb-1 text-muted">
                                                    <i class="fas fa-graduation-cap me-1"></i>
                                                    <strong>Education:</strong> {{ $education[0]->level }} in {{ $education[0]->course }}
                                                </p>
                                            </div>
                                            @endif
                                            @endif
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <h6 class="fw-bold"><i class="fas fa-comment me-1"></i> Application Details</h6>
                                        <div class="ps-3">
                                            <p class="mb-1"><strong>Reason for applying:</strong> {{ $item->reason }}</p>
                                            <p class="mb-0"><strong>Cover letter:</strong> {{ Str::limit($item->cover_letter, 150) }}</p>
                                            @if (strlen($item->cover_letter) > 150)
                                            <a href="#" class="text-primary" data-bs-toggle="modal" data-bs-target="#applicationDetailsModal" data-id="{{$item->id}}" id="applicationDetailsToggle">Read more</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="d-flex flex-wrap mb-3">
                                        <a href="{{ route('student.details', $item->id) }}" class="btn btn-outline-primary action-btn" target="_blank">
                                            <i class="fas fa-user me-1"></i> View Profile
                                        </a>
                                        <a href="{{ route('application.cvdownload', $item->id) }}" class="btn btn-outline-secondary action-btn" target="_blank">
                                            <i class="fas fa-download me-1"></i> Download CV
                                        </a>
                                        @php
                                        $files = json_decode($item->files, 1);
                                        @endphp
                                        @foreach ($files as $file)
                                        <a href="{{ route('download.file', $file) }}" class="btn btn-outline-info file-download-btn" target="_blank">
                                            <i class="fas fa-file-download me-1"></i> Doc {{ $loop->iteration }}
                                        </a>
                                        @endforeach
                                    </div>

                                    <div class="form-check form-switch d-flex justify-content-end">
                                        <input class="form-check-input applicantSelectToggle" type="checkbox" role="switch" id="applicantSelectToggle{{ $item->id }}" value="{{ $item->id }}" {{ $item->status == 'selected' ? 'checked' : '' }}>
                                        <label class="form-check-label ms-2" for="applicantSelectToggle{{ $item->id }}">
                                            <strong>{{ $item->status == 'selected' ? 'Selected' : 'Select Candidate' }}</strong>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    @endforeach
                </div>
                @else
                <div class="empty-state">
                    <i class="fas fa-user-friends"></i>
                    <h4 class="h5">No Applicants Yet</h4>
                    <p class="text-muted">There are currently no applicants for this job posting.</p>
                    <a href="#" class="btn btn-primary mt-2">Promote This Job</a>
                </div>
                @endif

                @if ($job->applications_count > 0)
                <div class="mt-4">
                    <div class="card">
                        <div class="card-header bg-light">
                            <h5 class="mb-0"><i class="fas fa-envelope me-2"></i> Send Invitations</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-group mb-3">
                                <label for="invitationLetter" class="form-label">Custom Invitation Message</label>
                                <textarea name="invitationLetter" id="invitationLetter" class="form-control" rows="5" placeholder="Write a personalized invitation message for selected candidates..."></textarea>
                                <small class="text-muted">This message will be sent to all selected candidates.</small>
                            </div>
                            <div id="invitationFeedback" class="mb-3"></div>
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary" id="submitInvitation">
                                    <i class="fas fa-paper-plane me-2"></i> Send Invitations
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </form>
    </div>
</main>

<div class="modal fade" id="applicationDetailsModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="applicationDetailsModal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitleText"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <h6 class="fw-bold">Reason for Applying</h6>
                    <p id="applicationReason"></p>
                </div>
                <div>
                    <h6 class="fw-bold">Full Cover Letter</h6>
                    <p id="applicationCoverLetter"></p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer_scripts')
<script src="{{ asset('js/select2.min.js') }}"></script>
<script src="{{ asset('js/functions.js') }}"></script>
<script src="{{ asset('js/job.js') }}"></script>
<script>
    $(document).ready(function() {
        // Initialize tooltips
        $('[data-bs-toggle="tooltip"]').tooltip();
        
        // Handle applicant selection toggle
        $('.applicantSelectToggle').change(function() {
            const applicantId = $(this).val();
            const isSelected = $(this).is(':checked');
            
            // You can add AJAX call here to update status in real-time
            console.log(`Applicant ${applicantId} ${isSelected ? 'selected' : 'deselected'}`);
        });
        
        // Form submission handling
        $('#applicantsSelectForm').submit(function(e) {
            e.preventDefault();
            // Add your form submission logic here
            $('#invitationFeedback').html(`
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    Invitations sent successfully to selected candidates!
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            `);
        });

        $('body').on('click','#applicationDetailsToggle', function() {
            const applicationid = $(this).data('id')
            $.getJSON(`/application-details/${applicationid}`, function(data) {
                $('#applicationDetailsModal').modal('show');
                $('#applicationReason').html(data.reason);
                $('#applicationCoverLetter').html(data.cover_letter);  
                $('#modalTitleText').text(`Cover Letter - ${data.applicant.first_name} ${data.applicant.last_name}`); 
            })
        })
    });
</script>
@endsection