@extends('layouts.app')

@section('title')
    Profile @parent
@endsection

@section('header_styles')
    <link rel="stylesheet" href="{{ asset('assets/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/profile.css') }}">
    <script>
        $.fn.modal.Constructor.prototype.enforceFocus = function() {};
    </script>
@endsection

@section('content')
    <section class="section profile" style="background:#EAFAF1;">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 mb-4">

                    @include('profile.partials.sidebarnav')

                </div>

                <div class="col-xl-9">

                    <div class="card">
                        <div class="card-header bg-white d-flex justify-content-between">
                            <h4 class="card-title">My Jobs</h4>
                            <a href="{{ route('jobs.create') }}" class="btn btn-primary btn-md"><i
                                    class="fa fa-plus"></i>&nbsp;Add new job</a>
                        </div>

                        <div class="card-body pt-3">
                            @foreach ($jobs as $key => $item)
                                <div class="job">
                                    <div class="title ">
                                        <h3>{{ $item->title }}</h3>
                                    </div>
                                    <div class="desciption p-2">
                                        <p>{{ $item->description }}</p>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <p class="text-muted">{{ $item->applications_count }} Applicants</p>
                                    <a href="{{ route('job.applications', $item->id) }}" class="btn btn-primary btn-sm">View
                                        Applicants</a>
                                </div>
                        </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
        </div>
    </section>
@endsection

@section('footer_scripts')
    <script src="{{ asset('assets/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/profile.js') }}"></script>
@endsection
