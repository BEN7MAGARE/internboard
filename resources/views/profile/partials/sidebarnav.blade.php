<div class="card">

    <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

        @if (auth()->user()->image !== null && auth()->user()->image !== '')
            <img src="{{ asset('assets/profilepictures/' . auth()->user()->image) }}" alt="Profile"
                class="rounded-circle">
        @else
            <img src="{{ asset('assets/img/avatar.png') }}" alt="Profile" class="rounded-circle">
        @endif

        <h2>{{ !is_null(auth()->user()->title) ? auth()->user()->title . '. ' . auth()->user()->first_name . ' ' . auth()->user()->last_name : ' ' . auth()->user()->first_name . ' ' . auth()->user()->last_name }}
        </h2>

        <h3>{{ auth()->user()->profile?->specialization }}</h3>

        <div class="social-links mt-2">
            <a href="{{ auth()->user()->twitter }}" class="twitter text-primary"><i class="bi bi-twitter"></i></a>
            <a href="{{ auth()->user()->facebook }}" class="facebook text-primary"><i class="bi bi-facebook"></i></a>
            <a href="{{ auth()->user()->instagram }}" class="instagram text-primary"><i class="bi bi-instagram"></i></a>
            <a href="{{ auth()->user()->linkedin }}" class="linkedin text-primary"><i class="bi bi-linkedin"></i></a>
        </div>

    </div>

    <div class="bg-white">
        <div class="list-group">

            @if (auth()->user()->role === 'student')
                <li class="list-group-item">
                    <a href="{{ route('profile.edit') }}" class="list-group-item-action" aria-current="true">My
                        Profile</a>
                </li>
                <li class="list-group-item {!! (Request::is('applications') ? 'active' : '') !!}">
                    <a href="{{ route('applications.index') }}" class="list-group-item-action">My
                        Applications</a>
                </li>
            @endif

            @if (auth()->user()->role === 'corporate')
                <li class="list-group-item  {!! (Request::is('profile-jobs') ? 'active' : '') !!}">
                    <a href="{{ route('profile.jobs') }}" class="list-group-item-action">My
                        Jobs</a>
                </li>
            @endif

            @if (auth()->user()->role === 'admin')

                <li class="list-group-item {!! (Request::is('students') ? 'active' : '') !!}">
                    <a href="{{ route('profile.students') }}"
                        class="list-group-item-action">Job Seekers</a>
                </li>

                <li class="list-group-item {!! (Request::is('corporates') ? 'active' : '') !!}">
                    <a href="{{ route('profile.corporates') }}"
                        class=" list-group-item-action">Employers/Corporates</a>
                </li>

                <li class="list-group-item {!! (Request::is('opportunities') ? 'active' : '') !!}">
                    <a href="{{ route('profile.opportunities') }}"
                        class="list-group-item-action">Job Opportunities</a>
                </li>

            @endif

            <li class="list-group-item">
                <a href="#" class="list-group-item-action"><i class="fa fa-sign-out text-warning"></i>
                    Logout</a>
            </li>

        </div>
    </div>

</div>
