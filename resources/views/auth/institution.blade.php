@extends('layouts.main')

@section('title')
    College Sign up @parent
@endsection

@section('header_styles')
    <link rel="stylesheet" href="{{ asset('css/iziToast.min.css') }}">
@endsection

@section('content')
<main class="main">
    <hr>
    <section class="w3l-main-content">
        <div class="container d-flex justify-content-center align-items-center">
            <div class="col-md-7">
                <div class="card mt-5 mb-5 radius-image p-4">

                    <div class="card-header bg-white text-center">
                        <h4 class="mb-2"><strong>Join as University / College </strong></h4>
                    </div>

                    <form action="{{ route('register') }}" method="post" id="corporateSignupForm">
                        @csrf
                        <div class="card-body">
                            <h5><b>Institution Details</b></h5>
                            <hr>

                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="companyName">Institution Name</label>
                                    <input type="text" class="form-control " name="name" id="companyName" required>
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for="email">Institution Email</label>
                                    <input type="email" class="form-control " name="email" id="companyEmail" required>
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for="phone">Institution Phone</label>
                                    <input type="text" class="form-control " name="phone" id="companyPhone" required>
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for="address">Institution Address</label>
                                    <input type="text" class="form-control " name="address" id="companyAddress" required>
                                </div>
                            </div>

                            <hr>
                            <h5><b>College Contact Person Details</b></h5>
                            <hr>

                            <div class="row">

                                <div class="col-md-6 form-group">
                                    <label for="firstName">First name</label>
                                    <input type="text" class="form-control " name="first_name" id="firstName" required>
                                </div>

                                <input type="hidden" name="role" value="{{ $role }}" id="userRole">

                                <div class="col-md-6 form-group">
                                    <label for="lastName">Last name</label>
                                    <input type="text" class="form-control " name="last_name" id="lastName" required>
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control " name="email" id="email" required>
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for="phone">Phone</label>
                                    <input type="text" class="form-control " name="phone" id="phone" required>
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for="password">Password</label>
                                    <div class="input-group">
                                        <input type="password"
                                            class="form-control @error('password') invalid-input:'' @enderror"
                                            name="password" id="password" autocomplete="password" required>

                                        <div class="input-group-text showRegisterPassword">
                                            <i class="bi bi-eye"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for="passwordConfirmation">Confirm Password</label>
                                    <div class="input-group">
                                        <input type="password"
                                            class="form-control @error('password') invalid-input:'' @enderror"
                                            name="password_confimation" id="passwordConfirmation" autocomplete="password"
                                            required>

                                        <div class="input-group-text showRegisterPassword">
                                            <i class="bi bi-eye"></i>
                                        </div>
                                    </div>
                                </div>
                                

                            </div>
                        </div>

                        <div id="corporateFeedback"></div>

                        <div class="card-footer bg-white d-flex align-items-center justify-content-between p-2">
                            <a class="underline text-sm text-red-600 dark:text-red-400 hover:text-red-900 dark:hover:text-red-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-red-800"
                                href="{{ route('login') }}">
                                {{ __('Already registered?') }}
                            </a>

                            <button type="submit" class="btn btn-primary btn-md" id="institutionSubmit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection

@section('footer_scripts')
    <script src="{{ asset('js/iziToast.min.js') }}"></script>
    <script src="{{ asset('js/college.js') }}"></script>
@endsection
