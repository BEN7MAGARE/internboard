@extends('layouts.dashboard')

@section('title')
    Colleges @parent
@endsection

@section('subtitle')
    Colleges
@endsection

@section('content')
    <main class="mt-2 p-2">
        <div class="card">
            <div class="card-header">
                <ul class="nav nav-tabs nav-tabs-bordered d-flex" id="borderedTabJustified" role="tablist">

                    <li class="nav-item flex-fill" role="presentation">
                        <button class="nav-link w-100 active" id="colleges-tab" data-bs-toggle="tab"
                            data-bs-target="#collegesTab" type="button" role="tab" aria-controls="colleges"
                            aria-selected="true">Colleges</button>
                    </li>

                    <li class="nav-item flex-fill" role="presentation">
                        <button class="nav-link w-100" id="collegeUsers-tab" data-bs-toggle="tab"
                            data-bs-target="#collegeUsersTab" type="button" role="tab" aria-controls="collegeUsers"
                            aria-selected="false">Contact Person</button>
                    </li>

                    <li class="nav-item flex-fill" role="presentation">
                        <button class="nav-link w-100" id="collegeCourses-tab" data-bs-toggle="tab"
                            data-bs-target="#collegeCoursesTab" type="button" role="tab" aria-controls="collegeCourses"
                            aria-selected="false">Courses</button>
                    </li>

                </ul>
            </div>

            <div class="card-body tab-content p-2">

                <div class="tab-pane fade show active" id="collegesTab" role="tabpanel" aria-labelledby="colleges-tab">
                    <div class="d-flex justify-content-end gap-2 mb-2">
                        <a href="#" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                            data-bs-target="#createCollegeModal" id="createCollegeToggle"><i class="bi bi-plus"></i>Add
                            college</a>
                        <div class="dropdown">
                            <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton1"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Actions
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <li><a class="dropdown-item text-danger" href="#" id="deleteCollege"><i
                                            class="bi bi-trash"></i>&nbsp;Delete</a></li>
                                <li><a class="dropdown-item text-info" href="#" id="exportCollege"><i
                                            class="bi bi-file-earmark-excel"></i>&nbsp;Export</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="table-container">
                        <table class="table table-bordered table-sm table-hover table-striped scrollableTable">
                            <thead>
                                <tr>
                                    <th scope="col"><input type="checkbox" name="college_id[]" value=""
                                            id="allCollegeSelect"></th>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th>Students</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($colleges as $college)
                                    <tr>
                                        <td><input type="checkbox" name="college_id[]" value="{{ $college->id }}"></td>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $college->name }}</td>
                                        <td>{{ $college->email }}</td>
                                        <td>{{ $college->phone }}</td>
                                        <td>{{ $college->address }}</td>
                                        <td>{{ $college->students_count }}</td>
                                        <td>
                                            <button type="button" class="btn btn-warning btn-sm" id="editCollegeToggle"
                                                data-bs-toggle="modal" data-bs-target="#createCollegeModal"
                                                data-id="{{ $college->id }}"><i class="bi bi-pencil-square"></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                    <div class="pagination-box p-box-2">
                        <ul class="pagination" id="pagination">
                            {!! $colleges->links() !!}
                        </ul>
                    </div>

                </div>

                <div class="tab-pane fade" id="collegeUsersTab" role="tabpanel" aria-labelledby="collegeUsers-tab">
                    <div class="table-container">
                        <div class="d-flex justify-content-end gap-2 mb-2">
                            <a href="#" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                data-bs-target="#createCollegeUserModal" id="createCollegeUserToggle"><i
                                    class="bi bi-plus"></i>Add college user</a>
                            <div class="dropdown">
                                <button class="btn btn-secondary btn-sm dropdown-toggle" type="button"
                                    id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                    Actions
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <li><a class="dropdown-item text-danger" href="#" id="deleteCollegeUser"><i
                                                class="bi bi-trash"></i>&nbsp;Delete</a></li>
                                    <li><a class="dropdown-item text-info" href="#" id="exportCollegeUser"><i
                                                class="bi bi-file-earmark-excel"></i>&nbsp;Export</a></li>
                                </ul>
                            </div>
                        </div>
                        <table class="table table-hover table-striped table-bordered table-sm scrollableTable">
                            <thead>
                                <tr>
                                    <th scope="col"><input type="checkbox" name="college_user_id[]" value=""
                                            id="allCollegeUserSelect"></th>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>College</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($collegeusers as $user)
                                    <tr>
                                        <td><input type="checkbox" name="collegeuser_id[]" value="{{ $user->id }}">
                                        </td>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                                        <td>{{ $user->phone }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->college?->name }}</td>
                                        <td>
                                            <button type="button" data-bs-toggle="modal"
                                                data-bs-target="#createCollegeUserModal" data-id="{{ $user->id }}"
                                                class="btn btn-primary btn-sm" id="editCollegeUserToggle"><i
                                                    class="bi bi-pencil-square"></i></button>
                                            {{-- <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                                style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"><i
                                                        class="bi bi-trash"></i></button>
                                            </form> --}}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="pagination-box p-box-2">
                        <ul class="pagination" id="pagination">
                            {!! $collegeusers->links() !!}
                        </ul>
                    </div>
                </div>

                <div class="tab-pane fade" id="collegeCoursesTab" role="tabpanel" aria-labelledby="collegeCourses-tab">
                    <div class="table-container">
                        <div class="d-flex justify-content-end gap-2 mb-2">
                            <a href="#" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                data-bs-target="#createCourseModal" id="createCourseToggle"><i
                                    class="bi bi-plus"></i>Add course</a>
                            <div class="dropdown">
                                <button class="btn btn-secondary btn-sm dropdown-toggle" type="button"
                                    id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                    Actions
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <li><a class="dropdown-item text-danger" href="#" id="deleteCourse"><i
                                                class="bi bi-trash"></i>&nbsp;Delete</a></li>
                                    <li><a class="dropdown-item text-info" href="#" id="exportCourse"><i
                                                class="bi bi-file-earmark-excel"></i>&nbsp;Export</a></li>
                                </ul>
                            </div>
                        </div>
                        <table class="table table-hover table-striped table-bordered table-sm scrollableTable">
                            <thead>
                                <tr>
                                    <th scope="col"><input type="checkbox" name="course_id[]" value=""
                                            id="allCourseSelect"></th>
                                    <th>#</th>
                                    <th>Code</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Duration</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($courses as $course)
                                    <tr>
                                        <td><input type="checkbox" name="course_id[]" value="{{ $course->id }}">
                                        </td>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $course->code }}</td>
                                        <td>{{ $course->name }}</td>
                                        <td>{{ $course->description }}</td>
                                        <td>{{ $course->duration }}</td>
                                        <td>
                                            <button type="button" data-bs-toggle="modal"
                                                data-bs-target="#createCourseModal" data-id="{{ $course->id }}"
                                                class="btn btn-primary btn-sm" id="editCourseToggle"><i
                                                    class="bi bi-pencil-square"></i></button>
                                            {{-- <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                                style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"><i
                                                        class="bi bi-trash"></i></button>
                                            </form> --}}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="pagination-box p-box-2">
                        <ul class="pagination" id="pagination">
                            {!! $courses->links() !!}
                        </ul>
                    </div>
                </div>
            </div>


        </div>
    </main>
@endsection


<div class="modal fade" id="createCollegeModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="createCollegeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h1 class="modal-title fs-5" id="createCollegeModalLabel">Create College</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="{{ route('colleges.store') }}" method="POST" id="collegeCreateForm">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="id" id="collegeID" value="">
                    <div class="mb-2">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" id="collegeName" required>
                    </div>
                    <div class="mb-2">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" id="collegeEmail" required>
                    </div>
                    <div class="mb-2">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="text" class="form-control" name="phone" id="collegePhone" required>
                    </div>
                    <div class="mb-2">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control" name="address" id="collegeAddress" required>
                    </div>
                    <div class="mb-2">
                        <label for="logo" class="form-label">Logo</label>
                        <input type="file" class="form-control" name="logo" id="collegeLogo" required>
                    </div>
                </div>

                <div id="collegeFeedback"></div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="collegeCreateSubmit">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="createCollegeUserModal" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-labelledby="createCollegeUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h1 class="modal-title fs-5" id="createCollegeUserModalLabel">Create Contact Person</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="{{ route('users.store') }}" method="POST" id="collegeUserCreateForm">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="id" id="collegeUserID" value="">
                    <div class="row">
                        <div class="col-md-12 mb-2">
                            <label for="college_id" class="form-label">College</label>
                            <select name="college_id" id="collegeUserCollegeID" class="form-select">

                            </select>
                        </div>

                        <div class="col-md-6 mb-2">
                            <label for="name" class="form-label">First Name</label>
                            <input type="text" class="form-control" name="first_name" id="collegeUserFirstName"
                                required>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label for="name" class="form-label">Middle Name</label>
                            <input type="text" class="form-control" name="middle_name"
                                id="collegeUserMiddleName">
                        </div>

                        <div class="col-md-6 mb-2">
                            <label for="name" class="form-label">Last Name</label>
                            <input type="text" class="form-control" name="last_name" id="collegeUserLastName"
                                required>
                        </div>

                        <div class="col-md-6 mb-2">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" id="collegeUserEmail"
                                required>
                        </div>

                        <div class="col-md-6 mb-2">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="text" class="form-control" name="phone" id="collegeUserPhone"
                                required>
                        </div>

                        <div class="col-md-6 mb-2">
                            <label for="altPhone" class="form-label">Alternative Phone</label>
                            <input type="text" class="form-control" name="alt_phone" id="collegeUseraltPhone">
                        </div>

                        <div class="col-md-6 mb-2">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control" name="address" id="collegeUserAddress">
                        </div>
                        
                    </div>
                </div>

                <div id="collegeUserFeedback"></div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="collegeUserCreateSubmit">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="createCourseModal" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-labelledby="createCourseModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h1 class="modal-title fs-5" id="createCourseModalLabel">Create Course</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="{{ route('courses.store') }}" method="POST" id="courseCreateForm">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="id" id="courseID" value="">
                    <div class="row">

                        <div class="col-md-6 mb-2">
                            <label for="courseCategoryID" class="form-label">Category</label>
                            <select name="course_category_id" id="courseCategoryID" class="form-select">
                                
                            </select>
                        </div>
                        
                        <div class="col-md-6 mb-2">
                            <label for="courseCode" class="form-label">Code</label>
                            <input type="text" class="form-control" name="code" id="courseCode">
                        </div>

                        <div class="col-md-6 mb-2">
                            <label for="courseName" class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" id="courseName"
                                required>
                        </div>

                        <div class="col-md-6 mb-2">
                            <label for="courseDuration" class="form-label">Duration</label>
                            <input type="text" class="form-control" name="duration"
                                id="courseDuration">
                        </div>

                        <div class="col-md-6 mb-2">
                            <label for="courseDescription" class="form-label">Description</label>
                            <input type="text" class="form-control" name="description" id="courseDescription">
                        </div>
                        
                    </div>
                </div>

                <div id="courseFeedback"></div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="courseCreateSubmit">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

@section('footer_scripts')
    <script src="{{ asset('js/functions.js') }}"></script>
    <script src="{{ asset('js/college.js') }}"></script>
@endsection
