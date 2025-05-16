@extends('layouts.main')

@section('title')
    Sign up @parent
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
                    <div class="card mt-5 mb-5 radius-image p-2">

                        <div class="card-header bg-white text-center">
                            <h4 class="mb-2"><strong>Sign up</strong></h4>
                        </div>

                        <form action="{{ route('account.store') }}" method="post" id="signupForm">
                            @csrf
                            <div class="card-body">
                                <div class="row">

                                    <div class="col-md-6 form-group">
                                        <label for="firstName">First name</label>
                                        <input type="text"
                                            class="form-control @error('first_name') invalid-input:'' @enderror"
                                            name="first_name" id="firstName" required>
                                        @error('first_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <input type="hidden" name="role" value="{{ $role }}" id="userRole">

                                    <div class="col-md-6 form-group">
                                        <label for="lastName">Last name</label>
                                        <input type="text"
                                            class="form-control @error('last_name') invalid-input:'' @enderror"
                                            name="last_name" id="lastName" required>
                                        @error('last_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label for="email">Email</label>
                                        <input type="email"
                                            class="form-control @error('email') invalid-input:'' @enderror" name="email"
                                            id="email" required>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label for="phone">Phone</label>
                                        <input type="text"
                                            class="form-control @error('phone') invalid-input:'' @enderror" name="phone"
                                            id="phone" required>
                                        @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
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
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label for="passwordConfirmation">Confirm Password</label>
                                        <div class="input-group">
                                            <input type="password"
                                                class="form-control @error('password') invalid-input:'' @enderror"
                                                name="password_confimation" id="passwordConfirmation"
                                                autocomplete="password" required>
                                            <div class="input-group-text showRegisterPassword">
                                                <i class="bi bi-eye"></i>
                                            </div>
                                        </div>
                                        @error('password_confimation')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                </div>
                            </div>

                            <div id="userFeedback"></div>

                            <div class="card-footer bg-white d-flex align-items-center justify-content-between p-2">
                                <p>Already have an account?
                                    <a class="underline text-sm text-red-600 dark:text-red-400 hover:text-red-900 dark:hover:text-red-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-red-800"
                                        href="{{ route('login') }}">
                                        {{ __('Login') }}
                                    </a>
                                </p>

                                <button type="submit" class="btn btn-primary btn-md" id="userSubmit"><i
                                        class="fa fa-server"></i> Submit </button>
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
    <script src="{{ asset('js/functions.js') }}"></script>
    <script src="{{ asset('js/auth.js') }}"></script>
@endsection
