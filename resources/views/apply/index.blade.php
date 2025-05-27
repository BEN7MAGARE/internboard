@extends('layouts.dashboard')

@section('title')
    Applications @parent
@endsection

@section('header_styles')
    <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endsection

@section('subtitle', 'Applications')

@section('content')
    <main class="mt-3 p-2">
        <div class="card p-2">
            @if (auth()->user()->role === 'student' || auth()->user()->role === 'worker')

                <div>
                    @if ($applications->isNotEmpty())
                        <div class="accordion" id="accordionExample">
                            @foreach ($applications as $application)
                                <div class="card mb-2">
                                    <div class="accordion-item p-2">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#collapse{{ $loop->iteration }}" aria-expanded="true"
                                                aria-controls="collapse{{ $loop->iteration }}">
                                                {!! '<strong>' . $application->job->corporate->name . '</strong>' . ': &nbsp;&nbsp;' . $application->job->title !!}
                                            </button>
                                        </h2>

                                        <div id="collapse{{ $loop->iteration }}" class="accordion-collapse collapse"
                                            data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                <div class="reason mb-2">
                                                    <p><b>Reason</b></p>
                                                    <p>{{ $application->reason }}</p>
                                                </div>
                                                <div class="reason mb-2">
                                                    <p><b>Cover Letter</b></p>
                                                    <p>{{ $application->cover_letter }}</p>
                                                </div>
                                                <div class="section-action d-flex justify-content-between">
                                                    <a href="#" data-bs-toggle="modal"
                                                        data-bs-target="#editApplicationModal"
                                                        class="btn btn-outline-primary" data-id="{{ $application->id }}"
                                                        id="editApplicationToggle">Edit <i class="fa fa-pen"></i></a>
                                                    <a href="" class="btn btn-outline-danger"
                                                        data-id="{{ $application->id }}"
                                                        id="deleteApplicationToggle">Delete</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="alert alert-danger">
                            <p>You have not yet applied for any job.</p>
                            <a href="{{ route('jobs.index') }}" class="btn btn-secondary btn-sm">Browse Jobs</a>
                        </div>
                    @endif
                </div>
        </div>
        @endif
        @if (auth()->user()->role == 'corporate')
        @endif
    </main>
@endsection

<div class="modal" id="editApplicationModalToggle" aria-hidden="true" aria-labelledby="editApplicationModalToggleLabel"
    tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editApplicationModalToggleLabel">Edit Application</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('job.apply') }}" method="post" enctype="multipart/form-data"
                id="jobApplicationForm">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="job_id" id="jobID" value="">
                    <input type="hidden" name="id" id="applicationID" value="">
                    <div class="card-body">

                        <div class="row mb-2">

                            <div class="col-md-12 form-group mb-4">
                                <label for="applicationReason" class="mb-2">Why are you applying for this
                                    job</label>
                                <textarea class="form-control form-control-lg" name="reason" id="applicationReason"></textarea>
                            </div>

                            <div class="col-md-12 mb-4">
                                <label for="cover_letter" class="mb-2">Cover letter</label>
                                <textarea name="cover_letter" id="applicationCoverLetter" class="form-control form-control-lg" rows="8"></textarea>
                            </div>

                            <div class="col-md-12 form-group mb-4">
                                <label for="curriculumVitae" class="mb-2">Attach your CV</label><br>
                                <input type="file" name="curriculum_vitae" id="applicationCurriculumVitae" required>
                                <div id="cvError"></div>
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
                        <button type="submit" class="btn btn-primary btn-md" id="jobApplySubmit">Submit <i
                                class="bi bi-angles-right"></i></button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>

@section('footer_scripts')
    <script src="{{ asset('js/select2.min.js') }}"></script>
    <script src="{{ asset('js/application.js') }}"></script>
@endsection
