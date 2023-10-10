@extends('layouts.app')

@section('title')
    Profile @parent
@endsection

@section('header_styles')
    <link rel="stylesheet" href="{{ asset('assets/css/profile.css') }}">
@endsection

@section('content')
<div class="dashboard-content">
            <div class="dashboard-form mb-4">
                <div class="row">

                    <div class="col-lg-4 col-md-6 col-xs-12 padding-right-30 text-center">
                        <div class="dashboard-list bg-white p-2">
                            <h4 class="gray">Profile Details</h4>
                            <div class="dashboard-list-static">

                                <div class="edit-profile-photo">
                                    @if (!is_null($user->profile) && Storage::exists(public_path('profiles/' . $user->profile)))
                                        <img src="{{ asset('profiles/' . $user->profile) }}" alt="">
                                    @else
                                        <img src="{{ asset('assets/img/avata.png') }}" alt="">
                                    @endif
                                </div>

                                <div class="my-profile">
                                    <h5><strong>{{ $user->first_name.' '.$user->last_name }}</strong></h5>
                                    <p>{!! 'Tel: <span class="text-success">' . $user->phone . '</span>' !!}</p>
                                    <p>{!! 'Email: <span class="text-success">' . $user->email . '</span>' !!}</p>
                                    <a href="#" class="btn btn-success btn-block" data-bs-toggle="modal"
                                        data-bs-target="#updateProfileModal">Update Profile</a>
                                    <div id="profilefeedback"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>


<div class="modal fade" id="updateProfileModal" tabindex="-1" role="dialog" aria-labelledby="financeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered" role="document">
        <div class="modal-content" id="vehiclePreviewSection">
            <div class="modal-header">
                <div class="modal-title">
                    <h4 class="text-black">Profile Details</h4>
                </div>
                <button type="button" class="btn btn-warning" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form action="{{ route('profile.update', auth()->id()) }}" method="POST" enctype="multipart/form-data"
                    id="userupdateForm">
                    @csrf
                    <input type="hidden" name="user_id" id="userId" value="{{ auth()->id() }}">

                    <div class="form-group">
                        <label>First Name *</label>
                        <input value="{{ $user->first_name }}" type="text" name="first_name" class="form-control"
                            id="firstName">
                    </div>

                    <div class="form-group">
                        <label>Last Name *</label>
                        <input value="{{ $user->last_name }}" type="text" name="last_name" class="form-control"
                            id="lastName">
                    </div>

                    <div class="form-group">
                        <label>Phone *</label>
                        <input value="{{ $user->phone }}" type="text" name="phone" class="form-control"
                            id="userphone">
                    </div>

                    <div class="form-group">
                        <label>Email *</label>
                        <input value="{{ $user->email }}" type="text" name="email" class="form-control"
                            id="useremail">
                    </div>

                    <div class="form-group">
                        <label>Profile Photo </label><br>
                        <div class="input-group">
                            <input type="file" name="profile" id="profilePhoto">
                        </div>
                    </div>

                    <div class="form-group">
                        <button class='btn btn-success btn-md' type="submit" id='savedealer'><i
                                class="fa fa-save fa-lg fa-fw"></i>
                            Save
                        </button>
                        <button class='btn btn-outline-warning btn-md' id='cleardealer'><i
                                class="fa fa-broom fa-lg fa-fw"></i>
                            Clear Fields</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
