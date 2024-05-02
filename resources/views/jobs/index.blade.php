@extends('layouts.app')

@section('title')
    Jobs @parent
@endsection

@section('header_styles')

@endsection

@section('content')
    <main id="main">
        <section class="job-section">
            <div class="container mt-2 mb-2">

                <div class="input-group mb-4">
                    <input type="text" class="form-control" placeholder="Search">
                    <div class="input-group-append">
                        <span class="input-group-text" style="background: #C70039; color: #fff;">
                            <i class="fa fa-search"></i>
                        </span>
                    </div>
                </div>

                <div class="">
                    <div class="card">
                        <div class="card-header bg-white">
                            <h2 class="mt-3 mb-3"><b>Opportunities You May Like</b></h2>
                        </div>
                        <div class="card-body" id="jobrendersection">

                            {{-- <div class="job"><div class="title mt-2 mb-2"><h3>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Qui, nulla.</h3></div><div class="salary mb-2"><span>Monthly: Ksh. 5000</span></div><div class="desciption"><p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Soluta amet numquam obcaecati quod, fugiat optio non molestias tempora, consequuntur perspiciatis saepe error eius quam consectetur molestiae est architecto. Repellat ea enim quisquam, porro doloremque soluta dicta. Odit temporibus nihil veritatis?</p></div><div class="skills"><span>Web Development</span><span>API design</span><span>Responsive design</span><span>Javascript</span><span>HTML</span><span>CSS</span></div><div class="location mt-3 d-flex justify-content-between"><div><i class="fa-solid fa-location-dot"></i> <span>Westlands Nairobi, Kenya</span></div><div>2023 -08 -23</div></div></div> --}}

                        </div>
                    </div>

                </div>
            </div>
        </section>
    </main>

    <div class="modal fade" id="jobDetailsModalToggle" aria-hidden="true" aria-labelledby="jobDetailsModalToggleLabel"
        tabindex="-1">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-primary" id="jobModalTitle"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="jobDetailsSection">

                </div>

                <div class="modal-footer" id="jobActionSection">

                </div>
            </div>
        </div>
    </div>
@endsection


@section('footer_scripts')
    <script src="{{ asset('assets/js/moment.min.js') }}"></script>
    <script src="{{ asset('assets/js/job.js') }}"></script>
@endsection
