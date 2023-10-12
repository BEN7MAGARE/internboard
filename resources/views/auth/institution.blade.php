@extends('layouts.app')

@section('title')
    College Sign up @parent
@endsection

@section('content')
    <main>
        <div class="container d-flex justify-content-center align-items-center">
            <div class="col-md-7">
                <div class="card mt-5 mb-5">

                    <div class="card-header bg-white text-center">
                        <img src="{{ asset('assets/img/tuk.png') }}" alt="" height="80px">
                        <h4 class="mt-2 mb-2"><strong>Join as University / College </strong></h4>
                    </div>

                    <form action="{{ route('register') }}" method="post" id="corporateSignupForm">
                    @csrf
                        <div class="card-body">
                            <h5><b>Institution Details</b></h5>
                            <hr>

                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="companyName">Institution Name</label>
                                    <input type="text" class="form-control " name="name"
                                        id="companyName" required>
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for="email">Institution Email</label>
                                    <input type="email" class="form-control " name="email" id="companyEmail"
                                        required>
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for="phone">Institution Phone</label>
                                    <input type="text" class="form-control " name="phone" id="companyPhone"
                                        required>
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for="address">Institution Address</label>
                                    <input type="text" class="form-control " name="address" id="companyAddress"
                                        required>
                                </div>
                            </div>

                            <hr>
                                <h5><b>Personal Details</b></h5>
                            <hr>

                            <div class="row">

                                <div class="col-md-6 form-group">
                                    <label for="firstName">First name</label>
                                    <input type="text" class="form-control " name="first_name"
                                        id="firstName" required>
                                </div>

                                <input type="hidden" name="role" value="{{ $role }}" id="userRole">

                                <div class="col-md-6 form-group">
                                    <label for="lastName">Last name</label>
                                    <input type="text" class="form-control " name="last_name"
                                        id="lastName" required>
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control " name="email" id="email"
                                        required>
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for="phone">Phone</label>
                                    <input type="text" class="form-control " name="phone" id="phone"
                                        required>
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control " name="password"
                                        id="password" required>
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for="passwordConfirmation">Confirm Password</label>
                                    <input type="password" class="form-control " name="password_confimation"
                                        id="passwordConfirmation" required>
                                </div>

                            </div>
                        </div>

                        <div id="corporateFeedback"></div>

                        <div class="card-footer bg-white d-flex align-items-center justify-content-between p-2">
                                <a class="underline text-sm text-red-600 dark:text-red-400 hover:text-red-900 dark:hover:text-red-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-red-800"
                                    href="{{ route('login') }}">
                                    {{ __('Already registered?') }}
                                </a>

                                <button type="submit" class="btn btn-primary btn-md">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('footer_scripts')
    <script src="{{ asset('assets/js/college.js') }}"></script>
@endsection
