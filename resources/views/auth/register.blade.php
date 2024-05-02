@extends('layouts.app')

@section('title')
    Get Started @parent
@endsection

@section('header_styles')
    <style>
        .form-check {
            border-radius: 15px;
            padding: 10px 2em;
            margin-bottom: 1em;
            font-weight: bold;
            box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
        }
        .form-check span {
            font-size: 12px;
            text-align: center;
            margin-top: 1em;
            font-weight: normal
        }
        .form-check .form-check-input {
            margin: 1em 2em;
            border: 1px solid #555;
        }
    </style>
@endsection

@section('content')
    <main>
        <div class="container d-flex justify-content-center align-items-center">
            <div class="col-md-7">
                <div class="card mt-5 mb-5">

                    <div class="card-header bg-white text-center">
                        <img src="{{ asset('assets/img/logo.png') }}" alt="" height="80px">
                        <h4 class="mt-2 mb-2"><strong>Sign up to proceed</strong></h4>
                    </div>
                    <br>

                    <form action="#" id="getStartedForm">
                        <div class="row m-1">
                            <div class="col-md-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="userroleselection"
                                        id="corporateSelectionRadio" required value="corporate">
                                    <label class="form-check-label" for="corporateSelectionRadio">
                                        Join as corporate <br>
                                        <span>Looking to hire or employ the best talent.</span>
                                    </label>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="userroleselection"
                                        id="collegeSelectionRadio" required value="college">
                                    <label class="form-check-label" for="collegeSelectionRadio">
                                        Join as University / College <br>
                                        <span>Looking to get notified of opportunities when they arise.</span>
                                    </label>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="userroleselection"
                                        id="userRoleSelection" required value="student">
                                    <label class="form-check-label" for="userRoleSelection">
                                        Join as Student <br>
                                        <span>Seeking access to internship / employment opportunities.</span>
                                    </label>
                                </div>
                            </div>

                        </div>

                        <div class="d-flex align-items-center justify-content-between">
                            <a href="{{ url('/') }}" class="btn btn-outline-primary"><i class="fa fa-arrow-left"></i> &nbsp;Back</a>
                            <button type="submit" class="btn btn-primary">Next <i class="fa fa-arrow-right"></i></button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </main>
@endsection

@section('footer_scripts')
    <script src="{{ asset('assets/js/auth.js') }}"></script>
@endsection
