<div>

    <div class="profile-card pt-4 d-flex flex-column align-items-center">
        @if (auth()->user()->image !== null)
            <img src="{{ asset('profilepictures/' . auth()->user()->image) }}" alt="Profile"
                class="rounded-circle img-fluid">
        @else
            <img src="{{ asset('images/avatar.png') }}" alt="Profile" class="rounded-circle img-fluid">
        @endif
        <div id="profileImageChange"></div>
        <form action="#" method="post" id="changeUserImageForm">
            @csrf
            <input type="file" id="profileImageUpload" style="display: none;" accept="image/*">
            <div id="profileImageChangeFeedback"></div>
        </form>
        <a href="#" class="btn btn-secondary btn-sm mt-1" id="changeProfileImageToggle"><i
                class="fa fa-edit"></i></a>
        <h4 class="text-center">
            {{ !is_null(auth()->user()->title) ? auth()->user()->title . '. ' . auth()->user()->first_name . ' ' . auth()->user()->last_name : ' ' . auth()->user()->first_name . ' ' . auth()->user()->last_name }}
        </h4>
        <small>({{ auth()->user()->role }})</small>

        <h6>{{ auth()->user()->email }}</h6>
        <h6>Tel: {{ auth()->user()->phone }} </h6>

        <div class="">
            <a href="#" class="twitter"><i class="fa fa-twitter"></i></a>
            <a href="#" class="facebook"><i class="fa fa-facebook"></i></a>
            <a href="#" class="instagram"><i class="fa fa-instagram"></i></a>
            <a href="#" class="linkedin"><i class="fa fa-linkedin"></i></a>
        </div>

    </div>

    <div class="mt-2 mb-3">
        <div class="list-group">
            <li class="list-group-item {!! Request::is('profile') ? 'active' : '' !!}">
                <a href="{{ route('profile.edit') }}" aria-current="true"><i
                        class="fa fa-user"></i>&nbsp;My Profile</a>
            </li>
            @if (auth()->user()->role === 'student' || auth()->user()->role == 'worker')
                <li class="list-group-item {!! Request::is('applications') ? 'active' : '' !!}">
                    <a href="{{ route('applications.index') }}"><i
                            class="fa fa-window-maximize"></i>&nbsp;My Applications</a>
                </li>
            @endif

            @if (auth()->user()->role === 'corporate')
                <li class="list-group-item  {!! Request::is('profile-jobs') ? 'active' : '' !!}">
                    <a href="{{ route('profile.jobs') }}"><i class="fa fa-window-maximize"></i>&nbsp;My
                        Jobs</a>
                </li>
            @endif

            @if (auth()->user()->role === 'college')
                <li class="list-group-item  {!! Request::is('college-dashboard') ? 'active' : '' !!}">
                    <a href="{{ route('college.dashboard') }}"><i
                            class="fa fa-window-maximize"></i>&nbsp;Dashboard</a>
                </li>

                <li class="list-group-item  {!! Request::is('college-students') ? 'active' : '' !!}">
                    <a href="{{ route('college.students') }}"><i class="fa fa-users"></i>&nbsp;My
                        Students</a>
                </li>
            @endif

            @if (auth()->user()->role === 'admin')
                <li class="list-group-item {!! Request::is('students') ? 'active' : '' !!}">
                    <a href="{{ route('profile.students') }}"><i class="fa fa-users"></i> Job Seekers</a>
                </li>

                <li class="list-group-item {!! Request::is('corporates') ? 'active' : '' !!}">
                    <a href="{{ route('profile.corporates') }}">
                        <i class="fa fa-acquisitions-incorporated"></i>&nbsp;Employers/Corporates
                    </a>
                </li>

                <li class="list-group-item {!! Request::is('opportunities') ? 'active' : '' !!}">
                    <a href="{{ route('profile.opportunities') }}"><i class="fa fa-window-maximize"></i>&nbsp;Job
                        Opportunities</a>
                </li>
            @endif

            <li class="list-group-item">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="route('logout')" class="list-group-item-action text-danger"
                        onclick="event.preventDefault();
                                this.closest('form').submit();"><i
                            class="fa fa-sign-out-alt"></i>
                        {{ __('Log Out') }}
                    </a>
                </form>
            </li>

        </div>
    </div>

</div>
