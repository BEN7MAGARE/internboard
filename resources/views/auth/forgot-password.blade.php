@extends('layouts.main')

@section('title')
Forgot Password @parent
@endsection
@section('header_styles')
<link rel="stylesheet" href="{{ asset('css/iziToast.min.css') }}">
@endsection

@section('content')
<main class="main">
    <hr>
    <hr>
    <section class="w3l-main-content">
        <div class="container d-flex justify-content-center align-items-center">
            <div class="col-md-5">
                <div class="card mt-5 mb-5">

                    <div class="card-header bg-white text-center">
                        <h4 class="mb-2">Send password reset link</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('password.email') }}" method="post">
                            @csrf
                            <div class="card-body">
                                <div class="row">

                                    <div class="col-md-12 form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control form-control-lg" name="email" id="email" required>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer bg-white d-flex align-items-center justify-content-end p-2">
                                <button type="submit" class="btn btn-primary btn-lg">Email Password Reset Link</button>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer bg-white">
                        <a href="{{ route('login') }}">Login</a>
                    </div>

                </div>
            </div>
        </div>
    </section>
</main>
@endsection
