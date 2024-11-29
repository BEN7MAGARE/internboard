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
                        <p class="text-danger">{!! 'Thanks for signing up! Before getting started, could you verify your email address by
                                            clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you
                                            another.' !!}</p>
                    </div>

                    <div class="card-body">
                        <div class="row">

                            <div class="col-md-12 text-center">
                                <form action="{{ route('password.email') }}" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-primary">
                                        Resend Verification Email
                                    </button>
                                </form>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-md-12 text-center">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf

                                    <button type="submit" class="btn btn-danger">
                                        {{ __('Log Out') }} <i class="fa fa-sign-out"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
