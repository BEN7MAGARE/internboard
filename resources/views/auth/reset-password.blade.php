@extends('layouts.main')

@section('title')
    Reset Password @parent
@endsection

@section('header_styles')
@endsection

@section('content')
    <main class="main">
        <hr>
        <hr>
        <section class="w3l-main-content">
            <div class="container d-flex justify-content-center align-items-center">
                <div class="col-md-5">
                    <div class="card mt-5 mb-5">
                        <form method="POST" action="{{ route('password.store') }}" id="resetPasswordForm">
                            @csrf

                            <!-- Password Reset Token -->
                            <input type="hidden" name="token" value="{{ $request->route('token') }}">

                            <!-- Email Address -->
                            <div>
                                <label for="email" class="form-label">Email</label>
                                <input id="email" class="form-control @error('email') is-invalid @enderror" type="email" name="email"
                                    value="{{ old('email') }}" required autofocus autocomplete="username" />
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <!-- Password -->
                            <div class="mt-4">
                                <label for="password" class="form-label">Password</label>
                                <input id="password" class="form-control @error('password') is-invalid @enderror" type="password" name="password" required
                                    autocomplete="new-password" />
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <!-- Confirm Password -->
                            <div class="mt-4">
                                <label for="password_confirmation" class="form-label">Confirm Password</label>
                                <input id="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" type="password"
                                    name="password_confirmation" required autocomplete="new-password" />
                                @error('password_confirmation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="flex items-center justify-end mt-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Reset Password') }}
                                </button>
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
    <script src="{{ asset('js/auth.js') }}"></script>
@endsection