@extends('layouts.main')

@section('title')
    Sign up as student @parent
@endsection

@section('content')
    <section class="w3l-main-content">
        <div class="container d-flex justify-content-center align-items-center">

            <div class="col-md-7">
                <div class="card mt-5 mb-5">

                    <div class="card-header bg-white text-center">
                        <img src="{{ asset('assets/img/logo.png') }}" alt="" height="80px">
                        <h4 class="mt-2 mb-2"><strong>Create Account</strong></h4>
                    </div>
                    <form action="{{ route('register') }}" method="post" id="studentSignupForm">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                {{-- <div class="col-md-12 form-group">
                                    <label for="college_id">College</label>
                                    <select name="college_id" id="college_id" class="form-select form-select-lg" required>
                                        <option value="">Select One</option>
                                        @foreach ($colleges as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div> --}}

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
                                    <div class="input-group">
                                        <input type="password"
                                            class="form-control @error('password') invalid-input:'' @enderror"
                                            name="password" id="password" autocomplete="password" required>

                                        <div class="input-group-text showRegisterPassword">
                                            <i class="fa fa-eye"></i>
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
                                            <i class="fa fa-eye"></i>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div id="studentfeedbackfeedback"></div>

                        <div class="card-footer bg-white d-flex align-items-center justify-content-between p-2">
                            <a class="underline text-sm text-red-600 dark:text-red-400 hover:text-red-900 dark:hover:text-red-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-red-800"
                                href="{{ route('login') }}">
                                {{ __('Already registered?') }}
                            </a>

                            <button type="submit" class="btn btn-primary" id="studentSubmit">Submit</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>

    </section>
@endsection

@section('footer_scripts')
    <script src="{{ asset('js/auth.js') }}"></script>
@endsection
