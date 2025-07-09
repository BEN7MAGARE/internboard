@extends('layouts.dashboard')

@section('title')
    University / College Create @parent
@endsection

@section('header_styles')
    <link rel="stylesheet" href="{{ asset('css/iziToast.min.css') }}">
@endsection

@section('subtitle')
    Add University / College details
@endsection

@section('content')
    <main class="main">
        <section class="mt-2 p-2">
            <div class="card mb-5 radius-image p-2">

                <form action="{{ route('colleges.store') }}" method="post" id="collegeAltCreateForm">
                    @csrf
                    <div class="card-body">
                        <h5><b>Institution Details</b></h5>
                        <hr>
                        <input type="hidden" name="id" id="collegeID" value="">
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="companyName">Institution Name</label>
                                <input type="text" class="form-control " name="name" id="companyName" required>
                            </div>

                            <div class="col-md-6 form-group">
                                <label for="email">Institution Email</label>
                                <input type="email" class="form-control @error('email') invalid-input:'' @enderror"
                                    name="email" id="companyEmail" required>
                                @error('email')
                                    <div class="invalid-feedback">
                                        <p class="text-danger">{{ $message }}</p>
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6 form-group">
                                <label for="phone">Institution Phone</label>
                                <input type="text" class="form-control @error('phone') invalid-input:'' @enderror"
                                    name="phone" id="companyPhone" required>
                                @error('phone')
                                    <div class="invalid-feedback">
                                        <p class="text-danger">{{ $message }}</p>
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6 form-group">
                                <label for="address">Institution Address/Street</label>
                                <input type="text" class="form-control @error('address') invalid-input:'' @enderror"
                                    name="address" id="companyAddress" required>
                                @error('address')
                                    <div class="invalid-feedback">
                                        <p class="text-danger">{{ $message }}</p>
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6 form-group">
                                <label for="logo">Logo</label>
                                <input type="file" class="form-control @error('logo') invalid-input:'' @enderror"
                                    name="logo" id="logo" autocomplete="logo" required>

                                @error('logo')
                                    <div class="invalid-feedback">
                                        <p class="text-danger">{{ $message }}</p>
                                    </div>
                                @enderror
                            </div>
                        </div>

                    </div>

                    <div id="collegeFeedback"></div>

                    <div class="card-footer bg-white text-end p-2">
                        <button type="submit" class="btn btn-primary btn-md" id="collegeCreateSubmit">Submit</button>
                    </div>
                </form>
            </div>
        </section>
        
    </main>
@endsection

@section('footer_scripts')
    <script src="{{ asset('js/iziToast.min.js') }}"></script>
    <script src="{{ asset('js/functions.js') }}"></script>
    <script src="{{ asset('js/college.js') }}"></script>
@endsection
