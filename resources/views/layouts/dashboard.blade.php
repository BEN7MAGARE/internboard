<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        @yield('title') | Daraja La Mafanikio
    </title>

    <link href="{{ asset('/images/logo.ico') }}" rel="icon">
    <link href="{{ asset('/images/logo.ico') }}" rel="apple-touch-icon">

    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/iziToast.min.css') }}">
    @yield('header_styles')
</head>

<body>
    <span class="loader" id="loader"></span>
    <div class="d-flex" id="wrapper">

        <div class="bg-dark" id="sidebar">
            <div class="sidebar-header text-center">
                <h5 class="logo">Daraja La Mafanikio</h5>
                {{-- <img src="{{ asset('images/dalma.jpg') }}" alt="Logo" class="img-fluid dashboard-logo"> --}}
                {{-- @if (auth()->user()->role === 'admin')
                <img src="{{ asset('images/logo.jpg') }}" alt="Logo" class="img-fluid dashboard-logo">
                @endif
                @if (auth()->user()->role === 'corporate')
                <img src="{{ asset('corporate_logos/' . auth()->user()->corporate->logo) }}" alt="Logo" class="img-fluid dashboard-logo">
                @endif
                @if (auth()->user()->role === 'college')
                <img src="{{ asset('college_logos/' . auth()->user()->college->logo) }}" alt="Logo" class="img-fluid dashboard-logo">
                @endif
                @if (auth()->user()->role === 'student')
                <img src="{{ asset('profilepictures/' . auth()->user()->student->image) }}" alt="Logo" class="img-fluid dashboard-logo">
                @endif
                @if (auth()->user()->role === 'worker')
                <img src="{{ asset('profilepictures/' . auth()->user()->worker->image) }}" alt="Logo" class="img-fluid dashboard-logo">
                @endif --}}
                <p>({{ auth()->user()->role }})</p>
            </div>

            <ul class="list-unstyled components">

                <li class="{{ Request::is('dashboard') ? 'active' : '' }}">
                    <a href="{{ route('dashboard') }}">
                        <i class="bi bi-speedometer2"></i>
                        Dashboard
                    </a>
                </li>

                @if (auth()->user()->role === 'corporate')
                    <li class="{!! Request::is('profile-jobs') || Request::is('jobs/create') ? 'active' : '' !!}">
                        <a href="{{ route('profile.jobs') }}">
                            <i class="bi bi-briefcase"></i>
                            My Jobs
                        </a>
                    </li>

                    <li class="{!! Request::is('profile/applications') ? 'active' : '' !!}">
                        <a href="{{ route('profile.applications') }}">
                            <i class="bi bi-briefcase"></i>
                            Applications
                        </a>
                    </li>
                @endif

                @if (auth()->user()->role === 'student')
                    <li class="{!! Request::is('applications') ? 'active' : '' !!}">
                        <a href="{{ route('applications.index') }}"><i class="bi bi-window"></i>&nbsp;My
                            Applications</a>
                    </li>
                @endif

                @if (auth()->user()->role === 'college')
                    <li class="list-group-item  {!! Request::is('students') ? 'active' : '' !!}">
                        <a href="{{ route('students.index') }}"><i class="bi bi-people"></i>&nbsp;Students</a>
                    </li>

                    <li class="list-group-item  {!! Request::is('college-applications') ? 'active' : '' !!}">
                        <a href="{{ route('college.applications') }}"><i
                                class="bi bi-window"></i>&nbsp;Applications</a>
                    </li>
                @endif

                @if (auth()->user()->role === 'admin')
                    <li class="{!! Request::is('users') ? 'active' : '' !!}">
                        <a href="{{ route('users.index') }}">
                            <i class="bi bi-people"></i>
                            Users
                        </a>
                    </li>

                    <li class="{!! Request::is('students') ? 'active' : '' !!}">
                        <a href="{{ route('students.index') }}">
                            <i class="bi bi-people"></i>
                            Students
                        </a>
                    </li>

                    <li class="{!! Request::is('colleges') ? 'active' : '' !!}">
                        <a href="{{ route('colleges.index') }}">
                            <i class="bi bi-building"></i>
                            Colleges
                        </a>
                    </li>

                    <li class="{!! Request::is('corporates') ? 'active' : '' !!}">
                        <a href="{{ route('corporates.index') }}">
                            <i class="bi bi-briefcase"></i>
                            Corporates / Business
                        </a>
                    </li>

                    <li class="{!! Request::is('categories') ? 'active' : '' !!}">
                        <a href="{{ route('categories.index') }}">
                            <i class="bi bi-list"></i>
                            Job Categories
                        </a>
                    </li>
                @endif
                <li class="list-group-item {!! Request::is('profile') ||
                Request::is('corporate/create') ||
                Request::is('corporate/edit') ||
                Request::is('corporate')
                    ? 'active'
                    : '' !!}">
                    <a href="{{ route('profile.edit') }}" aria-current="true">
                        <i class="bi bi-person"></i>&nbsp;My Profile
                    </a>
                </li>

                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a class="dropdown-item text-danger" href="route('logout')"
                            onclick="event.preventDefault();
                        this.closest('form').submit();"><i
                                class="bi bi-box-arrow-right text-danger"></i>&nbsp;Logout
                        </a>
                    </form>
                </li>

            </ul>
        </div>

        <!-- Page Content -->
        <div id="content">

            <nav class="navbar navbar-expand-lg">
                <div class="container-fluid">
                    <button class="btn btn-primary" id="sidebarToggle">
                        <i class="bi bi-list"></i>
                    </button>
                    <h4 class="ms-3 mb-0">@yield('subtitle')</h4>
                    <div class="ms-auto d-flex align-items-center">
                        <span class="me-3">
                            <i class="bi bi-calendar me-1"></i>
                            {{ \Carbon\Carbon::now()->format('l, F j, Y') }}
                        </span>
                    </div>
                </div>
            </nav>

            @yield('content')
        </div>
    </div>

    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>
    <script src="{{ asset('js/iziToast.min.js') }}"></script>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    @yield('footer_scripts')
</body>

</html>
