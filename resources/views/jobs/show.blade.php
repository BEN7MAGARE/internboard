@extends('layouts.main')

@section('title', $job->title . ' - Job Application')

@section('header_styles')
<link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/iziToast.min.css') }}">
<style>
    .job-application-container {
        background-color: #f8f9fa;
        padding: 2rem 0;
    }
    .job-header {
        background: linear-gradient(135deg, #667eea 0%, #667eea 100%);
        color: white;
        padding: 2rem 0;
        margin-bottom: 2rem;
    }
    .breadcrumbs {
        font-size: 0.9rem;
    }
    .breadcrumbs a {
        color: #a0aec0;
        text-decoration: none;
        transition: color 0.3s;
    }
    .breadcrumbs a:hover {
        color: white;
    }
    .job-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        padding: 2rem;
        margin-bottom: 2rem;
    }
    .job-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 1.5rem;
        margin-bottom: 1.5rem;
        padding-bottom: 1.5rem;
        border-bottom: 1px solid #e2e8f0;
    }
    .job-meta-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        color: #4a5568;
    }
    .job-meta-item i {
        color: #667eea;
    }
    .job-section-title {
        color: #2d3748;
        margin: 1.5rem 0 1rem;
        font-weight: 600;
    }
    .skills-list {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
    }
    .skill-tag {
        background-color: #edf2f7;
        padding: 0.35rem 0.75rem;
        border-radius: 50px;
        font-size: 0.85rem;
        color: #4a5568;
    }
    .employer-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        padding: 2rem;
        position: sticky;
        top: 20px;
    }
    .employer-logo {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid #e2e8f0;
        margin: 0 auto 1rem;
        display: block;
    }
    .employer-name {
        font-size: 1.25rem;
        font-weight: 600;
        text-align: center;
        margin-bottom: 0.5rem;
        color: #2d3748;
    }
    .employer-location {
        color: #718096;
        text-align: center;
        margin-bottom: 1.5rem;
        font-size: 0.9rem;
    }
    .stats-card {
        background-color: #f8f9ff;
        border-radius: 8px;
        padding: 1rem;
        margin-bottom: 1rem;
    }
    .stats-title {
        font-size: 0.85rem;
        color: #718096;
        margin-bottom: 0.5rem;
    }
    .stats-value {
        font-size: 1.5rem;
        font-weight: 600;
        color: #2d3748;
    }
    .btn-apply {
        background: linear-gradient(135deg, #667eea 0%, #667eea 100%);
        border: none;
        padding: 0.75rem 2rem;
        font-weight: 600;
        letter-spacing: 0.5px;
        width: 100%;
        margin-top: 1rem;
    }
    .btn-apply:hover {
        opacity: 0.9;
        transform: translateY(-2px);
    }
    .job-description {
        line-height: 1.7;
        color: #4a5568;
    }
    .requirement-list, .qualification-list {
        padding-left: 1.25rem;
    }
    .requirement-list li, .qualification-list li {
        margin-bottom: 0.5rem;
        color: #4a5568;
    }
</style>
@endsection

@section('content')
<main class="job-application-container">
    <div class="job-header mt-4">
        <div class="container">
            <nav class="breadcrumbs">
                <ol class="d-flex align-items-center gap-2" style="list-style: none; padding: 0; margin: 0;">
                    <li><a href="/">Home</a></li>
                    <li><i class="fas fa-chevron-right" style="font-size: 0.7rem;"></i></li>
                    <li><a href="/jobs">Job Opportunities</a></li>
                    <li><i class="fas fa-chevron-right" style="font-size: 0.7rem;"></i></li>
                    <li class="current">{{ $job->title }}</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="job-card">
                    <h2 class="mb-3">{{ $job->title }}</h2>

                    <div class="job-meta">
                        <div class="job-meta-item">
                            <i class="fas fa-briefcase"></i>
                            <span>{{ $job->type }}</span>
                        </div>
                        <div class="job-meta-item">
                            <i class="fas fa-clock"></i>
                            <span>{{ $job->job_type }}</span>
                        </div>
                        <div class="job-meta-item">
                            <i class="fas fa-users"></i>
                            <span>Openings: {{ $job->no_of_positions }}</span>
                        </div>
                        <div class="job-meta-item">
                            <i class="fas fa-money-bill-wave"></i>
                            <span>{{ $job->salary_range }}</span>
                        </div>
                        <div class="job-meta-item">
                            <i class="fas fa-chart-line"></i>
                            <span>{{ $job->experience_level }}</span>
                        </div>
                    </div>

                    <h4 class="job-section-title">Job Description</h4>
                    <div class="job-description">
                        {{ $job->description }}
                    </div>

                    <h4 class="job-section-title">Skills Required</h4>
                    <div class="skills-list">
                        @if ($job->skills !== null)
                            @foreach ($job->skills as $item)
                                <span class="skill-tag">{{ $item->name }}</span>
                            @endforeach
                        @else
                            <span class="skill-tag">No skills specified</span>
                        @endif
                    </div>

                    <h4 class="job-section-title">Requirements</h4>
                    <ul class="requirement-list">
                        @if ($job->requirements !== null)
                            @foreach (json_decode($job->requirements, true) as $item)
                                <li>{{ $item }}</li>
                            @endforeach
                        @else
                            <li>No requirements specified</li>
                        @endif
                    </ul>

                    <h4 class="job-section-title">Qualifications</h4>
                    <ul class="qualification-list">
                        @if ($job->qualifications !== null)
                            @foreach (json_decode($job->qualifications, true) as $item)
                                <li>{{ $item }}</li>
                            @endforeach
                        @else
                            <li>No qualifications specified</li>
                        @endif
                    </ul>

                    <div class="d-flex justify-content-between mt-4">
                        <div class="job-meta-item">
                            <i class="fas fa-graduation-cap"></i>
                            <span>{{ $job->education_level }}</span>
                        </div>
                        <div class="job-meta-item">
                            <i class="fas fa-calendar-alt"></i>
                            <span>Starts: {{ $job->start_date }}</span>
                        </div>
                        <div class="job-meta-item">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>{{ $job->location }}</span>
                        </div>
                    </div>

                    <div class="text-end mt-4">
                        <a href="/jobs/{{ $job->ref_no }}/apply" class="btn btn-apply">
                            Apply Now <i class="fas fa-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="employer-card">
                    @php
                        $logo = $corporate->logo == null || $corporate->logo == '' ? 'logoavatar.png' : $corporate->logo;
                    @endphp

                    <img src="{{ asset('corporate_logos/' . $logo) }}"
                         alt="{{ $corporate->name }}"
                         class="employer-logo">

                    <h3 class="employer-name">{{ $corporate->name }}</h3>
                    <p class="employer-location">{{ $corporate->address }}</p>

                    <div class="stats-card">
                        <div class="stats-title">Total Jobs Posted</div>
                        <div class="stats-value">{{ $corporate->jobs_count }}</div>
                    </div>

                    <div class="stats-card">
                        <div class="stats-title">Active Jobs</div>
                        <div class="stats-value">{{ $corporate->active_jobs_count ?? 'N/A' }}</div>
                    </div>

                    <div class="stats-card">
                        <div class="stats-title">Average Hiring Time</div>
                        <div class="stats-value">{{ $corporate->avg_hiring_time ?? 'N/A' }} days</div>
                    </div>

                    <div class="stats-card">
                        <div class="stats-title">Employee Retention</div>
                        <div class="stats-value">{{ $corporate->employee_retention ?? 'N/A' }}%</div>
                    </div>

                    <a href="/company/{{ $corporate->id }}" class="btn btn-outline-primary w-100 mt-3">
                        View Company Profile
                    </a>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@section('footer_scripts')
<script src="{{ asset('js/iziToast.min.js') }}"></script>
<script src="{{ asset('js/functions.js') }}"></script>
<script src="{{ asset('js/application.js') }}"></script>
<script>
    // document.addEventListener('DOMContentLoaded', function() {
    //     // Smooth scroll for anchor links
    //     document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    //         anchor.addEventListener('click', function(e) {
    //             e.preventDefault();
    //             document.querySelector(this.getAttribute('href')).scrollIntoView({
    //                 behavior: 'smooth'
    //             });
    //         });
    //     });

    //     // Initialize tooltips
    //     $('[data-toggle="tooltip"]').tooltip();
    // });
</script>
@endsection
