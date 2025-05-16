@extends('layouts.dashboard')

@section('title')
    Students @parent
@endsection

@section('header_styles')
    <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
@endsection

@section('subtitle')
    Students
@endsection

@section('content')
    <main class="mt-3 p-2">

        <div class="card p-2">

            <div class="card-header">
                <div class="text-end">
                    <a href="#" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                        data-bs-target="#createStudentModal"><i class="bi bi-plus"></i> Add new</a>
                    <a href="#" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                        data-bs-target="#importStudentsModal"><i class="bi bi-plus"></i> Import</a>
                </div>
            </div>

            <div class="card-body">

                <table class="table table-hover table-striped table-bordered table-sm">
                    <thead>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Qualification</th>
                        <th>Level</th>
                        <th>Experience</th>
                        <th>Action</th>
                    </thead>

                    <tbody>
                        @foreach ($students as $item)
                            @php
                                $education = json_decode($item->profile?->education);
                            @endphp
                            <tr>
                                <td>{{ $item->first_name . ' ' . $item->last_name }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->phone }}</td>
                                @if (!is_null($education))
                                    <td>{{ $education[0]->course }}</td>
                                @else
                                    <td></td>
                                @endif
                                <td>{{ $item->profile?->level }}</td>
                                <td>{{ $item->profile?->years_of_experience . ' yrs' }}</td>
                                <td><a href="{{ route('student.details', $item->id) }}" target="_blank"
                                        class="btn btn-primary btn-sm"><i class="bi bi-eye-fill"></i> View</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>

            </div>
        </div>
    </main>
@endsection


<div class="modal fade" id="updateProdileDetailsModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
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

                        <div class="col-md-4 form-group mb-1">
                            <label for="specialization">Specialization</label>
                            <div class="input-group">
                                <input name="specialization" value="{{ auth()->user()->profile?->specialization }}"
                                    type="text" class="form-control" id="specialization"
                                    placeholder="eg Web Designer">
                            </div>
                        </div>

                        <div class="col-md-4 form-group mb-1">
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

                        <div class="col-md-4 form-group mb-1">
                            <label for="yearsOfExperience">Years of experience</label>
                            <div class="input-group">
                                <input name="years_of_experience"
                                    value="{{ auth()->user()->profile?->years_of_experience }}" type="text"
                                    class="form-control" id="yearsOfExperience">
                            </div>
                        </div>

                        <div class="col-md-12 form-group mb-1" id="SkillsSection">
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

                        <div class="col-md-3 form-group mb-1">
                            <label for="jobEndDate">End Date</label>
                            <div class="input-group d-flex gap-2">
                                <input name="jobEndDate" type="date" class="form-control" id="jobEndDate">
                                <button class="btn btn-secondary btn-sm" type="button" id="jobAddToggle"><i
                                        class="bi bi-plus"></i> Add</button>
                            </div>
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
                                                id="deleteJobToggle"><i class="bi bi-trash"></i></button></div>
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
                                    <option value="No Education">No Education</option>
                                    <option value="Primary">Primary</option>
                                    <option value="Secondary">Secondary</option>
                                    <option value="Certificate">Certificate</option>
                                    <option value="Diploma">Diploma</option>
                                    <option value="Higher Diploma">Higher Diploma</option>
                                    <option value="Degree">Degree</option>
                                    <option value="Masters">Masters</option>
                                    <option value="Doctorate">Doctorate</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4 form-group mb-1">
                            <label for="educationStartDate">Start Date</label>
                            <div class="input-group">
                                <input name="educationStartDate" type="date" class="form-control"
                                    id="educationStartDate">
                            </div>
                        </div>

                        <div class="col-md-4 form-group mb-1">
                            <label for="educationEndDate">End date</label>
                            <div class="input-group di-flex gap-2">
                                <input name="educationEndDate" type="date" class="form-control"
                                    id="educationEndDate">
                                <button class="btn btn-secondary btn-sm" type="button" id="educationAddToggle"><i
                                        class="bi bi-plus"></i>Add</button>
                            </div>
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

                        <h5>Next of Kin</h5>
                        
                        <div class="col-md-3 form-group mb-1">
                            <label for="kinName">Name</label>
                            <div class="input-group">
                                <input name="kinName" type="text" class="form-control" id="kinName"
                                    value="{{ auth()->user()->kin_name }}">
                            </div>
                        </div>

                        <div class="col-md-3 form-group mb-1">
                            <label for="kinPhone">Phone</label>
                            <div class="input-group">
                                <input name="kinPhone" type="text" class="form-control" id="kinPhone"
                                    value="{{ auth()->user()->kin_phone }}">
                            </div>
                        </div>

                        <div class="col-md-3 form-group mb-1">
                            <label for="kinEmail">Email</label>
                            <div class="input-group">
                                <input name="kinEmail" type="email" class="form-control" id="kinEmail"
                                    value="{{ auth()->user()->kin_email }}">
                            </div>
                        </div>
                        
                        <div class="col-md-3 form-group mb-1">
                            <label for="kinRelationship">Relationship</label>
                            <div class="input-group">
                                <input name="kinRelationship" type="text" class="form-control" id="kinRelationship"
                                    value="">
                            </div>
                        </div>

                    </div>

                    <div id="studentProfileUpdateFeedback"></div>

                </div>
                <div class="modal-footer">
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                        <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>


@section('footer_scripts')
    <script src="{{ asset('js/select2.min.js') }}"></script>
    <script src="{{ asset('js/functions.js') }}"></script>
    <script src="{{ asset('js/student.js') }}"></script>
@endsection
