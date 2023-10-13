@extends('layouts.app')

@section('title')
    Job Apply
@endsection

@section('header_styles')
    <link rel="stylesheet" href="{{ asset('assets/css/select2.min.css') }}">

    <style>
        .step-2 {
            display: none;
        }
    </style>
@endsection

@section('content')
    <main id="main">
        <div class="breadcrumbs">
            {{-- <div class="page-header d-flex align-items-center" style="background-image: url('');">
                <div class="container position-relative">
                    <div class="row d-flex justify-content-center">
                        <div class="col-lg-6 text-center">
                            <h2>Portfolio Details</h2>
                            <p></p>
                        </div>
                    </div>
                </div>
            </div> --}}
            <nav>
                <div class="container">
                    <ol>
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li>Apply</li>
                    </ol>
                </div>
            </nav>
        </div>

        <section class="job-section">
            <div class="container d-flex align-items-center justify-content-center">
                
            </div>
        </section>
    </main>
@endsection

@section('footer_scripts')
    <script src="{{ asset('assets/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/create.js') }}"></script>
@endsection
