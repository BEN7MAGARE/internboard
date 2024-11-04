@extends('layouts.app')

@section('title')
    Profile @parent
@endsection

@section('header_styles')
    <link rel="stylesheet" href="{{ asset('assets/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/profile.css') }}">
@endsection

@section('content')
    <section class="section profile" style="background:#EAFAF1;">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 mb-4">
                    @include('profile.partials.sidebarnav')
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
                                        data-bs-target="#profile-change-password">Change
                                        Password</button>
                                </li>
                            </ul>
                            @if (auth()->user()->role === 'student')
                                @php
                                    $jobs = json_decode(auth()->user()->profile?->work);
                                    $education = json_decode(auth()->user()->profile?->education);
                                @endphp
                            @endif

                            <div class="tab-content pt-2">

                                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                    <p class="small">{{ auth()->user()->profile?->summary }}</p>

                                    <h5 class="card-title">Profile Details</h5>
                                    <div class="row">
                                        <div class="mt-2">
                                            <table class="table table-hover">
                                                <tr>
                                                    <td><b>Full Name</b></td>
                                                    <td>{{ auth()->user()->first_name . ' ' . auth()->user()->last_name }}
                                                    </td>
                                                </tr>
                                                @if (auth()->user()->role === 'student')
                                                    <tr>
                                                        <td><b>Education</b></td>
                                                        @if (!is_null($education) && !empty($education))
                                                            <td>
                                                                {{ $education[0]?->level . ' in ' . $education[0]?->course }}
                                                            </td>
                                                        @else
                                                            <td></td>
                                                        @endif

                                                    </tr>
                                                    <tr>
                                                        <td><b>Specialization</b></td>
                                                        <td>
                                                            {{ auth()->user()->profile?->level . ' ' . auth()->user()->profile?->specialization . auth()->user()->profile?->years_of_experience }}
                                                        </td>
                                                    </tr>
                                                @endif
                                                <tr>
                                                    <td><b>Address</b></td>
                                                    <td>{{ auth()->user()->address }}</td>
                                                </tr>
                                                <tr>
                                                    <td><b>Phone</b></td>
                                                    <td>{{ auth()->user()->phone }}</td>
                                                </tr>
                                                <tr>
                                                    <td><b>Email</b></td>
                                                    <td>{{ auth()->user()->email }}</td>
                                                </tr>
                                            </table>
                                        </div>

                                        @if (auth()->user()->role === 'student')
                                            <div class="col-md-6">
                                                @if (!empty($jobs) && !is_null($jobs))
                                                    <h5 class="text-info">Work Experience</h5>
                                                    @foreach ($jobs as $job)
                                                        <div class="card alert alert-primary">
                                                            <div class="card-body">
                                                                <h5 class="card-title">{{ $job->title }}</h5>
                                                                <h6 class="card-subtitle mb-2 text-muted">
                                                                    {{ $job->company }}</h6>
                                                                <p class="card-text">
                                                                    <strong>Duration:</strong>
                                                                    {{ date('M Y', strtotime($job->start_date)) }} -
                                                                    {{ date('M Y', strtotime($job->end_date)) }}
                                                                </p>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                            <div class="col-md-6">
                                                @if (!empty($education) && !is_null($education))
                                                    <h5 class="text-info">Education Background</h5>
                                                    @foreach ($education as $item)
                                                        <div class="card alert alert-warning">
                                                            <div class="card-body">
                                                                <h5 class="card-title">
                                                                    {{ $item->level . ' in ' . $item->course }}</h5>
                                                                <h6 class="card-subtitle mb-2 text-muted">
                                                                    {{ $item->institution }}</h6>
                                                                <p class="card-text">
                                                                    <strong>Duration:</strong>
                                                                    {{ date('Y', strtotime($item->start_date)) }} -
                                                                    {{ date('Y', strtotime($item->end_date)) }}
                                                                </p>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>

                                        @endif

                                    </div>
                                    @if (auth()->user()->role === 'student')
                                        <div class="mt-2 text-center">
                                            <a href="#" data-bs-toggle="modal"
                                                data-bs-target="#updateProdileDetailsModal" class="btn btn-primary">Update
                                                Details</a>
                                        </div>
                                    @else
                                        <div class="mt-2 text-center">
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#updateProfileModal"
                                                class="btn btn-primary">Update
                                                Details</a>
                                        </div>
                                    @endif

                                </div>

                                <div class="tab-pane fade pt-3" id="profile-change-password">
                                    <form action="{{ route('password.change') }}" method="post">
                                        @csrf

                                        <div class="row mb-1">
                                            <label for="password" class="col-md-4">New Password</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="password" type="password" class="form-control" id="password"
                                                    autocomplete="">
                                            </div>
                                        </div>

                                        <div class="row mb-1">
                                            <label for="passwordConfirmation" class="col-md-4">Re-enter New Password</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="password_confirmation" type="password" class="form-control"
                                                    id="passwordConfirmation" autocomplete="">
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
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Update Profile Information</h1>
                    <button type="button" class="btn-close btn text-danger" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>

                <form action="{{ route('profile.update') }}" id="profileUpdateForm">

                    <div class="modal-body">
                        @csrf
                        <div class="row">

                            <div class="col-md-3 form-group mb-1">
                                <label for="studentProfileImage">Profile
                                    Image</label>
                                <div class="input-group">
                                    <input type="file" name="profile" id="studentProfileImage">
                                    <div id="imageError"></div>
                                </div>
                            </div>

                            <div class="col-md-3 form-group mb-1">
                                <label for="title">
                                    Title</label>
                                <div class="input-group">
                                    <select name="title" class="form-select" id="studentTitle">
                                        <option value="">Select One</option>
                                        @if (auth()->user()->title == 'Miss')
                                            <option value="Miss" selected>Miss</option>
                                        @else
                                            <option value="Miss">Miss</option>
                                        @endif
                                        @if (auth()->user()->title == 'Mrs')
                                            <option value="Mrs" selected>Mrs</option>
                                        @else
                                            <option value="Mrs">Mrs</option>
                                        @endif
                                        @if (auth()->user()->title == 'Mr')
                                            <option value="Mr" selected>Mr</option>
                                        @else
                                            <option value="Mr">Mr</option>
                                        @endif
                                        @if (auth()->user()->title == 'Dr')
                                            <option value="Dr" selected>Dr</option>
                                        @else
                                            <option value="Dr">Dr</option>
                                        @endif
                                        @if (auth()->user()->title == 'Pst')
                                            <option value="Pst" selected>Pst</option>
                                        @else
                                            <option value="Pst">Pst</option>
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3 form-group mb-1">
                                <label for="firstName">First Name</label>
                                <div class="input-group">
                                    <input name="first_name" type="text" class="form-control" id="studentFirstName"
                                        value="{{ auth()->user()->first_name }}">
                                </div>
                            </div>

                            <div class="col-md-3 form-group mb-1">
                                <label for="lastName">Last Name</label>
                                <div class="input-group">
                                    <input name="last_name" type="text" class="form-control" id="studentLastName"
                                        value="{{ auth()->user()->last_name }}">
                                </div>
                            </div>

                            <hr>

                            <div class="col-md-3 form-group mb-1">
                                <label for="specialization">Specialization</label>
                                <div class="input-group">
                                    <input name="specialization" value="{{ auth()->user()->profile?->specialization }}"
                                        type="text" class="form-control" id="specialization"
                                        placeholder="eg Web Designer">
                                </div>
                            </div>

                            <div class="col-md-3 form-group mb-1">
                                <label for="jobLevel">Level of seniority</label>
                                <div class="input-group">
                                    <select name="level" id="jobLevel" class="form-select">
                                        <option value=" ">Select One</option>
                                        @if (auth()->user()->profile?->level === 'Beginner')
                                            <option value="Beginner" selected>Beginner / Amature</option>
                                        @else
                                            <option value="Beginner">Beginner / Amature</option>
                                        @endif
                                        @if (auth()->user()->profile?->level === 'Intermediate')
                                            <option value="Intermediate" selected>Intermediate</option>
                                        @else
                                            <option value="Intermediate">Intermediate</option>
                                        @endif
                                        @if (auth()->user()->profile?->level === 'Expert')
                                            <option value="Expert" selected>Expert</option>
                                        @else
                                            <option value="Expert">Expert</option>
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3 form-group mb-1">
                                <label for="yearsOfExperience">Years of experience</label>
                                <div class="input-group">
                                    <input name="years_of_experience"
                                        value="{{ auth()->user()->profile?->years_of_experience }}" type="text"
                                        class="form-control" id="yearsOfExperience">
                                </div>
                            </div>

                            <div class="col-md-3 form-group mb-1" id="SkillsSection">
                                <label for="skills">Skills</label>
                                <div class="form-group">
                                    <select name="skills" id="skillsSelect" class="form-control form-control-lg"
                                        data-control="select2" data-dropdown-parent="#SkillsSection" multiple
                                        style="width:100%;">
                                    </select>
                                </div>
                            </div>

                            <div class="form-group mb-2">
                                <label for="summary">Proffessional Summary</label>
                                <div class="input-group">
                                    <textarea name="summary" value="{{ auth()->user()->profile?->summary }}" class="form-control" id="summary"></textarea>
                                </div>
                            </div>
                            <hr>

                            <h4>Work Experience</h4>
                            <div class="col-md-3 form-group mb-1">
                                <label for="jobTittle">Job Title</label>
                                <div class="input-group">
                                    <input name="jobTittle" type="text" class="form-control" id="jobTittle"
                                        value="">
                                </div>
                            </div>

                            <div class="col-md-3 form-group mb-1">
                                <label for="jobCompanyName">Company</label>
                                <div class="input-group">
                                    <input name="jobCompanyName" type="text" class="form-control" id="jobCompanyName"
                                        value="">
                                </div>
                            </div>

                            <div class="col-md-3 form-group mb-1">
                                <label for="jobStartDate">Start Date</label>
                                <div class="input-group">
                                    <input name="jobStartDate" type="date" class="form-control" id="jobStartDate"
                                        value="">
                                </div>
                            </div>

                            <div class="col-md-2 form-group mb-1">
                                <label for="jobEndDate">End Date</label>
                                <div class="input-group">
                                    <input name="jobEndDate" type="date" class="form-control" id="jobEndDate">
                                </div>
                            </div>

                            <div class="col-md-1 mt-4">
                                <button class="btn btn-primary btn-sm" type="button" id="jobAddToggle"><i
                                        class="bi bi-plus"></i> Add</button>
                            </div>

                            <div id="jobsAddFeedback"></div>
                            <hr>

                            <div class="alert alert-info" id="jobsListSection">

                                @if (!empty($jobs) && !is_null($jobs))
                                    @foreach ($jobs as $item)
                                        <div class="jobExperience row">
                                            <div class="col-md-4">
                                                <p class="title">{{ $item->title }}</p>
                                            </div>
                                            <div class="col-md-4">
                                                <p class="company">{{ $item->company }}</p>
                                            </div>
                                            <div class="col-md-3">
                                                <p><span class="startDate">{{ $item->start_date }}</span> - <span
                                                        class="endDate">{{ $item->end_date }}</span></p>
                                            </div>
                                            <div class="col-md-1"><button type="button" class="btn btn-danger btn-sm"
                                                    id="deleteJobToggle"><i class="bi bi-trash-fill"></i></button></div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <hr>

                            <h4>Education</h4>

                            <div class="col-md-4 form-group mb-1">
                                <label for="educationCourse">Course</label>
                                <div class="input-group">
                                    <input name="educationCourse" type="text" class="form-control"
                                        id="educationCourse">
                                </div>
                            </div>

                            <div class="col-md-4 form-group mb-1">
                                <label for="educationInstitution">Institution</label>
                                <div class="input-group">
                                    <input name="educationInstitution" type="text" class="form-control"
                                        id="educationInstitution">
                                </div>
                            </div>

                            <div class="col-md-4 form-group mb-1">
                                <label for="company">Education Level</label>
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

                            <div class="col-md-3 form-group mb-1">
                                <label for="educationStartDate">Start Date</label>
                                <div class="input-group">
                                    <input name="educationStartDate" type="date" class="form-control"
                                        id="educationStartDate">
                                </div>
                            </div>

                            <div class="col-md-3 form-group mb-1">
                                <label for="educationEndDate">End date</label>
                                <div class="input-group">
                                    <input name="educationEndDate" type="date" class="form-control"
                                        id="educationEndDate">
                                </div>
                            </div>

                            <div class="col-md-2 mt-4">
                                <button class="btn btn-primary btn-sm" type="button" id="educationAddToggle"><i
                                        class="bi bi-plus"></i>Add</button>
                            </div>
                            <div id="educationFeedback"></div>

                            <div class="alert alert-info" id="educationListSection">

                                @if (!empty($education) && !is_null($education))
                                    @foreach ($education as $item)
                                        <div class="educationExperience row  p-2">
                                            <div class="col-md-4">
                                                <p class="title p-0 m-0"><span
                                                        class="level">{{ $item->level }}</span>&nbsp;<span
                                                        class="course">{{ $item->course }}</span></p>
                                            </div>
                                            <div class="col-md-4">
                                                <p class="institution  p-0 m-0">{{ $item->institution }}</p>
                                            </div>
                                            <div class="col-md-3">
                                                <p class="p-0 m-0"><span class="startDate">{{ $item->start_date }}</span>
                                                    -
                                                    <span class="endDate">{{ $item->end_date }}</span>
                                                </p>
                                            </div>
                                            <div class="col-md-1"><button type="button" class="btn btn-danger btn-sm"
                                                    id="deleteEducationToggle"><i class="bi bi-trash-fill"></i></button>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif

                            </div>

                            <hr>

                            <div class="col-md-3 form-group mb-1">
                                <label for="studentAddress">Address</label>
                                <div class="input-group">
                                    <input name="address" type="text" class="form-control" id="studentAddress"
                                        value="{{ auth()->user()->address }}">
                                </div>
                            </div>

                            <div class="col-md-3 form-group mb-1">
                                <label for="studentPhone">Phone</label>
                                <div class="input-group">
                                    <input name="phone" type="text" class="form-control" id="studentPhone"
                                        value="{{ auth()->user()->phone }}">
                                </div>
                            </div>

                            <div class="col-md-3 form-group mb-1">
                                <label for="studentEmail">Email</label>
                                <div class="input-group">
                                    <input name="email" type="email" class="form-control" id="studentEmail"
                                        value="{{ auth()->user()->email }}">
                                </div>
                            </div>

                            <div class="col-md-3 form-group mb-1">
                                <label for="studentTwitter">Twitter
                                    Profile</label>
                                <div class="input-group">
                                    <input name="twitter" type="text" class="form-control" id="studentTwitter"
                                        value="{{ auth()->user()->twitter ?? 'https://twitter.com/#' }}">
                                </div>
                            </div>

                            <div class="col-md-3 form-group mb-1">
                                <label for="studentFacebook">Facebook
                                    Profile</label>
                                <div class="input-group">
                                    <input name="facebook" type="text" class="form-control" id="studentFacebook"
                                        value="{{ auth()->user()->facebook ?? 'https://facebook.com/#' }}">
                                </div>
                            </div>

                            <div class="col-md-3 form-group mb-1">
                                <label for="studentInstagram">Instagram
                                    Profile</label>
                                <div class="input-group">
                                    <input name="instagram" type="text" class="form-control" id="studentInstagram"
                                        value="{{ auth()->user()->instagram ?? 'https://instagram.com/#' }}">
                                </div>
                            </div>

                            <div class="col-md-3 form-group mb-1">
                                <label for="studentLinkedin">Linkedin
                                    Profile</label>
                                <div class="input-group">
                                    <input name="linkedin" type="text" class="form-control" id="studentLinkedin"
                                        value="{{ auth()->user()->linkedin ?? 'https://linkedin.com/#' }}">
                                </div>
                            </div>
                        </div>

                        <div id="studentProfileUpdateFeedback"></div>

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

    <div class="modal fade" id="updateProfileModal" tabindex="-1" role="dialog" aria-labelledby="financeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-title">
                        <h4 class="text-black">Profile Details</h4>
                    </div>
                    <button type="button" class="btn btn-warning" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form action="{{ route('profile.update', auth()->id()) }}" method="POST"
                        enctype="multipart/form-data" id="userUpdateForm">
                        @csrf
                        <input type="hidden" name="user_id" id="userId" value="{{ auth()->id() }}">

                        <div class="form-group mb-2">
                            <label>First Name *</label>
                            <input value="{{ $user->first_name }}" type="text" name="first_name"
                                class="form-control" id="firstName">
                        </div>

                        <div class="form-group mb-2">
                            <label>Last Name *</label>
                            <input value="{{ $user->last_name }}" type="text" name="last_name" class="form-control"
                                id="lastName">
                        </div>

                        <div class="form-group mb-2">
                            <label>Phone *</label>
                            <input value="{{ $user->phone }}" type="text" name="phone" class="form-control"
                                id="userphone">
                        </div>

                        <div class="form-group mb-2">
                            <label>Email *</label>
                            <input value="{{ $user->email }}" type="email" name="email" class="form-control"
                                id="useremail">
                        </div>

                        <div class="form-group mb-2">
                            <label>Address *</label>
                            <input value="{{ $user->address }}" type="text" name="address" class="form-control"
                                id="userAddress">
                        </div>

                        <div class="form-group mb-2">
                            <label>Profile Photo / Logo </label><br>
                            <div class="input-group">
                                <input type="file" class="form-control" name="profile" id="userProfilePhoto">
                            </div>
                        </div>

                        <div id="userProfileFeedback"></div>

                        <div class="form-group text-end">
                            <button class='btn btn-primary btn-md' type="submit"><i class="fa fa-save fa-lg fa-fw"></i>
                                Save
                            </button>
                            <button class='btn btn-outline-warning btn-md' type="reset"><i class="fa fa-broom fa-lg fa-fw"></i>
                                Clear Fields</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer_scripts')
    <script src="{{ asset('assets/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/profile.js') }}"></script>
@endsection
