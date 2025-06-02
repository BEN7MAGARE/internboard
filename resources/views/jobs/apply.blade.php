@extends('layouts.main')

@section('title')
    Job Apply
@endsection

@section('header_styles')
    <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/iziToast.min.css') }}">
@endsection

@section('content')
<main class="main"> 
    <section class="main-content">
        <hr>
        <div class="page-title" data-aos="fade">
            <nav class="breadcrumbs">
                <div class="container-fluid">
                    <ol>
                        <li><a href="/">Home</a></li>
                        <li class="current">Job Opportunities</li>
                    </ol>
                </div>
            </nav>
        </div>

        <section class="job-section">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-7 bg-white" style="box-shadow: 5px 10px 29px 0 rgba(68, 88, 144, 0.2);">
                        @if ($applied)
                            <div class="alert alert-info" role="alert">
                                <p>Applied <i class="fa fa-check-circle"></i></p>
                            </div>
                        @endif
                        <div class="job-details-section">
                            <h4><b>{{ $job->corporate->name }}</b></h4>
                            <hr>
                            <div class="salary mb-2 p-2">
                                <span><b>{{ $job->type }}</b></span>
                                <span>Work Type: <b>{{ $job->job_type }}</b></span>
                                <span>NO of positions: <b>{{ $job->no_of_positions }}</b></span>
                                <span>{{ $job->salary_range }}</span>
                            </div>
                            <div class="desciption p-2">
                                <h6 class="mb-1">{{ $job->title }}</h6>
                                <p>{{ $job->description }}</p>
                            </div>
                            <hr>
                            <h5 class="d-flex justify-content-between p-2"><b>Skills</b> <span class="float-right">Level:
                                    <b>{{ $job->experience_level }}</b></span></h5>
                            <hr>
                            <div class="skills p-2">
                                @foreach ($job->skills as $item)
                                    <span>{{ $item->name }}</span>
                                @endforeach
                            </div>
                            <hr>
                            <div class="education d-flex justify-content-between">
                                <span>Education Level: <i class="fa fa-graduation-cap text-primary"></i>
                                    <b>{{ $job->education_level }}</b></span>
                                <span>Starts on: <i class="fa-regular fa-calendar-days text-primary"></i>
                                    <b>{{ date('j M Y', strtotime($job->start_date)) }}</b></span>
                            </div>
                            <hr>
                            <h5 class="d-flex justify-content-between mb-2 mt-2"><b>Requirements</b></h5>
                            @if ($job->requirements !== null)   
                            <div class="requirements">
                                @foreach (json_decode($job->requirements) as $item)
                                    <span>{{ $item }}</span>
                                @endforeach
                            </div>
                            @else
                            <div class="requirements">
                                <span>No requirements specified</span>
                            </div>
                            @endif
                            <hr>
                            <h5 class="d-flex justify-content-between mt-2 mb-2"><b>Qualifications</b></h5>
                            @if ($job->qualifications !== null)
                            <div class="qualifications">
                                @foreach (json_decode($job->qualifications) as $item)
                                    <span>{{ $item }}</span>
                                @endforeach
                            </div>
                            @else
                            <div class="qualifications p-2">
                                <span>No qualifications specified</span>
                            </div>
                            @endif
                            <hr>
                            <div class="location mt-3 d-flex justify-content-between p-2">
                                <div>
                                    <i class="fa-solid fa-location-dot"></i><span>Westlands Nairobi, Kenya</span>
                                </div>
                                <div>
                                    Posted: {{ date('j M Y', strtotime($job->created_at)) }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-5">
                        @if ($applied)
                        <div class="alert alert-info">
                            <h6><i class="bi bi-exclamation-triangle-fill"></i> You have already applied for this job. </h6>
                        </div>
                        @else
                            <div class="card">
                                <div class="card-header bg-white text-center">
                                    <h4 class="m-2">Apply by filling this form</h4>
                                </div>
                                <form action="{{ route('job.apply') }}" method="post" enctype="multipart/form-data"
                                    id="jobApplicationForm">
                                    @csrf
                                    <input type="hidden" name="job_id" id="jobID" value="{{ $job->id }}">
                                    <div class="card-body">

                                        <div class="row mb-2">

                                            <div class="col-md-12 form-group mb-4">
                                                <label for="preferredPay" class="mb-2">Your preffered pay</label>
                                                <input type="number" class="form-control form-control-lg" name="preferred_pay"
                                                    id="preferredPay">
                                            </div>
                                            
                                            <div class="col-md-12 form-group mb-4">
                                                <label for="applicationReason" class="mb-2">Why are you applying for this
                                                    job</label>
                                                <textarea class="form-control form-control-lg" name="reason"
                                                    id="applicationReason"></textarea>
                                            </div>

                                            <div class="col-md-12 mb-4">
                                                <label for="cover_letter" class="mb-2">Cover letter</label>
                                                <textarea name="cover_letter" id="cover_letter" class="form-control form-control-lg" rows="8"></textarea>
                                            </div>

                                            <div class="col-md-12 form-group mb-4">
                                                <label for="curriculumVitae" class="mb-2">Attach your CV</label><br>
                                                <input type="file" name="curriculum_vitae" id="curriculumVitae" required>
                                                <div id="cvError"></div>
                                            </div>

                                            <div class="col-md-12 form-group">
                                                <label for="otherFiles" class="mb-2">Attach other relavant
                                                    documents</label><br>
                                                <input type="file" name="files" id="otherFiles" multiple>
                                                <div id="filesError"></div>
                                            </div>
                                        </div>
                                        <div id="applyFeedback"></div>
                                    </div>

                                    <div class="card-footer bg-white d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary btn-md" id="jobApplySubmit">Apply</button>
                                    </div>

                                </form>
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </section>
    </section>
</main>
@endsection

@section('footer_scripts')
    <script src="{{ asset('js/iziToast.min.js') }}"></script>
    <script src="{{ asset('js/functions.js') }}"></script>
    <script src="{{ asset('js/application.js') }}"></script>
@endsection
