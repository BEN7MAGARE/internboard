@extends('layouts.app')

@section('title')
    Jobs @parent
@endsection

@section('header_styles')
<style>
    .skills span {
        background: #E5E7E9;
        padding: 4px 5px 5px 5px;
        border-radius: 10px;
        margin-right: .5em;
    }
    .location i {
        color: #C70039;
    }
    .job {
        padding: 5px;
        /* border-radius: 10px; */
        border-bottom: 1px solid #EAEDED;
    }
    .job:hover{
        background: #F2F4F4;
        cursor: pointer;
    }
</style>
@endsection

@section('content')
    <main id="main">
        <section class="job-section">
            <div class="container mt-2 mb-2">

                <div class="input-group mb-4">
                    <input type="text" class="form-control" placeholder="Search">
                    <div class="input-group-append">
                        <span class="input-group-text" style="background: #C70039; color: #fff;">
                            <i class="fa fa-search"></i> <!-- Replace with your desired icon class -->
                        </span>
                    </div>
                </div>

                <div class="">
                    <div class="card">
                        <div class="card-header bg-white">
                            <h2 class="mt-3 mb-3"><b>Jobs You May Like</b></h2>
                        </div>
                        <div class="card-body" id="jobrendersection">

                            {{-- <div class="job"><div class="title mt-2 mb-2"><h3>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Qui, nulla.</h3></div><div class="salary mb-2"><span>Monthly: Ksh. 5000</span></div><div class="desciption"><p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Soluta amet numquam obcaecati quod, fugiat optio non molestias tempora, consequuntur perspiciatis saepe error eius quam consectetur molestiae est architecto. Repellat ea enim quisquam, porro doloremque soluta dicta. Odit temporibus nihil veritatis?</p></div><div class="skills"><span>Web Development</span><span>API design</span><span>Responsive design</span><span>Javascript</span><span>HTML</span><span>CSS</span></div><div class="location mt-3"><i class="fa-solid fa-location-dot"></i> <span>Westlands Nairobi, Kenya</span></div></div> --}}


                        </div>
                    </div>

                </div>
            </div>
        </section>
    </main>
@endsection

@section('footer_scripts')
    <script src="{{ asset('assets/js/job.js') }}"></script>
@endsection
