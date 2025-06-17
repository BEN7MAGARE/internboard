@extends('layouts.main')

@section('title')
    Confirm Password @parent
@endsection

@section('header_styles')
@endsection

@section('content')
<div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
    {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
</div>

<form method="POST" action="{{ route('password.confirm') }}">
    @csrf

    <!-- Password -->
    <div>
        <label for="password" class="form-label translatable">Password</label>

        <input id="password" class="form-control" type="password" name="password" required
            autocomplete="current-password" />

        <span class="text-danger translatable">{{ $errors->get('password') }}</span>
    </div>

    <div class="flex justify-end mt-4">
        <button type="submit" class="btn btn-primary translatable">
            {{ __('Confirm') }}
        </button>
    </div>
</form>
@endsection
