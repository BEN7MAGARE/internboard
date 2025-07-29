@extends('layouts.dashboard')

@section('title')
    My Contracts @parent
@endsection

@section('header_styles')
    <style>
        .contract-card {
            border-left: 4px solid #4e73df;
            transition: all 0.3s ease;
            margin-bottom: 1.5rem;
        }
        .contract-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        }
        .contract-status {
            font-weight: 600;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .status-active {
            background-color: #e6f7ee;
            color: #28a745;
        }
        .status-completed {
            background-color: #f8f9fa;
            color: #6c757d;
        }
        .status-terminated {
            background-color: #fee;
            color: #dc3545;
        }
        .contract-meta {
            display: flex;
            gap: 1.5rem;
            flex-wrap: wrap;
            margin: 1rem 0;
        }
        .meta-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.9rem;
        }
        .meta-icon {
            color: #4e73df;
            width: 20px;
            text-align: center;
        }
        .contract-actions {
            border-top: 1px solid #eee;
            padding-top: 1rem;
            margin-top: 1rem;
        }
        .empty-state {
            text-align: center;
            padding: 3rem;
            background: #f8fafc;
            border-radius: 0.5rem;
            max-width: 600px;
            margin: 2rem auto;
        }
        .empty-state-icon {
            font-size: 4rem;
            color: #d1d5db;
            margin-bottom: 1.5rem;
        }
        .document-preview {
            background: #f8f9fa;
            border-radius: 4px;
            padding: 1rem;
            margin-top: 1rem;
        }
        .document-icon {
            font-size: 2rem;
            color: #6c757d;
        }
        .progress-tracker {
            margin: 1.5rem 0;
        }
    </style>
@endsection

@section('subtitle')
    <h1 class="h3 mb-0 text-gray-800">My Contracts</h1>
    <p class="mb-4">View and manage your employment contracts</p>
@endsection

@section('content')
    <main class="container py-4">
        @if ($contracts->count() > 0)
            <div class="row">
                @foreach ($contracts as $contract)
                    @php
                        $statusClass = match($contract->status) {
                            'active' => 'status-active',
                            'completed' => 'status-completed',
                            'terminated' => 'status-terminated',
                            default => ''
                        };
                    @endphp

                    <div class="col-lg-6 mb-4">
                        <div class="card contract-card h-100">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <h3 class="h5 card-title mb-1">{{ $contract->job->title }}</h3>
                                        <p class="text-muted mb-2">{{ $contract->job->corporate->name }}</p>
                                    </div>
                                    <span class="contract-status {{ $statusClass }}">{{ ucfirst($contract->status) }}</span>
                                </div>

                                <div class="contract-meta">
                                    <div class="meta-item">
                                        <i class="fas fa-calendar-alt meta-icon"></i>
                                        <div>
                                            <small class="text-muted">Start Date</small>
                                            <div>{{ $contract->start_date->format('M d, Y') }}</div>
                                        </div>
                                    </div>
                                    <div class="meta-item">
                                        <i class="fas fa-calendar-check meta-icon"></i>
                                        <div>
                                            <small class="text-muted">End Date</small>
                                            <div>{{ $contract->end_date ? $contract->end_date->format('M d, Y') : 'Ongoing' }}</div>
                                        </div>
                                    </div>
                                    <div class="meta-item">
                                        <i class="fas fa-dollar-sign meta-icon"></i>
                                        <div>
                                            <small class="text-muted">Rate</small>
                                            <div>{{ $contract->rate_amount }} {{ $contract->rate_type }}</div>
                                        </div>
                                    </div>
                                    <div class="meta-item">
                                        <i class="fas fa-file-signature meta-icon"></i>
                                        <div>
                                            <small class="text-muted">Signed</small>
                                            <div>{{ $contract->signed_at ? $contract->signed_at->format('M d, Y') : 'Pending' }}</div>
                                        </div>
                                    </div>
                                </div>

                                @if($contract->status == 'active')
                                <div class="progress-tracker">
                                    <small class="text-muted d-block mb-1">Contract Progress</small>
                                    @php
                                        $progressPercent = $contract->progress();
                                        $progressColor = $progressPercent < 30 ? 'bg-danger' : ($progressPercent < 70 ? 'bg-warning' : 'bg-success');
                                    @endphp
                                    <div class="progress">
                                        <div class="progress-bar {{ $progressColor }}" role="progressbar"
                                             style="width: {{ $progressPercent }}%"
                                             aria-valuenow="{{ $progressPercent }}"
                                             aria-valuemin="0" aria-valuemax="100">
                                            {{ $progressPercent }}%
                                        </div>
                                    </div>
                                </div>
                                @endif

                                <div class="document-preview">
                                    <div class="d-flex align-items-center">
                                        <i class="far fa-file-pdf document-icon mr-3"></i>
                                        <div>
                                            <h6 class="mb-1">Contract Document</h6>
                                            <small class="text-muted">Last updated {{ $contract->updated_at->diffForHumans() }}</small>
                                        </div>
                                    </div>
                                </div>

                                <div class="contract-actions d-flex justify-content-between">
                                    <a href="{{ route('contracts.download', $contract->id) }}" class="btn btn-outline-primary btn-sm">
                                        <i class="fas fa-download mr-1"></i> Download
                                    </a>
                                    <div>
                                        <a href="#" class="btn btn-outline-secondary btn-sm mr-2" data-toggle="modal" data-target="#viewContractModal-{{ $contract->id }}">
                                            <i class="fas fa-eye mr-1"></i> View Details
                                        </a>
                                        @if($contract->status == 'active' && !$contract->signed_at)
                                        <a href="#" class="btn btn-success btn-sm" data-toggle="modal" data-target="#signContractModal-{{ $contract->id }}">
                                            <i class="fas fa-signature mr-1"></i> Sign Contract
                                        </a>
                                        @endif
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
                    <i class="fas fa-file-contract"></i>
                </div>
                <h4>No Contracts Yet</h4>
                <p class="text-muted mb-4">You don't have any active contracts at the moment. When you're hired for a job, your contract will appear here.</p>
                <a href="{{ route('jobs.index') }}" class="btn btn-primary">
                    <i class="fas fa-search mr-1"></i> Browse Jobs
                </a>
            </div>
        @endif
    </main>
@endsection

@section('footer_scripts')
    <script>
        // You can add contract-specific JavaScript here if needed
    </script>
@endsection
