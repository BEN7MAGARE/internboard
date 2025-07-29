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
                            'rejected' => 'danger',
                            default => 'success',
                        };
                        $statusText = match ($application->status) {
                            'pending' => 'Under Review',
                            'rejected' => 'Not Selected',
                            default => 'Hired',
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
                                                    <i class="far fa-edit mr-1"></i> Edit
                                                </a>
                                                <a href="#" class="btn btn-outline-danger btn-sm ml-2"
                                                   data-id="{{ $application->id }}" id="deleteApplicationToggle">
                                                    <i class="far fa-trash-alt mr-1"></i> Delete
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
@endsection

@section('footer_scripts')
    <script src="{{ asset('js/functions.js') }}"></script>
    <script src="{{ asset('js/application.js') }}"></script>
@endsection
