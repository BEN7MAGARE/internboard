@extends('layouts.main')

@section('title')
    Students @parent
@endsection

@section('header_styles')
    <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">

@endsection

@section('content')
    <section class="w3l-main-content">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 mb-4 card">

                    @include('profile.partials.sidebarnav')

                </div>

                <div class="col-xl-9">

                    <div class="card">
                        <div class="card-header bg-white">
                            <h4 class="card-title">Job Seekers</h4>
                        </div>

                        <div class="card-body pt-3">
                            <table class="table table-hover table-striped table-bordered">
                                <thead>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>College</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Action</th>
                                </thead>

                                <tbody>
                                    @foreach ($students as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->title." ".$item->first_name." ".$item->last_name }}</td>
                                            <td>{{ $item->college->name }}</td>
                                            <td>{{ $item->email }}</td>
                                            <td>{{ $item->phone }}</td>
                                            <td></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot class="text-end">{{ $students->links() }}</tfoot>
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
