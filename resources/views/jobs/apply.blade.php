@extends('layouts.main')

@section('title', 'Apply for ' . $job->title)

@section('header_styles')
    <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/iziToast.min.css') }}">
    <style>
        .application-container {
            background-color: #f8f9fa;
            padding: 2rem 0;
        }

        .job-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 1.5rem 0;
            margin-bottom: 2rem;
        }

        .breadcrumbs {
            font-size: 0.9rem;
        }

        .breadcrumbs a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: color 0.3s;
        }

        .breadcrumbs a:hover {
            color: white;
        }

        .job-details-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            padding: 2rem;
            height: 100%;
        }

        .application-form-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            padding: 2rem;
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

        .section-title {
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

        .requirement-list,
        .qualification-list {
            padding-left: 1.25rem;
        }

        .requirement-list li,
        .qualification-list li {
            margin-bottom: 0.5rem;
            color: #4a5568;
        }

        .form-label {
            font-weight: 500;
            color: #2d3748;
            margin-bottom: 0.5rem;
        }

        .form-control-lg {
            border-radius: 8px;
            padding: 0.75rem 1rem;
        }

        .file-input-label {
            display: block;
            padding: 1.5rem;
            border: 2px dashed #e2e8f0;
            border-radius: 8px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s;
            background-color: #f8f9fa;
        }

        .file-input-label:hover {
            border-color: #667eea;
            background-color: #f0f4ff;
        }

        .file-input-text {
            display: block;
            margin-top: 0.5rem;
            font-size: 0.85rem;
            color: #718096;
        }

        .btn-apply {
            background: linear-gradient(135deg, #667eea 0%, #667eea 100%);
            border: none;
            padding: 0.75rem 2rem;
            font-weight: 600;
            letter-spacing: 0.5px;
            min-width: 150px;
        }

        .btn-apply:hover {
            opacity: 0.9;
            transform: translateY(-2px);
        }

        .already-applied {
            background-color: #f0f4ff;
            border-left: 4px solid #667eea;
            padding: 1.5rem;
            border-radius: 8px;
            text-align: center;
        }

        .already-applied-icon {
            font-size: 2.5rem;
            color: #667eea;
            margin-bottom: 1rem;
        }
    </style>
@endsection

@section('content')
    <main class="application-container">
        <div class="job-header mt-5">
            <div class="container">
                <nav class="breadcrumbs">
                    <ol class="d-flex align-items-center gap-2" style="list-style: none; padding: 0; margin: 0;">
                        <li><a href="/">Home</a></li>
                        <li><i class="fas fa-chevron-right" style="font-size: 0.7rem;"></i></li>
                        <li><a href="/jobs">Job Opportunities</a></li>
                        <li><i class="fas fa-chevron-right" style="font-size: 0.7rem;"></i></li>
                        <li>Apply for {{ $job->title }}</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-lg-7 mb-4">
                    <div class="job-details-card">
                        @if ($applied)
                            <div class="already-applied mb-4">
                                <div class="already-applied-icon">
                                    <i class="bi bi-check-circle-fill"></i>
                                </div>
                                <h5>You've already applied for this position</h5>
                                <p class="text-muted">We've received your application and will review it shortly.</p>
                            </div>
                        @endif

                        <h3 class="mb-3">{{ $job->title }}</h3>
                        <h5 class="text-muted mb-4">{{ $job->corporate->name }}</h5>

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
                                <span>{{ $job->no_of_positions }} position(s)</span>
                            </div>
                            <div class="job-meta-item">
                                <i class="fas fa-money-bill-wave"></i>
                                <span>{{ $job->salary_range }}</span>
                            </div>
                        </div>

                        <h4 class="section-title">Job Description</h4>
                        <div class="job-description mb-4">
                            {{ $job->description }}
                        </div>

                        <h4 class="section-title">Skills Required</h4>
                        <div class="skills-list mb-4">
                            @foreach ($job->skills as $item)
                                <span class="skill-tag">{{ $item->name }}</span>
                            @endforeach
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <h4 class="section-title">Education Level</h4>
                                <div class="d-flex align-items-center gap-2">
                                    <i class="fas fa-graduation-cap text-primary"></i>
                                    <span>{{ $job->education_level }}</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h4 class="section-title">Start Date</h4>
                                <div class="d-flex align-items-center gap-2">
                                    <i class="far fa-calendar-alt text-primary"></i>
                                    <span>{{ date('j M Y', strtotime($job->start_date)) }}</span>
                                </div>
                            </div>
                        </div>

                        <h4 class="section-title">Requirements</h4>
                        <ul class="requirement-list mb-4">
                            @if ($job->requirements !== null)
                                @foreach (json_decode($job->requirements) as $item)
                                    <li>{{ $item }}</li>
                                @endforeach
                            @else
                                <li>No requirements specified</li>
                            @endif
                        </ul>

                        <h4 class="section-title">Qualifications</h4>
                        <ul class="qualification-list">
                            @if ($job->qualifications !== null)
                                @foreach (json_decode($job->qualifications) as $item)
                                    <li>{{ $item }}</li>
                                @endforeach
                            @else
                                <li>No qualifications specified</li>
                            @endif
                        </ul>
                    </div>
                </div>

                <div class="col-lg-5">
                    @if ($applied)
                        <div class="application-form-card text-center">
                            <div class="already-applied-icon">
                                <i class="bi bi-check2-circle"></i>
                            </div>
                            <h4 class="mb-3">Application Submitted</h4>
                            <p class="text-muted mb-4">Thank you for applying to this position. We'll review your
                                application and get back to you soon.</p>
                            <a href="/jobs" class="btn btn-outline-primary">Browse Other Jobs</a>
                        </div>
                    @else
                        <div class="application-form-card">
                            <div class="text-center mb-4">
                                <h3>Apply for This Position</h3>
                                <p class="text-muted">Fill out the form below to submit your application</p>
                            </div>

                            <form action="{{ route('job.apply') }}" method="post" enctype="multipart/form-data"
                                id="jobApplicationForm">
                                @csrf
                                <input type="hidden" name="job_id" value="{{ $job->id }}" id="jobID">

                                <div class="mb-4">
                                    <label for="preferredPay" class="form-label">Preferred Salary (optional)</label>
                                    <div class="input-group">
                                        <span class="input-group-text">Ksh</span>
                                        <input type="number" class="form-control form-control-lg" name="preferred_pay"
                                            id="applicationPrefferedPay" placeholder="Your expected compensation">
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label for="applicationReason" class="form-label">Why are you applying for this
                                        job?</label>
                                    <textarea class="form-control form-control-lg" name="reason" id="applicationReason" rows="3"
                                        placeholder="Briefly explain why you're interested in this position"></textarea>
                                </div>

                                <div class="mb-4">
                                    <label for="cover_letter" class="form-label">Cover Letter</label>
                                    <textarea name="cover_letter" id="cover_letter" class="form-control form-control-lg" rows="6"
                                        placeholder="Tell us why you'd be a great fit for this role"></textarea>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label">Upload Your CV (required)</label>
                                    <label for="curriculumVitae" class="file-input-label">
                                        <i class="bi bi-cloud-arrow-up-fill h3 text-primary"></i>
                                        <div>Click to upload CV</div>
                                        <span class="file-input-text">PDF, DOC, DOCX (Max 5MB)</span>
                                    </label>
                                    <input type="file" name="curriculum_vitae" id="curriculumVitae" class="d-none"
                                        required accept=".pdf,.doc,.docx">
                                    <div id="cvError" class="text-danger small mt-1"></div>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label">Additional Documents (optional)</label>
                                    <label for="otherFiles" class="file-input-label">
                                        <i class="bi bi-files h3 text-primary"></i>
                                        <div>Click to upload additional files</div>
                                        <span class="file-input-text">PDF, DOC, DOCX, JPG, PNG (Max 10MB total)</span>
                                    </label>
                                    <input type="file" name="files[]" id="otherFiles" class="d-none" multiple
                                        accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
                                    <div id="filesError" class="text-danger small mt-1"></div>
                                </div>
                                <div id="applyFeedback"></div>
                                <div class="d-flex justify-content-end mt-4">
                                    <button type="submit" class="btn btn-apply text-white" id="jobApplySubmit">
                                        Submit Application <i class="bi bi-send ms-2"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    @endif
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
        document.addEventListener('DOMContentLoaded', function() {
            // File input handling
            document.getElementById('curriculumVitae').addEventListener('change', function(e) {
                const label = document.querySelector('label[for="curriculumVitae"]');
                if (this.files.length > 0) {
                    label.innerHTML = `
                    <i class="bi bi-file-earmark-check-fill h3 text-success"></i>
                    <div>${this.files[0].name}</div>
                    <span class="file-input-text">${(this.files[0].size / 1024 / 1024).toFixed(2)} MB</span>
                `;
                }
            });

            document.getElementById('otherFiles').addEventListener('change', function(e) {
                const label = document.querySelector('label[for="otherFiles"]');
                if (this.files.length > 0) {
                    let fileList = '';
                    let totalSize = 0;

                    for (let i = 0; i < this.files.length; i++) {
                        fileList += `<div>${this.files[i].name}</div>`;
                        totalSize += this.files[i].size;
                    }

                    label.innerHTML = `
                    <i class="bi bi-file-earmark-check-fill h3 text-success"></i>
                    ${fileList}
                    <span class="file-input-text">${this.files.length} files (${(totalSize / 1024 / 1024).toFixed(2)} MB total)</span>
                `;
                }
            });

            // Form validation
            const form = document.getElementById('jobApplicationForm');
            form.addEventListener('submit', function(e) {
                const cvInput = document.getElementById('curriculumVitae');
                if (!cvInput.files.length) {
                    e.preventDefault();
                    document.getElementById('cvError').textContent = 'Please upload your CV';
                    cvInput.scrollIntoView({
                        behavior: 'smooth'
                    });
                }
            });
        });
    </script>
@endsection
