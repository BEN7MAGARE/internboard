@extends('layouts.app')

@section('title')
    Sign in @parent
@endsection

@section('content')
    <main>
        <div class="container d-flex justify-content-center align-items-center">
            <div class="col-md-5">
                <div class="card mt-5 mb-5">

                    <div class="card-header bg-white text-center">
                        <img src="{{ asset('assets/img/logo.png') }}" alt="" height="80px">
                        <h4 class="mt-2 mb-2"><strong>Sign In</strong></h4>
                    </div>

                    <form action="{{ route('login') }}" method="post">

                        @csrf
                        <div class="card-body">

                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control form-control-lg" name="email" id="email"
                                        required>
                                </div>

                                <div class="col-md-12 form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control form-control-lg" name="password"
                                        id="password" autocomplete="password" required>
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

                        <div class="card-footer bg-white d-flex align-items-center justify-content-between p-2">
                            <button type="submit" class="btn btn-primary w-100">Login</button>
                        </div>
                    </form>
                    <hr>
                    <div class="d-flex justify-content-between p-2">
                        <p>Do not have Account? <a href="{{ route('getstarted') }}">Get Started</a></p>
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
    </main>
@endsection
