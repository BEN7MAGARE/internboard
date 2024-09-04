@extends('layouts.app')

@section('title')
    Profile @parent
@endsection

@section('header_styles')
    <link rel="stylesheet" href="{{ asset('assets/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/profile.css') }}">
    <script>
        $.fn.modal.Constructor.prototype.enforceFocus = function() {};
    </script>
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
                        <div class="card-header bg-white">
                            <h4 class="card-title">Corporates</h4>
                        </div>

                        <div class="card-body pt-3">
                            <table class="table table-hover table-striped table-bordered">
                                <thead>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th>Contact Person</th>
                                    <th>Action</th>
                                </thead>

                                <tbody>
                                    @foreach ($corporates as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->email }}</td>
                                            <td>{{ $item->phone }}</td>
                                            <td>{{ $item->address }}</td>
                                            <td>{{ @$item->users[0]->first_name." ".@$item->users[0]->last_name }}</td>
                                            <td></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot class="text-end">{{ $corporates->links() }}</tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('footer_scripts')
    <script src="{{ asset('assets/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/profile.js') }}"></script>
@endsection
