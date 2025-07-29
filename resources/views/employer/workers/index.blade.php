@extends('layouts.dashboard')

@section('title')
    Workers @parent
@endsection
@section('header_styles')
    <style>
        .imgsection {
            width: 100%;
            height: 200px;
        }

        .imgsection img {
            width: 100%;
            height: 100%;
            border-radius: 50%;
        }
    </style>
@section('subtitle')
    Workers
@endsection

@section('content')
    <main class="container py-4">

        @if ($workers->count() > 0)
            <div class="row">
                @foreach ($workers as $worker)
                    <div class="col-md-3 mb-2">
                        @php
                            $image = $worker->applicant->image ?? 'avatar.png';
                        @endphp
                        <div class="card">
                            <div class="imgsection">
                                <img src="{{ asset('profilepictures/' . $image) }}" class="img-fluid"
                                    alt="{{ $worker->applicant->first_name }} {{ $worker->applicant->last_name }}">
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">{{ $worker->applicant->first_name }}
                                    {{ $worker->applicant->last_name }}
                                </h5>
                                <p class="card-text">{{ $worker->job->title }}</p>
                                <a href="#" class="btn btn-primary btn-sm" data-workerid="{{ $worker->id }}"
                                    id="editWorkerToggle"><i class="bi bi-star-fill"></i> Review&Feedback</a>
                                <a href="#" class="btn btn-danger btn-sm" data-workerid="{{ $worker->id }}"
                                    id="terminateContractToggle"><i class="bi bi-camera-video-off-fill"></i> End
                                    Contract</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">You have not hired any workers yet</h5>
                </div>
            </div>
        @endif

    </main>
@endsection

@section('footer_scripts')
@endsection
