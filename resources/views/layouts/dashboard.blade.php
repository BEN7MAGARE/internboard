<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        @yield('title') | Daraja La Mafanikio
    </title>

    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/iziToast.min.css') }}">
    @yield('header_styles')
</head>

<body>
    <div class="d-flex" id="wrapper">

        <div class="bg-dark" id="sidebar">
            <div class="sidebar-header">
                <h3>DALMA Project</h3>
                <p>Data Dashboard</p>
            </div>

            <ul class="list-unstyled components">
                <li class="active">
                    <a href="{{ route('dashboard') }}">
                        <i class="bi bi-speedometer2"></i>
                        Dashboard
                    </a>
                </li>

                <li>
                    <a href="/respondents">
                        <i class="bi bi-people"></i>
                        Respondents
                    </a>
                </li>

                <li>
                    <a href="/users">
                        <i class="bi bi-people"></i>
                        Users
                    </a>
                </li>

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

    <script src="{{ asset('js/main.js') }}"></script>
    <script src="{{ asset('js/iziToast.min.js') }}"></script>
    @yield('footer_scripts')
</body>

</html>
