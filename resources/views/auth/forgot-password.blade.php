@extends('layouts.app')

@section('title')
    Forgot Password @parent
@endsection

@section('content')
    <main>
        <div class="container d-flex justify-content-center align-items-center">
            <div class="col-md-5">
                <div class="card mt-5 mb-5">

                    <div class="card-header bg-white text-center">
                        <h4 class="mt-2 mb-2">Send password reset link</h4>
                    </div>

                    <form action="{{ route('verification.send') }}" method="post">
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
    </main>
@endsection
