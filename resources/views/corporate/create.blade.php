@extends('layouts.dashboard')

@section('title')
    Create Business @parent
@endsection
@section('header_styles')
    <link rel="stylesheet" href="{{ asset('css/iziToast.min.css') }}">
@endsection

@section('subtitle')
    Create Business
@endsection

@section('content')
    <main class="main">
        <section class="mt-2 p-2">
            <div class="card mb-5 radius-image p-2">

                <div class="card-header bg-white">
                    <h4 class="mb-2"><strong>Add Your Company/Business Details</strong></h4>
                </div>

                <form action="{{ route('corporate.store') }}" method="post" id="corporateCreateForm">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="companyName">Company Name</label>
                                <input type="text" class="form-control @error('name') invalid-input:'' @enderror"
                                    name="name" id="companyName" required>
                                @error('name')
                                    <div class="invalid-feedback">
                                        <p class="text-danger">{{ $message }}</p>
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6 form-group">
                                <label for="email">Company Email</label>
                                <input type="email" class="form-control @error('email') invalid-input:'' @enderror"
                                    name="email" id="companyEmail" required>
                                @error('email')
                                    <div class="invalid-feedback">
                                        <p class="text-danger">{{ $message }}</p>
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6 form-group">
                                <label for="phone">Company Phone</label>
                                <input type="text" class="form-control @error('phone') invalid-input:'' @enderror"
                                    name="phone" id="companyPhone" required>
                                @error('phone')
                                    <div class="invalid-feedback">
                                        <p class="text-danger">{{ $message }}</p>
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6 form-group">
                                <label for="address">Company Address/Street</label>
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

                    <div id="corporateFeedback"></div>

                    <div class="card-footer bg-white text-end p-2">
                        <button type="submit" class="btn btn-primary btn-md" id="corporateCreateSubmit"><i
                                class="fa fa-server"></i> Submit </button>
                    </div>
                </form>
            </div>
        </section>
    </main>
@endsection

@section('footer_scripts')
    <script src="{{ asset('js/iziToast.min.js') }}"></script>
    <script src="{{ asset('js/functions.js') }}"></script>
    <script src="{{ asset('js/corporate.js') }}"></script>
@endsection
