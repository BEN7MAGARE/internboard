@extends('layouts.dashboard')

@section('title')
    Courses @parent
@endsection

@section('header_styles')
    <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
@endsection

@section('subtitle')
    Courses
@endsection

@section('content')
    <main class="mt-3 p-2">
        <div class="card p-2">

            <div class="card-header">
                <div class="d-flex justify-content-end gap-2">
                    <a href="#" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#createCourseModal"
                        id="createCourseToggle"><i class="bi bi-plus"></i> Add new</a>
                    <a href="#" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                        data-bs-target="#importCoursesModal"><i class="bi bi-plus"></i> Import</a>
                    <div class="dropdown">
                        <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton1"
                            data-bs-toggle="dropdown" aria-expanded="false">
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
            </div>

            <div class="card-body pt-3">

                <div class="table-container">
                    <table class="table table-hover table-striped table-bordered table-sm scrollableTable">
                        <thead>
                            <th scope="col"><input type="checkbox" name="student_id[]" value=""
                                    id="allStudentSelect">
                            </th>
                            <th>#</th>
                            <th>Code</th>
                            <th>Category</th>
                            <th>Name</th>
                            <th>Level of Study</th>
                            <th>Duration</th>
                            <th>Fee</th>
                            <th>Action</th>
                        </thead>

                        <tbody id="courseTableBody">
                            @foreach ($courses as $item)
                                @php
                                    $education = json_decode($item->profile?->education);
                                @endphp
                                <tr>
                                    <td><input type="checkbox" name="student_id[]" value="{{ $item->id }}"></td>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->code }}</td>
                                    <td>{{ $item->category?->name }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->level_of_study }}</td>
                                    <td>{{ $item->duration }}</td>
                                    <td>{{ $item->fees }}</td>
                                    <td class="d-flex gap-2">
                                        <a href="#" target="_blank" class="btn btn-primary btn-sm"
                                            data-bs-toggle="modal" data-bs-target="#createCourseModal" id="editCourseToggle"
                                            data-id="{{ $item->id }}"><i class="bi bi-pencil-square"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>

                <div class="pagination" id="studentPagination">
                    {{ $courses->links() }}
                </div>
            </div>
        </div>
    </main>

    <div class="modal fade" id="createCourseModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Create Course</h1>
                    <button type="button" class="btn-close btn text-danger" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>

                <form action="{{ route('courses.store') }}" id="courseCreateForm">

                    <div class="modal-body">
                        @csrf
                        <div class="row">
                            <input type="hidden" name="id" id="courseId" value="">

                            <div class="col-md-6 form-group mb-1">
                                <label for="category_id"> Category</label>
                                <div class="input-group">
                                    <select name="course_category_id" class="form-select form-select-sm" id="categoryId">

                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6 form-group mb-1">
                                <label for="courseName">Name</label>
                                <div class="input-group">
                                    <input name="name" type="text" class="form-control form-control-sm"
                                        id="courseName" value="{{ old('name') }}">
                                </div>
                            </div>

                            <div class="col-md-6 form-group mb-1">
                                <label for="courseCode">Code</label>
                                <div class="input-group">
                                    <input name="code" type="text" class="form-control form-control-sm"
                                        id="courseCode" value="{{ old('course_code') }}">
                                </div>
                            </div>

                            <div class="col-md-6 form-group mb-1">
                                <label for="duration">Duration</label>
                                <div class="input-group">
                                    <input name="duration" type="text" class="form-control form-control-sm"
                                        id="duration" value="{{ old('duration') }}">
                                </div>
                            </div>

                            <div class="col-md-6 form-group mb-1">
                                <label for="fee">
                                    Fee</label>
                                <div class="input-group">
                                    <input name="fees" type="text" class="form-control form-control-sm"
                                        id="fee" value="{{ old('fee') }}">
                                </div>
                            </div>

                            <div class="col-md-6 form-group mb-1">
                                <label for="level_of_study">Level of Study</label>
                                <div class="input-group">
                                    <select name="level_of_study" class="form-select form-select-sm" id="levelOfStudy">
                                        <option value="">Select One</option>
                                        <option value="Certificate">Certificate</option>
                                        <option value="Diploma">Diploma</option>
                                        <option value="Degree">Degree</option>
                                        <option value="Masters">Masters</option>
                                        <option value="Doctorate">Doctorate</option>
                                        <option value="">Select One</option>
                                        <option value="Certificate">Certificate</option>
                                        <option value="Diploma">Diploma</option>
                                        <option value="Degree">Degree</option>
                                        <option value="Masters">Masters</option>
                                        <option value="Doctorate">Doctorate</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12 form-group mb-1">
                                <label for="description">Description</label>
                                <div class="input-group">
                                    <textarea name="description" class="form-control form-control-sm" id="description">{{ old('description') }}</textarea>
                                </div>
                            </div>

                        </div>

                        <div id="courseFeedback"></div>

                    </div>
                    <div class="modal-footer">
                        <div class="text-center">
                            <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" id="createCourseToggle">Save</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection

@section('footer_scripts')
    <script src="{{ asset('js/select2.min.js') }}"></script>
    <script src="{{ asset('js/functions.js') }}"></script>
    <script src="{{ asset('js/courses.js') }}"></script>
@endsection
