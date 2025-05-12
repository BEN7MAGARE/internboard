@extends('layouts.main')

@section('title')
    Sign in @parent
@endsection

@section('content')
<main class="main">
    <hr>
    <hr>
    <hr>
    <section class="w3l-main-content">
        <div class="container d-flex justify-content-center align-items-center">
            <div class="col-md-6">
                <div class="card mt-5 mb-5 radius-image p-4">

                    <div class="card-header bg-white text-center">
                        <h4 class="mb-2"><strong>Sign In</strong></h4>
                    </div>

                    <form action="{{ route('login') }}" method="post">

                        @csrf
                        <div class="card-body">

                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <label for="email">Email</label>
                                    <input type="email"
                                        class="form-control form-control-lg @error('email') invalid-input:'' @enderror"
                                        name="email" id="email" required>
                                    @error('email')
                                        <div class="invalid-feedback">
                                            <p class="text-danger">{{ $message }}</p>
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-md-12 form-group">
                                    <label for="password">Password</label>
                                    <div class="input-group">
                                        <input type="password"
                                            class="form-control form-control-lg @error('password') invalid-input:'' @enderror"
                                            name="password" id="password" autocomplete="password" required>

                                        <div class="input-group-text" id="showLoginPassword">
                                            <i class="bi bi-eye"></i>
                                        </div>
                                    </div>
                                    @error('password')
                                        <div class="invalid-feedback">
                                            <p class="text-danger">{{ $message }}</p>
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group mt-2">
                                    <label for="remember_me" class="inline-flex items-center">
                                        <input id="remember_me" type="checkbox"
                                            class="rounded dark:bg-gray-900 border-red-300 dark:border-red-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800"
                                            name="remember">
                                        <span
                                            class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="error-list">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="card-footer bg-white d-flex align-items-center justify-content-between p-2">
                            <button type="submit" class="btn btn-primary w-100">Login</button>
                        </div>
                    </form>
                    <hr>
                    <div class="row p-2">
                        <div class="col-md-6">
                            <p>No Account? <a href="{{ route('getstarted') }}">Get Started</a></p>
                        </div>
                        <div class="col-md-6">
                            @if (Route::has('password.request'))
                                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-red-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                                    href="{{ route('password.request') }}">
                                    {{ __('Forgot your password?') }}
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection

@section('footer_scripts')
<script src="{{ asset('js/iziToast.min.js') }}"></script>
    <script>
        (function() {
            const showLoginPassword = $('#showLoginPassword');

            showLoginPassword.on("click", function() {
                if ($('#password').attr("type") == "password") {
                    $('#password').attr("type", "text");
                    showLoginPassword.html('<i class="bi bi-eye-slash"></i>');
                } else {
                    $('#password').attr("type", "password");
                    showLoginPassword.html('<i class="bi bi-eye"></i>');
                }
            });
        })()
    </script>
@endsection
