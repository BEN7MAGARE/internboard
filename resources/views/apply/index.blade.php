@extends('layouts.main')

@section('title')
    Applications @parent
@endsection

@section('header_styles')
    <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endsection

@section('content')
    <section class="main-content">
        <div class="page-title" data-aos="fade">
            <nav class="breadcrumbs">
                <div class="container">
                    <ol>
                        <li><a href="/">Home</a></li>
                        <li class="current">Applications</li>
                    </ol>
                </div>
            </nav>
        </div>

        @if (auth()->user()->role === 'student' || auth()->user()->role === 'worker')
            <div class="container mt-2 mb-2">

                <div class="row">
                    <div class="col-xl-3 mb-4 card">
                        @include('profile.partials.sidebarnav')
                    </div>

                    <div class="col-xl-9">
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
                                                        <a href="" class="btn btn-outline-primary">Edit <i
                                                                class="fa fa-pen"></i></a>
                                                        <a href="" class="btn btn-outline-danger">Cancel</a>
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
            </div>
        @endif
        @if (auth()->user()->role == 'corporate')
        @endif
    </section>
@endsection

@section('footer_scripts')
    <script src="{{ asset('js/select2.min.js') }}"></script>
    <script src="{{ asset('js/profile.js') }}"></script>
@endsection
