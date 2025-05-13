@extends('layouts.dashboard')

@section('title')
Jobs @parent
@endsection

@section('header_styles')
<link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endsection

@section('subtitle')
Jobs
@endsection

@section('content')
<main class="mt-3 p-2">
    <div class="card p-2">
        <div class="row">

            <div class="col-xl-3 mb-4">
                @include('profile.partials.sidebarnav')
            </div>

            <div class="col-xl-9">

                <div class="card">
                    <div class="card-header bg-white">
                        <h4 class="card-title">Job Opportunities </h4>
                    </div>

                    <div class="card-body pt-3">
                        <table class="table table-hover table-striped table-bordered">
                            <thead>
                                <th>#</th>
                                <th>Ref</th>
                                <th>Type</th>
                                <th>Job Type</th>
                                <th>Experience</th>
                                <th>Location</th>
                                <th>Education</th>
                                <th>Title</th>
                                <th>Posted By</th>
                                <th>Action</th>
                            </thead>

                            <tbody>
                                @foreach ($opportunities as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->ref_no }}</td>
                                    <td>{{ $item->type }}</td>
                                    <td>{{ $item->job_type }}</td>
                                    <td>{{ $item->experience_level }}</td>
                                    <td>{{ $item->location }}</td>
                                    <td>{{ $item->education_level }}</td>
                                    <td>{{ $item->title }}</td>
                                    <td>{{ $item->user->first_name.' '.$item->user->last_name }}</td>
                                    <td></td>
                                </tr>
                                @endforeach
                            </tbody>

                            <tfoot class="text-end">{{ $opportunities->links() }}</tfoot>

                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</main>
@endsection

@section('footer_scripts')
<script src="{{ asset('js/select2.min.js') }}"></script>
<script src="{{ asset('js/profile.js') }}"></script>
@endsection
