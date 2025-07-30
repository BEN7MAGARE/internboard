@extends('layouts.main')

@section('title', 'Get Started')

@section('header_styles')
<link rel="stylesheet" href="{{ asset('css/iziToast.min.css') }}">
<style>
    .auth-container {
        min-height: 100vh;
        background-color: #f8f9fa;
    }
    .auth-card {
        border: none;
        border-radius: 12px;
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.05);
        overflow: hidden;
    }
    .auth-header {
        background: linear-gradient(135deg, #667eea 0%, #2596be 100%);
        color: white;
        padding: 2rem;
        text-align: center;
    }
    .role-option {
        border-radius: 12px;
        padding: 1.5rem;
        margin-bottom: 1rem;
        transition: all 0.3s ease;
        border: 2px solid transparent;
        cursor: pointer;
        background-color: white;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }
    .role-option:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        border-color: #667eea;
    }
    .role-option.active {
        border-color: #667eea;
        background-color: #f8f9ff;
    }
    .role-option input[type="radio"] {
        position: absolute;
        opacity: 0;
    }
    .role-title {
        font-weight: 600;
        color: #2d3748;
        margin-bottom: 0.5rem;
    }
    .role-description {
        color: #718096;
        font-size: 0.9rem;
    }
    .role-icon {
        font-size: 2rem;
        margin-bottom: 1rem;
        color: #667eea;
    }
    .auth-image {
        border-radius: 12px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        height: 100%;
        object-fit: cover;
    }
    .btn-auth {
        background: linear-gradient(135deg, #667eea 0%, #2596be 100%);
        border: none;
        padding: 0.75rem 2rem;
        font-weight: 600;
        letter-spacing: 0.5px;
    }
    .btn-auth:hover {
        opacity: 0.9;
        transform: translateY(-2px);
    }
    .btn-outline-auth {
        border: 1px solid #f16915;
        color: #f16915;
    }
    .btn-outline-auth:hover {
        background-color: #f8f9ff;
    }
    .auth-footer {
        text-align: center;
        padding-top: 1.5rem;
        border-top: 1px solid #e2e8f0;
        margin-top: 1.5rem;
    }
</style>
@endsection

@section('content')
<main class="auth-container py-5 mt-5">
    <div class="container mt-5">
        <div class="row justify-content-center align-items-center">
            <div class="col-lg-10">
                <div class="row g-5">
                    <div class="col-md-7">
                        <div class="auth-card">
                            <div class="auth-header">
                                <h3 class="mb-3 text-white">Create Your Account</h3>
                                <p class="mb-0">Select your account type to get started</p>
                            </div>

                            <div class="card-body p-4 p-md-5">
                                <form action="#" id="getStartedForm">
                                    <div class="mb-4">
                                        <div class="role-option" onclick="selectRole('corporate')">
                                            <div class="d-flex align-items-start">
                                                <div class="me-3">
                                                    <input class="form-check-input" type="radio" name="userroleselection"
                                                        id="corporateSelectionRadio" required value="corporate">
                                                    <div class="role-icon">
                                                        <i class="bi bi-building"></i>
                                                    </div>
                                                </div>
                                                <div>
                                                    <label class="role-title" for="corporateSelectionRadio">
                                                        Join as Employer
                                                    </label>
                                                    <p class="role-description mb-0">
                                                        Looking to hire or employ the best talent for your organization.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="role-option" onclick="selectRole('college')">
                                            <div class="d-flex align-items-start">
                                                <div class="me-3">
                                                    <input class="form-check-input" type="radio" name="userroleselection"
                                                        id="collegeSelectionRadio" required value="college">
                                                    <div class="role-icon">
                                                        <i class="bi bi-mortarboard"></i>
                                                    </div>
                                                </div>
                                                <div>
                                                    <label class="role-title" for="collegeSelectionRadio">
                                                        Join as College/University
                                                    </label>
                                                    <p class="role-description mb-0">
                                                        Looking to get notified of opportunities when they arise for your students.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-between mt-4">
                                        <a href="{{ url('/') }}" class="btn btn-outline-auth">
                                            <i class="bi bi-arrow-left me-2"></i> Back to Home
                                        </a>
                                        <button type="submit" class="btn btn-auth text-white">
                                            Continue <i class="bi bi-arrow-right ms-2"></i>
                                        </button>
                                    </div>
                                </form>

                                <div class="auth-footer">
                                    <p class="mb-0">
                                        Already have an account?
                                        <a href="{{ route('login') }}" class="text-primary fw-bold">Sign In</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-5 d-none d-md-block">
                        <img src="{{ asset('images/opportunities.jpg') }}" alt="Career opportunities"
                            class="auth-image w-100">
                        <div class="mt-4 text-center">
                            <h5 class="fw-bold">Find Your Perfect Match</h5>
                            <p class="text-muted">
                                Whether you're hiring or seeking opportunities, we connect talent with opportunity.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@section('footer_scripts')
<script src="{{ asset('js/iziToast.min.js') }}"></script>
<script src="{{ asset('js/auth.js') }}"></script>
<script>
    function selectRole(role) {
        // Remove active class from all options
        document.querySelectorAll('.role-option').forEach(option => {
            option.classList.remove('active');
        });

        // Add active class to selected option
        const selectedOption = document.querySelector(`#${role}SelectionRadio`).closest('.role-option');
        selectedOption.classList.add('active');

        // Check the radio button
        document.getElementById(`${role}SelectionRadio`).checked = true;
    }

    document.addEventListener('DOMContentLoaded', function() {
        // Initialize form validation
        const form = document.getElementById('getStartedForm');

        // form.addEventListener('submit', function(e) {
        //     e.preventDefault();

        //     const selectedRole = document.querySelector('input[name="userroleselection"]:checked');

        //     if (!selectedRole) {
        //         iziToast.warning({
        //             title: 'Selection Required',
        //             message: 'Please select an account type to continue',
        //             position: 'topRight'
        //         });
        //         return;
        //     }

        //     // Here you would normally submit the form or redirect
        //     // For now, we'll just show a success message
        //     iziToast.success({
        //         title: 'Account Type Selected',
        //         message: `You've selected to join as ${selectedRole.value === 'corporate' ? 'an Employer' : 'a College/University'}`,
        //         position: 'topRight'
        //     });

        //     // In a real implementation, you would redirect to the appropriate registration page:
        //     window.location.href = `/register?type=${selectedRole.value}`;
        // });

        // Add click effect to role options
        document.querySelectorAll('.role-option').forEach(option => {
            option.addEventListener('click', function() {
                const radioId = this.querySelector('input[type="radio"]').id;
                selectRole(radioId.replace('SelectionRadio', ''));
            });
        });
    });
</script>
@endsection
