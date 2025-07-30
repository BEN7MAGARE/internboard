@extends('layouts.main')

@section('title', 'Sign in')

@section('header_styles')
<link rel="stylesheet" href="{{ asset('css/iziToast.min.css') }}">
<style>
    .login-card {
        max-width: 450px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        border: none;
        border-radius: 12px;
    }
    .login-header {
        background: linear-gradient(135deg, #667eea 0%, #667eea 100%);
        color: white;
        border-radius: 12px 12px 0 0 !important;
    }
    .password-toggle {
        cursor: pointer;
        transition: all 0.3s;
    }
    .password-toggle:hover {
        background-color: #f8f9fa;
    }
    .auth-links a {
        color: #667eea;
        text-decoration: none;
        transition: color 0.3s;
    }
    .auth-links a:hover {
        color: #667eea;
    }
    .btn-login {
        background: linear-gradient(135deg, #667eea 0%, #667eea 100%);
        border: none;
        padding: 10px 0;
        font-weight: 600;
        transition: all 0.3s;
    }
    .btn-login:hover {
        opacity: 0.9;
        transform: translateY(-2px);
    }
</style>
@endsection

@section('content')
<main class="main bg-light">
    <div class="container py-5 mt-5">
        <div class="row justify-content-center mt-5">
            <div class="col-md-8 col-lg-6">
                <div class="card login-card">
                    <div class="card-header login-header text-center py-4">
                        <h4 class="mb-0 text-white"><strong>Sign In to Your Account</strong></h4>
                    </div>

                    <form action="{{ route('login') }}" method="post" class="needs-validation" novalidate>
                        @csrf
                        <div class="card-body p-4">

                            @if(session('status'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('status') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif

                            @if(session('error'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ session('error') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif

                            @if(session('message'))
                                <div class="alert alert-info alert-dismissible fade show" role="alert">
                                    {{ session('message') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif

                            <div class="mb-3">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                       name="email" id="email" value="{{ old('email') }}" required autofocus>
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <div class="input-group">
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                           name="password" id="password" required>
                                    <button class="btn btn-outline-secondary password-toggle" type="button" id="showLoginPassword">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                </div>
                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="remember_me" name="remember">
                                <label class="form-check-label" for="remember_me">Remember me</label>
                            </div>

                            <div class="d-grid mb-3">
                                <button type="submit" class="btn btn-login btn-primary">Sign In</button>
                            </div>

                            <div class="text-center mb-3">
                                <a href="{{ route('password.request') }}" class="text-decoration-none">Forgot password?</a>
                            </div>

                            <div class="text-center auth-links">
                                <p class="mb-0">Don't have an account? <a href="{{ route('getstarted') }}">Create one</a></p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@section('footer_scripts')
<script src="{{ asset('js/iziToast.min.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Password toggle functionality
        const showLoginPassword = document.getElementById('showLoginPassword');
        const passwordInput = document.getElementById('password');

        showLoginPassword.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);

            const icon = showLoginPassword.querySelector('i');
            icon.classList.toggle('bi-eye');
            icon.classList.toggle('bi-eye-slash');
        });

        // Show session expiration message if redirected
        @if(session()->has('session_expired'))
            iziToast.warning({
                title: 'Session Expired',
                message: 'Your session has expired. Please login again.',
                position: 'topRight'
            });
        @endif

        // Form validation
        const forms = document.querySelectorAll('.needs-validation');
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    });
</script>
@endsection
