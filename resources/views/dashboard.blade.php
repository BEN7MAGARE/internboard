@extends('layouts.main')

@section('title')
    Profile @parent
@endsection

@section('header_styles')
    <link rel="stylesheet" href="{{ asset('assets/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/profile.css') }}">

@endsection

@section('content')
    <section class="w3l-main-content">
        <div class="container">
            <div class="row">

                <div class="col-xl-3 mb-4">
                   @include('profile.partials.sidebarnav')
                </div>

                <div class="col-xl-9">

                    <div class="card">
                        <div class="card-body pt-3">
                            <ul class="nav nav-tabs nav-tabs-bordered">
                                <li class="nav-item">
                                    <button class="nav-link active" data-bs-toggle="tab"
                                        data-bs-target="#profile-overview">Overview</button>
                                </li>

                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab"
                                        data-bs-target="#profile-change-password">Change
                                        Password</button>
                                </li>
                            </ul>

                            <div class="tab-content pt-2">

                                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                    <h5 class="card-title">Summary</h5>
                                    <p class="small">{{ auth()->user()->profile?->summary }}</p>

                                    <h5 class="card-title">Profile Details</h5>

                                    <div class="row">
                                        <div class="col-lg-2 col-md-4 label ">Full Name</div>
                                        <div class="col-lg-10 col-md-10">
                                            {{ auth()->user()->title . '. ' . auth()->user()->first_name . ' ' . auth()->user()->last_name }}
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-2 col-md-3 label">Education</div>
                                        <div class="col-lg-10 col-md-8">{{ auth()->user()->profile?->education_level.' '.auth()->user()->profile?->course }}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-2 col-md-4 label">Job</div>
                                        <div class="col-lg-10 col-md-6">{{ auth()->user()->profile?->level.' '.auth()->user()->profile?->specialization.' with '.auth()->user()->profile?->years_of_experience." years of experience. " }}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-2 col-md-4 label">Address</div>
                                        <div class="col-lg-10 col-md-8">{{ auth()->user()->address }}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-2 col-md-4 label">Phone</div>
                                        <div class="col-lg-10 col-md-8">{{ auth()->user()->phone }}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-2 col-md-4 label">Email</div>
                                        <div class="col-lg-10 col-md-8">{{ auth()->user()->email }}</div>
                                    </div>

                                    <div class="mt-2 text-center">
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#updateProdileDetailsModal"
                                            class="btn btn-primary">Update Details</a>
                                    </div>
                                </div>

                                <div class="tab-pane fade pt-3" id="profile-change-password">
                                    <form action="{{ route('password.change') }}" method="post">
                                    @csrf

                                        <div class="row mb-3">
                                            <label for="password" class="col-md-4 col-lg-3 col-form-label">New
                                                Password</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="password" type="password" class="form-control"
                                                    id="password">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="passwordConfirmation" class="col-md-4 col-lg-3 col-form-label">Re-enter
                                                New
                                                Password</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="password_confirmation" type="password" class="form-control"
                                                    id="passwordConfirmation">
                                            </div>
                                        </div>

                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary">Change Password</button>
                                        </div>
                                    </form>

                                </div>

                            </div>

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
