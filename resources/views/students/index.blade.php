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
                <div class="d-flex justify-content-end gap-2">
                    <a href="#" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                        data-bs-target="#createStudentModal" id="createStudentToggle"><i class="bi bi-plus"></i> Add new</a>
                    <a href="#" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                        data-bs-target="#importStudentsModal"><i class="bi bi-plus"></i> Import</a>
                    <div class="dropdown">
                        <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton1"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Actions
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item text-danger" href="#" id="deleteCategory"><i
                                        class="bi bi-trash"></i>&nbsp;Delete</a></li>
                            <li><a class="dropdown-item text-info" href="#" id="exportCategory"><i
                                        class="bi bi-file-earmark-excel"></i>&nbsp;Export</a></li>
                        </ul>
                    </div>
                </div>

            </div>

            <div class="card-body">
                <form action="{{ route('students.filter') }}" method="post" id="studentFilterForm">
                    @csrf
                    <div class="row">
                        @if (auth()->user()->role === 'admin')
                            <div class="col-md-3 form-group mb-1">
                                <div class="input-group">
                                    <select name="college_id" class="form-select form-select-sm" id="studentFilterCollegeID">
                                        <option value="">Select College</option>
                                       
                                    </select>
                                </div>
                            </div>
                        @else
                            <input type="hidden" name="college_id" value="{{ auth()->user()->college_id }}" id="studentFilterCollegeID">
                        @endif

                        <div class="col-md-2 form-group mb-1">
                            <div class="input-group">
                                <select name="course_id" class="form-select form-select-sm" id="studentFilterCourse">
                                    <option value="">Select Course</option>
                                    
                                </select>
                            </div>
                        </div>
                        
                        <div class="col-md-2 form-group mb-1">
                            <div class="input-group">
                                <select name="level_of_study" class="form-select form-select-sm" id="level_of_study">
                                    <option value="">Select One</option>
                                    <option value="Certificate">Certificate</option>
                                    <option value="Diploma">Diploma</option>
                                    <option value="Degree">Degree</option>
                                    <option value="Masters">Masters</option>
                                    <option value="Doctorate">Doctorate</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-2 form-group mb-1">
                            <div class="input-group">
                                <select name="year_of_study" class="form-select form-select-sm" id="studentFilterYear">
                                    <option value="">Select Year</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-2 mb-1">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" id="sponsored">
                                <label class="form-check-label" for="sponsored">Sponsored</label>
                            </div>
                        </div>

                        <div class="col-md-1">
                            <button type="submit" class="btn btn-primary btn-sm"><i class="bi bi-search"></i></button>
                        </div>

                    </div>
                </form>
                <div class="table-container">
                    <table class="table table-hover table-striped table-bordered table-sm scrollableTable">
                        <thead>
                            <th scope="col"><input type="checkbox" name="student_id[]" value=""
                                    id="allStudentSelect">
                            </th>
                            <th>#</th>
                            <th>ADM NO</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Gender</th>
                            <th>College</th>
                            <th>Course</th>
                            <th>Reg Number</th>
                            <th>Year</th>
                            <th>Action</th>

                        </thead>

                        <tbody id="studentTableBody">
                            @foreach ($students as $item)
                                @php
                                    $education = json_decode($item->profile?->education);
                                @endphp
                                <tr>
                                    <td><input type="checkbox" name="student_id[]" value="{{ $item->id }}"></td>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->student?->admision_number }}</td>
                                    <td>{{ $item->first_name . ' ' . $item->last_name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->phone }}</td>
                                    <td>{{ $item->gender }}</td>
                                    <td>{{ $item->college?->name }}</td>
                                    <td>{{ $item->student?->course?->name }}</td>
                                    <td>{{ $item->student?->reg_number }}</td>
                                    <td>{{ $item->student?->year_of_study }}</td>
                                    <td class="d-flex gap-2">
                                        <a href="{{ route('student.details', $item->id) }}" target="_blank"
                                            class="btn btn-primary btn-sm"><i class="bi bi-eye-fill"></i></a>
                                        <a href="#" target="_blank" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#createStudentModal" id="editStudentToggle" data-id="{{ $item->id }}"><i class="bi bi-pencil-square"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
                <div class="pagination" id="studentPagination">
                    {{ $students->links() }}
                </div>
            </div>
        </div>
    </main>
@endsection


<div class="modal fade" id="createStudentModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Create Student</h1>
                <button type="button" class="btn-close btn text-danger" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>

            <form action="{{ route('students.store') }}" id="studentCreateForm">

                <div class="modal-body">
                    @csrf
                    <div class="row">
                        <input type="hidden" name="id" id="userID" value="">
                        <input type="hidden" name="student_id" id="studentID" value="">
                        <div class="col-md-4 form-group mb-1">
                            <label for="firstName">First Name</label>
                            <div class="input-group">
                                <input name="first_name" type="text" class="form-control form-control-sm"
                                    id="studentFirstName" value="{{ old('first_name') }}">
                            </div>
                        </div>

                        <div class="col-md-4 form-group mb-1">
                            <label for="middleName">Middle Name</label>
                            <div class="input-group">
                                <input name="middle_name" type="text" class="form-control form-control-sm"
                                    id="studentMiddleName" value="{{ old('middle_name') }}">
                            </div>
                        </div>

                        <div class="col-md-4 form-group mb-1">
                            <label for="lastName">Last Name</label>
                            <div class="input-group">
                                <input name="last_name" type="text" class="form-control form-control-sm"
                                    id="studentLastName" value="{{ old('last_name') }}">
                            </div>
                        </div>
                        <div class="col-md-4 form-group mb-1">
                            <label for="idNumber">ID Number</label>
                            <div class="input-group">
                                <input name="id_no" type="text" class="form-control form-control-sm"
                                    id="studentIdNumber" value="{{ old('id_no') }}">
                            </div>
                        </div>

                        <div class="col-md-4 form-group mb-1">
                            <label for="title">
                                Gender</label>
                            <div class="input-group">
                                <select name="gender" class="form-select form-select-sm" id="studentGender">
                                    <option value="">Select One</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4 form-group mb-1">
                            <label for="title">
                                Designation</label>
                            <div class="input-group">
                                <select name="title" class="form-select form-select-sm" id="studentTitle">
                                    <option value="">Select One</option>
                                    <option value="Miss" selected>Miss</option>
                                    <option value="Mrs">Mrs</option>
                                    <option value="Mr">Mr</option>
                                    <option value="Dr">Dr</option>
                                    <option value="Pst">Pst</option>
                                </select>
                            </div>
                        </div>


                        <div class="col-md-4 form-group mb-1">
                            <label for="studentEmail">Email</label>
                            <div class="input-group">
                                <input name="email" type="email" class="form-control form-control-sm"
                                    id="studentEmail" value="{{ old('email') }}">
                            </div>
                        </div>

                        <div class="col-md-4 form-group mb-1">
                            <label for="studentPhone">Phone</label>
                            <div class="input-group">
                                <input name="phone" type="text" class="form-control form-control-sm"
                                    id="studentPhone" value="{{ old('phone') }}">
                            </div>
                        </div>

                        <div class="col-md-4 form-group mb-1">
                            <label for="studentAddress">Address</label>
                            <div class="input-group">
                                <input name="address" type="text" class="form-control form-control-sm"
                                    id="studentAddress" value="{{ old('address') }}">
                            </div>
                        </div>

                        <div class="col-md-4 form-group mb-1">
                            <label for="homeCountyId">Home County</label>
                            <div class="input-group">
                                <select name="county_id" class="form-select form-select-sm" id="homeCountyId">
                                    
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4 form-group mb-1">
                            <label for="studentProfileImage">Passport
                                Photo</label>
                            <div class="input-group">
                                <input type="file" name="image" id="studentProfileImage">
                                <div id="imageError"></div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        @if (auth()->user()->role === 'admin')
                            <div class="col-md-4 form-group mb-1">
                                <label for="collegeId">College</label>
                                <div class="input-group">
                                    <select name="college_id" class="form-select form-select-sm" id="collegeId">
                                       
                                    </select>
                                </div>
                            </div>
                        @else
                            <input type="hidden" name="college_id" value="{{ auth()->user()->college_id }}">
                        @endif


                        <div class="col-md-4 form-group mb-1">
                            <label for="courseId">Course</label>
                            <div class="input-group">
                                <select name="course_id" class="form-select form-select-sm" id="courseId">
                                    <option value="">Select One</option>
                                   
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4 form-group mb-1">
                            <label for="year_of_study">Year of Study</label>
                            <div class="input-group">
                                <select name="year_of_study" class="form-select form-select-sm" id="yearOfStudy">
                                    <option value="">Select One</option>
                                    <option value="">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4 form-group mb-1">
                            <label for="courseLevel">Course Level</label>
                            <div class="input-group">
                                <select name="course_level" class="form-select form-select-sm" id="courseLevel">
                                    <option value="">Select One</option>
                                    <option value="Certificate">Certificate</option>
                                    <option value="Diploma">Diploma</option>
                                    <option value="Degree">Degree</option>
                                    <option value="Masters">Masters</option>
                                    <option value="Doctorate">Doctorate</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4 form-group mb-1">
                            <label for="regNumber">Registration Number</label>
                            <div class="input-group">
                                <input name="reg_number" type="text" class="form-control form-control-sm"
                                    id="regNumber" value="{{ old('reg_number') }}">
                            </div>
                        </div>
                    </div>

                    <h5>Next of Kin</h5>
                    <div class="row">
                        <div class="col-md-3 form-group mb-1">
                            <label for="kinName">Name</label>
                            <div class="input-group">
                                <input name="kin_name" type="text" class="form-control form-control-sm"
                                    id="kinName" value="{{ old('kin_name') }}">
                            </div>
                        </div>

                        <div class="col-md-3 form-group mb-1">
                            <label for="kinPhone">Phone</label>
                            <div class="input-group">
                                <input name="kin_phone" type="text" class="form-control form-control-sm"
                                    id="kinPhone" value="{{ old('kin_phone') }}">
                            </div>
                        </div>

                        <div class="col-md-3 form-group mb-1">
                            <label for="kinEmail">Email</label>
                            <div class="input-group">
                                <input name="kin_email" type="email" class="form-control form-control-sm"
                                    id="kinEmail" value="{{ old('kin_email') }}">
                            </div>
                        </div>

                        <div class="col-md-3 form-group mb-1">
                            <label for="kinRelationship">Relationship</label>
                            <div class="input-group">
                                <select name="kin_relationship" class="form-select form-select-sm"
                                    id="kinRelationship">
                                    <option value="">Select One</option>
                                    <option value="Father" selected>Father</option>
                                    <option value="Mother">Mother</option>
                                    <option value="Brother">Brother</option>
                                    <option value="Sister">Sister</option>
                                    <option value="Spouse">Spouse</option>
                                    <option value="Son">Son</option>
                                    <option value="Daughter">Daughter</option>
                                    <option value="Grandmother">Grandmother</option>
                                    <option value="Grandfather">Grandfather</option>
                                    <option value="Aunt">Aunt</option>
                                    <option value="Uncle">Uncle</option>
                                    <option value="Cousin">Cousin</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3 mt-2">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" id="studentSponsored" name="sponsored">
                                <label class="form-check-label" for="studentSponsored">Sponsored</label>
                            </div>
                        </div>

                    </div>

                    <div id="studentfeedback"></div>

                </div>
                <div class="modal-footer">
                    <div class="text-center">
                        <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
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
