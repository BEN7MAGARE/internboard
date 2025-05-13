@extends('layouts.dashboard')

@section('title')
Students @parent
@endsection

@section('header_styles')
<link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endsection

@section('subtitle')
Students
@endsection

@section('content')
<main class="mt-3 p-2">

    <div class="card p-2">

        <div class="card-header">
            <div class="text-end">
                <a href="#" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#createStudentModal"><i class="bi bi-plus"></i> Add new</a>
                <a href="#" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#importStudentsModal"><i class="bi bi-plus"></i> Import</a>
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
                        <td><a href="{{ route('student.details', $item->id) }}" target="_blank" class="btn btn-primary btn-sm"><i class="bi bi-eye-fill"></i> View</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>

            </table>

        </div>
    </div>
</main>
@endsection

@section('footer_scripts')
<script src="{{ asset('js/select2.min.js') }}"></script>
<script src="{{ asset('js/profile.js') }}"></script>
@endsection
