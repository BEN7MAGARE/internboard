@extends('layouts.main')

@section('title')
    Students @parent
@endsection

@section('header_styles')
    <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endsection

@section('content')
    <section class="main-content">
        <div class="page-title" data-aos="fade">
            <nav class="breadcrumbs">
                <div class="container">
                    <ol>
                        <li><a href="/">Home</a></li>
                        <li class="current">Students</li>
                    </ol>
                </div>
            </nav>
        </div>

        <div class="container mt-3">
            <div class="row">

                <div class="col-xl-3 mb-4 card">
                    @include('profile.partials.sidebarnav')
                </div>

                <div class="col-xl-9">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-hover table-striped">
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
                                            <td>{{ $item->profile?->years_of_experience.' yrs' }}</td>
                                            <td><a href="{{ route('student.details', $item->id) }}" target="_blank"
                                                    class="btn btn-primary btn-sm"><i class="bi bi-eye-fill"></i> View</a>
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
    </section>
@endsection

@section('footer_scripts')
    <script src="{{ asset('js/select2.min.js') }}"></script>
    <script src="{{ asset('js/profile.js') }}"></script>
@endsection
