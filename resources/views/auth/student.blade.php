@extends('layouts.app')

@section('title')
    Sign up as student @parent
@endsection


@section('content')
    <main>
        <div class="container d-flex justify-content-center align-items-center">
            <div class="col-md-7">
                <div class="card mt-5 mb-5">

                    <div class="card-header bg-white text-center">
                        <h4 class="mt-2 mb-2"><strong>Join as student</strong></h4>
                    </div>
                    <br>

                    <form action="{{ route('register') }}" method="post" id="studentSignupForm">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="firstName">First name</label>
                                    <input type="text" class="form-control form-control-lg" name="first_name"
                                        id="firstName" required>
                                </div>

                                <input type="hidden" name="role" value="{{ $role }}" id="userRole">

                                <div class="col-md-6 form-group">
                                    <label for="lastName">Last name</label>
                                    <input type="text" class="form-control form-control-lg" name="last_name"
                                        id="lastName" required>
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control form-control-lg" name="email" id="email"
                                        required>
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for="phone">Phone</label>
                                    <input type="text" class="form-control form-control-lg" name="phone" id="phone"
                                        required>
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control form-control-lg" name="password"
                                        id="password" required>
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for="passwordConfirmation">Confirm Password</label>
                                    <input type="password" class="form-control form-control-lg" name="password_confimation"
                                        id="passwordConfirmation" required>
                                </div>

                            </div>
                        </div>
                        <div id="studentfeedbackfeedback"></div>
                        <div class="card-footer bg-white d-flex align-items-center justify-content-between p-2">
                            <a class="underline text-sm text-red-600 dark:text-red-400 hover:text-red-900 dark:hover:text-red-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-red-800"
                                href="{{ route('login') }}">
                                {{ __('Already registered?') }}
                            </a>

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('footer_scripts')
    <script src="{{ asset('assets/js/auth.js') }}"></script>
@endsection
