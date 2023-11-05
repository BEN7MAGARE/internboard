@extends('layouts.app')

@section('title')
    Profile @parent
@endsection

@section('header_styles')
    <link rel="stylesheet" href="{{ asset('assets/css/profile.css') }}">
@endsection

@section('content')
    <section class="section profile" style="background:#EAFAF1;">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 mb-4">

                    <div class="card">

                        <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                            <img src="assets/img/avatar.png" alt="Profile" class="rounded-circle">
                            <h2>{{ !is_null(auth()->user()->title) ? auth()->user()->title . '. ' : ' ' . auth()->user()->first_name . ' ' . auth()->user()->last_name }}
                            </h2>

                            <h3>{{ auth()->user()->profile?->specialization }}</h3>

                            <div class="social-links mt-2">
                                <a href="{{ auth()->user()->twitter }}" class="twitter text-primary"><i class="bi bi-twitter"></i></a>
                                <a href="{{ auth()->user()->facebook }}" class="facebook text-primary"><i class="bi bi-facebook"></i></a>
                                <a href="{{ auth()->user()->instagram }}" class="instagram text-primary"><i
                                        class="bi bi-instagram"></i></a>
                                <a href="{{ auth()->user()->linkedin }}" class="linkedin text-primary"><i class="bi bi-linkedin"></i></a>
                            </div>
                        </div>

                        <div class="card-footer bg-white">
                            <div class="list-group">
                                <a href="{{ route('profile.edit') }}" class="list-group-item list-group-item-action active" aria-current="true">My Profile</a>
                                <a href="#" class="list-group-item list-group-item-action">My Applications</a>
                                <a href="#" class="list-group-item list-group-item-action">My Jobs</a>
                                <a href="#" class="list-group-item list-group-item-action"><i class="fa fa-sign-out text-warning"></i> Logout</a>
                                
                            </div>
                        </div>

                    </div>

                </div>

                <div class="col-xl-9">

                    <div class="card">
                        <div class="card-body pt-3">
                            <ul class="nav nav-tabs nav-tabs-bordered">
                                <li class="nav-item">
                                    <button class="nav-link active" data-bs-toggle="tab"
                                        data-bs-target="#profile-overview">Overview</button>
                                </li>
                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab"
                                        data-bs-target="#profile-settings">Settings</button>
                                </li>
                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab"
                                        data-bs-target="#profile-change-password">Change
                                        Password</button>
                                </li>
                            </ul>

                            <div class="tab-content pt-2">

                                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                    <h5 class="card-title">Summary</h5>
                                    <p class="small fst-italic">{{ auth()->user()->profile?->summary }}</p>

                                    <h5 class="card-title">Profile Details</h5>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label ">Full Name</div>
                                        <div class="col-lg-9 col-md-8">
                                            {{ auth()->user()->title . '. ' . auth()->user()->first_name . ' ' . auth()->user()->last_name }}
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Job</div>
                                        <div class="col-lg-9 col-md-8">{{ auth()->user()->profile?->specialization }}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Address</div>
                                        <div class="col-lg-9 col-md-8">{{ auth()->user()->address }}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Phone</div>
                                        <div class="col-lg-9 col-md-8">{{ auth()->user()->phone }}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Email</div>
                                        <div class="col-lg-9 col-md-8">{{ auth()->user()->email }}</div>
                                    </div>

                                    <div class="mt-2 text-center">
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#updateProdileDetailsModal"
                                            class="btn btn-primary">Update Details</a>
                                    </div>
                                </div>

                                <div class="tab-pane fade pt-3" id="profile-settings">

                                    <!-- Settings Form -->
                                    <form>

                                        <div class="row mb-3">
                                            <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Email
                                                Notifications</label>
                                            <div class="col-md-8 col-lg-9">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="changesMade"
                                                        checked>
                                                    <label class="form-check-label" for="changesMade">
                                                        Changes made to your account
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="newProducts"
                                                        checked>
                                                    <label class="form-check-label" for="newProducts">
                                                        Information on new products and services
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="proOffers">
                                                    <label class="form-check-label" for="proOffers">
                                                        Marketing and promo offers
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="securityNotify"
                                                        checked disabled>
                                                    <label class="form-check-label" for="securityNotify">
                                                        Security alerts
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary">Save Changes</button>
                                        </div>
                                    </form>

                                </div>

                                <div class="tab-pane fade pt-3" id="profile-change-password">
                                    <form>

                                        <div class="row mb-3">
                                            <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current
                                                Password</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="password" type="password" class="form-control"
                                                    id="currentPassword">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New
                                                Password</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="newpassword" type="password" class="form-control"
                                                    id="newPassword">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter
                                                New
                                                Password</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="renewpassword" type="password" class="form-control"
                                                    id="renewPassword">
                                            </div>
                                        </div>

                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary">Change Password</button>
                                        </div>
                                    </form>

                                </div>

                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="updateProdileDetailsModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('profile.update') }}" id="profileUpdateForm">

                    <div class="modal-body">
                        @csrf
                        <div class="row">

                            <div class="col-md-6    form-group mb-3">
                                <label for="profileImage">Profile
                                    Image</label>
                                <div class="input-group">
                                    <input type="file" name="profile" id="ProfileImage">
                                </div>
                            </div>

                            <div class="col-md-6 form-group mb-3">
                                <label for="title">
                                    Title</label>
                                <div class="input-group">
                                    <select name="title" class="form-select" id="title">
                                        <option value="">Select One</option>
                                        <option value="Miss">Miss</option>
                                        <option value="Mrs">Mrs</option>
                                        <option value="Mr">Mr</option>
                                        <option value="Dr">Dr</option>
                                        <option value="Pst">Pst</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6 form-group mb-3">
                                <label for="firstName">Full
                                    First Name</label>
                                <div class="input-group">
                                    <input name="first_name" type="text" class="form-control" id="firstName"
                                        value="{{ auth()->user()->last_name }}">
                                </div>
                            </div>

                            <div class="col-md-6 form-group mb-3">
                                <label for="lastName">Full
                                    Last Name</label>
                                <div class="input-group">
                                    <input name="last_name" type="text" class="form-control" id="lastName"
                                        value="{{ auth()->user()->last_name }}">
                                </div>
                            </div>

                            <div class="col-md-6 form-group mb-3">
                                <label for="company">Education
                                    Level</label>
                                <div class="input-group">
                                    <select class="form-select" name="education_level" id="educationLevel">
                                        <option value="">Select One</option>
                                        <option value="Highschool">Highschool</option>
                                        <option value="Certificate">Certificate</option>
                                        <option value="Diploma">Diploma</option>
                                        <option value="Higher Diploma">Higher Diploma</option>
                                        <option value="Degree">Degree</option>
                                        <option value="Masters">Masters</option>
                                        <option value="Doctorate">Doctorate</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6 form-group mb-3">
                                <label for="specialization">Specialization</label>
                                <div class="input-group">
                                    <input name="specialization" value="{{ auth()->user()->profile?->specialization }}"
                                        type="text" class="form-control" id="specialization"
                                        placeholder="eg Web Designer">
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <label for="course">Course</label>
                                <div class="input-group">
                                    <input name="course" type="text" class="form-control" id="course"
                                        value="{{ auth()->user()->profile?->course }}">
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <label for="summary">Proffessional
                                    Summary</label>
                                <div class="input-group">
                                    <textarea name="summary" value="{{ auth()->user()->profile?->summary }}" class="form-control" id="summary"
                                        style="height: 100px"></textarea>
                                </div>
                            </div>

                            <div class="col-md-6 form-group mb-3">
                                <label for="Address">Address</label>
                                <div class="input-group">
                                    <input name="address" type="text" class="form-control" id="Address"
                                        placeholder="{{ auth()->user()->address }}">
                                </div>
                            </div>

                            <div class="col-md-6 form-group mb-3">
                                <label for="Phone">Phone</label>
                                <div class="input-group">
                                    <input name="phone" type="text" class="form-control" id="Phone"
                                        value="{{ auth()->user()->phone }}">
                                </div>
                            </div>

                            <div class="col-md-6 form-group mb-3">
                                <label for="Email">Email</label>
                                <div class="input-group">
                                    <input name="email" type="email" class="form-control" id="Email"
                                        value="{{ auth()->user()->email }}">
                                </div>
                            </div>

                            <div class="col-md-6 form-group mb-3">
                                <label for="Twitter">Twitter
                                    Profile</label>
                                <div class="input-group">
                                    <input name="twitter" type="text" class="form-control" id="Twitter"
                                        value="{{ auth()->user()->twitter ?? 'https://twitter.com/#' }}">
                                </div>
                            </div>

                            <div class="col-md-6 form-group mb-3">
                                <label for="Facebook">Facebook
                                    Profile</label>
                                <div class="input-group">
                                    <input name="facebook" type="text" class="form-control" id="Facebook"
                                        value="{{ auth()->user()->facebook ?? 'https://facebook.com/#' }}">
                                </div>
                            </div>

                            <div class="col-md-6 form-group mb-3">
                                <label for="Instagram">Instagram
                                    Profile</label>
                                <div class="input-group">
                                    <input name="instagram" type="text" class="form-control" id="Instagram"
                                        value="{{ auth()->user()->instagram ?? 'https://instagram.com/#' }}">
                                </div>
                            </div>

                            <div class="col-md-6 form-group mb-3">
                                <label for="Linkedin">Linkedin
                                    Profile</label>
                                <div class="input-group">
                                    <input name="linkedin" type="text" class="form-control" id="Linkedin"
                                        value="{{ auth()->user()->linkedin ?? 'https://linkedin.com/#' }}">
                                </div>
                            </div>
                        </div>

                        <div id="profileUpdateFeedback"></div>

                    </div>
                    <div class="modal-footer">
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

    {{-- <div class="modal fade" id="updateProfileModal" tabindex="-1" role="dialog" aria-labelledby="financeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered" role="document">
            <div class="modal-content" id="vehiclePreviewSection">
                <div class="modal-header">
                    <div class="modal-title">
                        <h4 class="text-black">Profile Details</h4>
                    </div>
                    <button type="button" class="btn btn-warning" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form action="{{ route('profile.update', auth()->id()) }}" method="POST"
                        enctype="multipart/form-data" id="userupdateForm">
                        @csrf
                        <input type="hidden" name="user_id" id="userId" value="{{ auth()->id() }}">

                        <div class="form-group">
                            <label>First Name *</label>
                            <input value="{{ $user->first_name }}" type="text" name="first_name" class="form-control"
                                id="firstName">
                        </div>

                        <div class="form-group">
                            <label>Last Name *</label>
                            <input value="{{ $user->last_name }}" type="text" name="last_name" class="form-control"
                                id="lastName">
                        </div>

                        <div class="form-group">
                            <label>Phone *</label>
                            <input value="{{ $user->phone }}" type="text" name="phone" class="form-control"
                                id="userphone">
                        </div>

                        <div class="form-group">
                            <label>Email *</label>
                            <input value="{{ $user->email }}" type="text" name="email" class="form-control"
                                id="useremail">
                        </div>

                        <div class="form-group">
                            <label>Profile Photo </label><br>
                            <div class="input-group">
                                <input type="file" name="profile" id="profilePhoto">
                            </div>
                        </div>

                        <div class="form-group">
                            <button class='btn btn-success btn-md' type="submit" id='savedealer'><i
                                    class="fa fa-save fa-lg fa-fw"></i>
                                Save
                            </button>
                            <button class='btn btn-outline-warning btn-md' id='cleardealer'><i
                                    class="fa fa-broom fa-lg fa-fw"></i>
                                Clear Fields</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> --}}
@endsection
