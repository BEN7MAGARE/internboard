@extends('layouts.dashboard')

@section('title')
    Users @parent
@endsection

@section('subtitle')
    Users
@endsection

@section('content')
    <main class="mt-2 p-2" id="mainContent">

        <div class="row">
            <div class="col-12">
                <div class="card">

                    <div class="card-header">
                        <ul class="nav nav-tabs nav-tabs-bordered d-flex" id="borderedTabJustified" role="tablist">

                            <li class="nav-item flex-fill" role="presentation">
                                <button class="nav-link w-100 active" id="corporateUsers-tab" data-bs-toggle="tab"
                                    data-bs-target="#corporateUsersTab" type="button" role="tab"
                                    aria-controls="corporateUsers" aria-selected="true">Corporate Users</button>
                            </li>

                            <li class="nav-item flex-fill" role="presentation">
                                <button class="nav-link w-100" id="collegeUsers-tab" data-bs-toggle="tab"
                                    data-bs-target="#collegeUsersTab" type="button" role="tab"
                                    aria-controls="collegeUsers" aria-selected="false">College Users</button>
                            </li>

                            <li class="nav-item flex-fill" role="presentation">
                                <button class="nav-link w-100" id="jobSeekers-tab" data-bs-toggle="tab"
                                    data-bs-target="#jobSeekersTab" type="button" role="tab" aria-controls="jobSeekers"
                                    aria-selected="true">Job Seekers</button>
                            </li>
                        </ul>

                    </div>

                    <div class="tab-content p-2">

                        <div class="tab-pane fade show active" id="corporateUsersTab" role="tabpanel"
                            aria-labelledby="corporateUsers-tab">
                            
                            
                        </div>
                        <div class="tab-pane fade" id="collegeUsersTab" role="tabpanel" aria-labelledby="collegeUsers-tab">
                            
                        </div>
                        <div class="tab-pane fade" id="jobSeekersTab" role="tabpanel" aria-labelledby="jobSeekers-tab">
                            <div class="table-container">
                                <table class="table table-hover table-striped table-bordered table-sm scrollableTable">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Phone</th>
                                            <th>Email</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($jobseekers as $user)
                                            <tr>
                                                <td>{{ $user->id }}</td>
                                                <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                                                <td>{{ $user->phone }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>
                                                    <a href="{{ route('users.edit', $user->id) }}"
                                                        class="btn btn-primary btn-sm"><i class="bi bi-pencil"></i></a>
                                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                                        style="display: inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm"><i
                                                                class="bi bi-trash"></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
