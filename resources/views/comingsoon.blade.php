@extends('layouts.main')

@section('title')
    Contact @parent
@endsection

@section('content')
    <section class="w3l-about-breadcrumb">
        <div class="breadcrumb-bg breadcrumb-bg-about">
            <div class="container py-lg-5 py-sm-4">
                <div class="w3breadcrumb-gids text-center">
                    <div class="w3breadcrumb-info mt-5">
                        <h2 class="w3ltop-title pt-4">Coming Soon</h2>
                        <ul class="breadcrumbs-custom-path">
                            <li><a href="{{ url('/') }}">Home</a></li>
                            <li class="active"><span class="fas fa-angle-double-right mx-2"></span> Coming Soon</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="w3l-contact-1 py-5 text-center" id="contact">
        <div class="container">
            <div class="alert alert-danger">
                <h1 class="text-danger">This page is coming soon</h1>
            </div>
        </div>
    </section>
@endsection
