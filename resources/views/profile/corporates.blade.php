@extends('layouts.dashboard')

@section('title')
Corporates @parent
@endsection

@section('header_styles')
<link rel="stylesheet" href="{{ asset('assets/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/profile.css') }}">

@endsection

@section('subtitle')
Corporates
@endsection

@section('content')
<main class="mt-3 p-2">
    <div class="card p-2">

        <div class="card-header">
            <h4 class="card-title">Corporates</h4>
        </div>

        <div class="card-body">
            <div class="card-header">
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
</main>
@endsection

@section('footer_scripts')
<script src="{{ asset('js/select2.min.js') }}"></script>
<script src="{{ asset('js/profile.js') }}"></script>
@endsection
