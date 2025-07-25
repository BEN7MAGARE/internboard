@extends('layouts.main')

@section('title')
    Get Started @parent
@endsection

@section('header_styles')
<link rel="stylesheet" href="{{ asset('css/iziToast.min.css') }}">
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
<main class="main">
<hr>
<hr>
<hr>
    <section class="w3l-main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                    <div class="card mt-5 mb-5 p-4 radius-image">

                        <div class=" bg-white text-center">
                            <h4 class="mb-2"><strong class="translatable">Sign up to proceed</strong></h4>
                        </div>
                        
                        <div class="row"><hr></div>
                        <form action="#" id="getStartedForm">
                            <div class="row mb-4">
                                <div class="col-md-12">
                                    <div class="form-check">
                                        <input class="form-check-input mt-2" type="radio" name="userroleselection"
                                            id="corporateSelectionRadio" required value="corporate">&nbsp;&nbsp;&nbsp;
                                        <label class="form-check-label translatable" for="corporateSelectionRadio"><b class="translatable">Join as
                                                Employer</b>
                                        </label><br>
                                        <span class="translatable">Looking to hire or employ the best talent.</span>
                                    </div>
                                </div>
                                <hr>
                                <div class="col-md-12">
                                    <div class="form-check">
                                        <input class="form-check-input mt-2" type="radio" name="userroleselection"
                                            id="collegeSelectionRadio" required value="college">&nbsp;&nbsp;&nbsp;
                                        <label class="form-check-label translatable" for="collegeSelectionRadio"><b class="translatable">Join as College / University</b>
                                        </label><br>
                                        <span class="translatable">Looking to get notified of opportunities when they arise.</span>
                                    </div>
                                </div>
                                <hr>
                                {{-- <div class="col-md-12">
                                    <div class="form-check">
                                        <input class="form-check-input mt-2" type="radio" name="userroleselection"
                                            id="userRoleSelection" required value="student">&nbsp;&nbsp;&nbsp;
                                        <label class="form-check-label translatable" for="userRoleSelection"><b class="translatable">Join as Job Seeker</b>
                                        </label><br>
                                        <span class="translatable">Seeking access to internship / employment opportunities.</span>
                                    </div>
                                </div> --}}
                            </div>
                            <hr>
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <a href="{{ url('/') }}" class="btn btn-outline-primary">
                                    << &nbsp;Back</a>
                                        <button type="submit" class="btn btn-primary">Next >></button>
                            </div>
                        </form>

                        <div class="mt-2">
                            <p><span class="translatable">Already have an account?</span> <a href="{{ route('login') }}"> <span class="translatable">Login</span></a></p>
                        </div>
                    </div>
                </div>

                <div class="col-md-5 mt-5">
                    <img src="{{ asset('images/opportunities.jpg') }}" alt="" class="img-fluid rounded">
                </div>

            </div>

        </div>

    </section>

</main>
@endsection

@section('footer_scripts')
    <script src="{{ asset('js/iziToast.min.js') }}"></script>
    <script src="{{ asset('js/auth.js') }}"></script>
@endsection
