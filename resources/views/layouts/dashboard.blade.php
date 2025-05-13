<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        @yield('title') | Daraja La Mafanikio
    </title>

    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/iziToast.min.css') }}">
    @yield('header_styles')
</head>

<body>
    <div class="d-flex" id="wrapper">

        <div class="bg-dark" id="sidebar">
            <div class="sidebar-header">
                <h3>DALMA Project</h3>
                <p>{{ auth()->user()->role }}</p>
            </div>

            <ul class="list-unstyled components">

                <li class="active">
                    <a href="{{ route('dashboard') }}">
                        <i class="bi bi-speedometer2"></i>
                        Dashboard
                    </a>
                </li>
                @if (auth()->user()->role === 'corporate')
                <li>
                    <a href="{{ route('profile.jobs') }}">
                        <i class="bi bi-briefcase"></i>
                        My Jobs
                    </a>
                </li>

                <li>
                    <a href="{{ route('profile.applications') }}">
                        <i class="bi bi-briefcase"></i>
                        Applications
                    </a>
                </li>
                
                @endif

                @if (auth()->user()->role === 'admin')
                <li>
                    <a href="{{ route('users') }}">
                        <i class="bi bi-people"></i>
                        Users
                    </a>
                </li>
                @endif

                <li>
                    <a href="/logout" class="text-danger">
                        <i class="bi bi-box-arrow-right text-danger"></i>
                        Logout
                    </a>
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

    <script src="{{ asset('js/script.js') }}"></script>
    <script src="{{ asset('js/iziToast.min.js') }}"></script>
    @yield('footer_scripts')
</body>

</html>
