@extends('layouts.dashboard')

@section('title')
    College @parent
@endsection

@section('header_styles')
    <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
    <style>
        a {
            text-decoration: none;
        }
    </style>
@endsection

@section('subtitle')
    College
@endsection

@section('content')
    <main class="">
        <section class="content">
            <div class="row">
                <div class="col-md-3">
                    <a href="{{ route('college.students') }}">
                        <div class="card stat-card">
                            <div class="stat-number">
                                {{ $studentscount }}
                            </div>
                            <div class="stat-label">Students</div>
                        </div>
                    </a>
                </div>


                <div class="col-md-3">
                    <a href="{{ route('college.applications') }}">
                        <div class="card stat-card" style="border-left-color: var(--success-color);">
                            <div class="stat-number" style="color: var(--success-color);">
                                {{ $applicationscount }}
                            </div>
                            <div class="stat-label">Applications</div>
                        </div>
                    </a>
                </div>

                <div class="col-md-3">
                    <a href="{{ route('college.applicants', 'selected') }}">
                        <div class="card stat-card" style="border-left-color: var(--accent-color);">
                            <div class="stat-number" style="color: var(--accent-color);">
                                {{ $selectedcount }}
                            </div>
                            <div class="stat-label">Selected Applications</div>
                        </div>
                    </a>
                </div>


                <div class="col-md-3">
                    <a href="{{ route('college.applications', 'hired') }}">
                        <div class="card stat-card" style="border-left-color: var(--accent-color);">
                            <div class="stat-number" style="color: var(--accent-color);">
                                {{ $hiredcount }}
                            </div>
                            <div class="stat-label">Hired Students</div>
                        </div>
                    </a>
                </div>

            </div>

            <div class="card mt-2">
                <div class="card-header d-flex justify-content-between">
                    <h5>Profile</h5>
                    <a href="#" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                        data-bs-target="#changePasswordModal"><i class="bi bi-lock"></i>Change Password</a>
                </div>
                <div class="card-body pt-3">

                    <div class="corporate-section mb-2">
                        <div class="row">

                            <div class="col-md-7">
                                <div class="d-flex justify-content-between">
                                    <h5>College Details</h5>
                                    <a href="{{ route('colleges.create') }}" class="btn btn-primary btn-sm"><i
                                            class="bi bi-pencil-square"></i>
                                        Edit</a>
                                </div>

                                <div class="corporate">
                                    <div class="col-md-8">
                                        <p class="mb-1"><strong>Name:</strong>
                                            {{ auth()->user()->college->name }}</p>
                                        <p class="mb-1"><strong>Email:</strong>
                                            {{ auth()->user()->college->email }}
                                        </p>
                                        <p class="mb-1"><strong>Address:</strong>
                                            {{ auth()->user()->college->address }}</p>
                                        <p class="mb-1"><strong>Phone:</strong>
                                            {{ auth()->user()->college->phone }}
                                        </p>
                                        <p class="mb-1"><strong>Size:</strong>
                                            {{ auth()->user()->college->size }}
                                        </p>
                                        <p class="mb-1"><strong>Mission/Vision:</strong>
                                            {{ auth()->user()->college->mission_vision }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-5">

                                <div class="d-flex justify-content-between">
                                    <h5>User Details</h5>
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#updateProfileModal"
                                        class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i> Edit</a>
                                </div>

                                <div class="user text-center">
                                    @if (auth()->user()->image !== null)
                                        <img src="{{ asset('profilepictures/' . auth()->user()->image) }}"
                                            alt="{{ auth()->user()->first_name . ' ' . auth()->user()->middle_name . ' ' . auth()->user()->last_name }}"
                                            class="img-fluid" style="width: 150px; height: 150px; border-radius: 50%;">
                                    @endif
                                    <p class="mb-1"><strong>Name:</strong>
                                        {{ auth()->user()->title . ' ' . auth()->user()->first_name . ' ' . auth()->user()->middle_name . ' ' . auth()->user()->last_name }}
                                    </p>
                                    <p class="mb-1"><strong>Gender:</strong> {{ auth()->user()->gender }}</p>
                                    <p class="mb-1"><strong>Email:</strong> {{ auth()->user()->email }}</p>
                                    <p class="mb-1"><strong>Address:</strong> {{ auth()->user()->address }}</p>
                                    <p class="mb-1"><strong>Phone:</strong> {{ auth()->user()->phone }}</p>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </section>


    </main>


    <div class="modal fade" id="changePasswordModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Change Password</h1>
                    <button type="button" class="btn-close btn text-danger" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('password.change') }}" method="post">
                        @csrf
                        <div class="form-group row mb-1">
                            <label for="password" class="col-md-4">New Password</label>
                            <input name="password" type="password" class="form-control" id="password" autocomplete="">
                        </div>

                        <div class="form-group mt-2">
                            <label for="passwordConfirmation" class="col-md-4">Confirm Password</label>
                            <input name="password_confirmation" type="password" class="form-control"
                                id="passwordConfirmation" autocomplete="">
                        </div>

                        <div class="text-center mt-2">
                            <button type="submit" class="btn btn-primary">Change Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="updateProfileModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        role="dialog" aria-labelledby="financeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Update information</h1>

                    <button type="button" class="btn-close btn btn-danger" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <form action="{{ route('profile.update', auth()->id()) }}" method="POST"
                        enctype="multipart/form-data" id="userUpdateForm">
                        @csrf
                        <input type="hidden" name="user_id" id="userId" value="{{ auth()->id() }}">
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <label>Title</label>
                                <select name="title" id="title" class="form-select">
                                    <option value="">Select Title</option>
                                    <option value="Mr." {{ $user->title == 'Mr.' ? 'selected' : '' }}>Mr.</option>
                                    <option value="Mrs." {{ $user->title == 'Mrs.' ? 'selected' : '' }}>Mrs.</option>
                                    <option value="Ms." {{ $user->title == 'Ms.' ? 'selected' : '' }}>Ms.</option>
                                    <option value="Dr." {{ $user->title == 'Dr.' ? 'selected' : '' }}>Dr.</option>
                                    <option value="Prof." {{ $user->title == 'Prof.' ? 'selected' : '' }}>Prof.</option>
                                    <option value="Pst." {{ $user->title == 'Pst.' ? 'selected' : '' }}>Pst.</option>
                                </select>
                            </div>

                            <div class="col-md-6 mb-2">
                                <label>First Name *</label>
                                <input value="{{ $user->first_name }}" type="text" name="first_name"
                                    class="form-control" id="firstName">
                            </div>

                            <div class="col-md-6 mb-2">
                                <label>Middle Name *</label>
                                <input value="{{ $user->middle_name }}" type="text" name="middle_name"
                                    class="form-control" id="middleName">
                            </div>

                            <div class="col-md-6 mb-2">
                                <label>Last Name *</label>
                                <input value="{{ $user->last_name }}" type="text" name="last_name"
                                    class="form-control" id="lastName">
                            </div>

                            <div class="col-md-6 mb-2">
                                <label>Gender</label>
                                <select name="gender" id="gender" class="form-select">
                                    <option value="">Select Gender</option>
                                    <option value="Male" {{ $user->gender == 'Male' ? 'selected' : '' }}>Male</option>
                                    <option value="Female" {{ $user->gender == 'Female' ? 'selected' : '' }}>Female
                                    </option>
                                </select>
                            </div>

                            <div class="col-md-6 mb-2">
                                <label>Phone *</label>
                                <input value="{{ $user->phone }}" type="text" name="phone" class="form-control"
                                    id="userphone">
                            </div>

                            <div class="col-md-6 mb-2">
                                <label>Email *</label>
                                <input value="{{ $user->email }}" type="email" name="email" class="form-control"
                                    id="useremail">
                            </div>

                            <div class="col-md-6 mb-2">
                                <label>Address *</label>
                                <input value="{{ $user->address }}" type="text" name="address" class="form-control"
                                    id="userAddress">
                            </div>

                            <div class="col-md-6 mb-2">
                                <label>Profile Photo / Logo </label><br>
                                <div class="input-group">
                                    <input type="file" class="form-control" name="profile" id="userProfilePhoto">
                                </div>
                            </div>
                        </div>

                        <div id="userProfileFeedback"></div>

                        <div class="form-group text-end">
                            <button class='btn btn-primary btn-md' type="submit"><i class="bi bi-save"></i>
                                Save
                            </button>
                            <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('footer_scripts')
    <script src="{{ asset('js/select2.min.js') }}"></script>
    <script src="{{ asset('js/functions.js') }}"></script>
    <script src="{{ asset('js/profile.js') }}"></script>

@endsection
