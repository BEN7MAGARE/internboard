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
                                            <input type="email"
                                                class="form-control form-control-lg @error('email') is-invalid @enderror"
                                                name="email" id="email" required>
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    @if (session('success'))
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            {{ session('success') }}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close"></button>
                                        </div>
                                    @endif
                                    
                                    @if ($errors->any())
                                        <div class="alert alert-danger alert-dismissible fade show">
                                            <ul class="list-disc pl-5">
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

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
