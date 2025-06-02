@extends('layouts.main')

@section('title')
    Reset Password @parent
@endsection

@section('header_styles')
@endsection

@section('content')
    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div>
            <label for="email" class="form-label">Email</label>
            <input id="email" class="form-control" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
            <span class="text-danger">{{ $errors->get('email') }}</span>
        </div>

        <!-- Password -->
        <div class="mt-4">
            <label for="password" class="form-label">Password</label>
            <input id="password" class="form-control" type="password" name="password" required autocomplete="new-password" />
            <span class="text-danger">{{ $errors->get('password') }}</span>
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <label for="password_confirmation" class="form-label">Confirm Password</label>
            <input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required autocomplete="new-password" />

            <span class="text-danger">{{ $errors->get('password_confirmation') }}</span>
        </div>

        <div class="flex items-center justify-end mt-4">
            <button type="submit" class="btn btn-primary">
                {{ __('Reset Password') }}
            </button>
        </div>
    </form>
@endsection
