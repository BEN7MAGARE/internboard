@extends('layouts.main')

@section('title')
    Forgot Password @parent
@endsection

@section('content')
    <section class="w3l-main-content">
        <div class="container d-flex justify-content-center align-items-center">
            <div class="col-md-5">
                <div class="card mt-5 mb-5">

                    <div class="card-header bg-white text-center">
                        <img src="{{ asset('assets/img/tuk.png') }}" alt="" height="80px">
                        <h4 class="mt-2 mb-2">Send password reset link</h4>
                    </div>

                    <form action="{{ route('password.email') }}" method="post">
                        @csrf
                        <div class="card-body">
                            <div class="row">

                                <div class="col-md-12 form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control form-control-lg" name="email" id="email"
                                        required>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer bg-white d-flex align-items-center justify-content-end p-2">
                            <button type="submit" class="btn btn-primary btn-lg">Email Password Reset Link</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
