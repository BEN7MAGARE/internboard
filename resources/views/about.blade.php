@extends('layouts.main')

@section('title')
    About Us @parent
@endsection

@section('content')
    <section class="w3l-about-breadcrumb">
        <div class="breadcrumb-bg breadcrumb-bg-about">
            <div class="container py-lg-5 py-sm-4">
                <div class="w3breadcrumb-gids text-center">
                    <div class="w3breadcrumb-info mt-5">
                        <h2 class="w3ltop-title pt-4">About Us</h2>
                        <ul class="breadcrumbs-custom-path">
                            <li><a href="index.html">Home</a></li>
                            <li class="active"><span class="fas fa-angle-double-right mx-2"></span> About </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="w3l-feature-with-photo-1">
        <div class="feature-with-photo-hny py-5">
            <div class="container py-lg-5">
                <div class="feature-with-photo-content">
                    <div class="ab-in-flow row mb-lg-5 mb-3">

                        <div class="col-lg-7 ab-right pl-lg-5">
                            <h6 class="title-subhny mb-2"><span>About Us</span></h6>
                            <h3 class="title-w3l mb-4">We’ve skilled in wide range of web and other digital market tools &
                                designs.

                            </h3>
                            <p class="mt-4">Excepteur sint occaecat non proident, sunt in culpa quis. Phasellus lacinia
                                id
                                erat eu ullamcorper. Nunc id ipsum fringilla,
                                gravida felis vitae. Phasellus lacinia id, sunt in culpa quis. Phasellus lacinia Excepteur
                                sint occaecat
                                non proident, sunt in culpa quis.Nunc id ipsum fringilla.</p>

                            <div class="w3l-buttons mt-sm-5 mt-4">
                                <a class="btn btn-primary btn-style me-2" href="about.html">Read More </a>
                                <a class="btn btn-outline-primary btn-style mr-2" href="services.html">Services </a>
                            </div>
                        </div>
                        <div class="col-lg-5 ab-left ps-lg-5">
                            <img src="assets/images/ab1.jpg" class="img-fluid radius-image" alt="">
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>


    <section class="w3l-products py-5" id="tabs">
        <div class="container py-lg-5 py-md-4 py-2">
            <div class="header-sec mx-auto text-center">
                <h6 class="title-subhny mb-2">We Provide</h6>
                <h3 class="title-w3l mb-5">Specialization in developing<br> business strategy
                </h3>
            </div>
            <div class="row">
                <div class="col-lg-12 mx-auto">
                    <div id="parentHorizontalTab">
                        <ul class="resp-tabs-list hor_1 mb-2">
                            <li>What we do</li>
                            <li>Our Mission</li>
                            <li>Social impact</li>
                            <li>Marketing</li>
                            <div class="clear"></div>
                        </ul>
                        <div class="resp-tabs-container hor_1">
                            <div class="products-content">
                                <div class="row mt-4">
                                    <div class="col-lg-6 tabw3-left">
                                        <h4 class="head">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                                            eiusmod tempor
                                            incididunt ut labore et dolore </h4>
                                        <p>Lorem ipsum dolor sit amet, elit. Id ab commodi impedit magnam sint voluptates.
                                            Minima velit expedita maiores, sit at in!</p>
                                        <ul class="w3l-right-book mt-4">
                                            <li><span class="fa fa-check" aria-hidden="true"></span>Always Fast and friendly
                                                support</li>
                                            <li><span class="fa fa-check" aria-hidden="true"></span>We offer wide range of
                                                skills</li>
                                            <li><span class="fa fa-check" aria-hidden="true"></span>We help
                                                analyze,transform business models</li>
                                            <li><span class="fa fa-check" aria-hidden="true"></span>Experienced Professional
                                                Team</li>
                                            <li><span class="fa fa-check" aria-hidden="true"></span>consulting services
                                                include project management</li>
                                            <li><span class="fa fa-check" aria-hidden="true"></span>Manage your workflow and
                                                tasks successfully</li>
                                        </ul>
                                    </div>
                                    <div class="col-lg-6 tabw3-right ps-lg-5 mt-lg-0 mt-5">
                                        <img src="assets/images/g9.jpg" class="img-fluid radius-image" alt="">
                                    </div>
                                </div>
                            </div>
                            <div class="products-content">
                                <div class="row mt-4">
                                    <div class="col-lg-6 tabw3-right">
                                        <img src="assets/images/g3.jpg" class="img-fluid radius-image" alt="">
                                    </div>
                                    <div class="col-lg-6 tabw3-left ps-lg-5 mt-lg-0 mt-5">
                                        <h4 class="head">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                                            eiusmod tempor
                                            incididunt ut labore et dolore </h4>
                                        <p>Lorem ipsum dolor sit amet, elit. Id ab commodi impedit magnam sint voluptates.
                                            Minima velit expedita maiores, sit at in!</p>
                                        <ul class="w3l-right-book mt-4">
                                            <li><span class="fa fa-check" aria-hidden="true"></span>Always Fast and friendly
                                                support</li>
                                            <li><span class="fa fa-check" aria-hidden="true"></span>Experienced Professional
                                                Team</li>
                                            <li><span class="fa fa-check" aria-hidden="true"></span>Always Fast and friendly
                                                support</li>
                                            <li><span class="fa fa-check" aria-hidden="true"></span>Experienced Professional
                                                Team</li>
                                        </ul>
                                    </div>

                                </div>
                            </div>
                            <div class="products-content">
                                <div class="row mt-4">

                                    <div class="col-lg-6 tabw3-left">
                                        <h4 class="head">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                                            eiusmod tempor
                                            incididunt ut labore et dolore </h4>
                                        <p>Lorem ipsum dolor sit amet, elit. Id ab commodi impedit magnam sint voluptates.
                                            Minima velit expedita maiores, sit at in!</p>
                                        <ul class="w3l-right-book mt-4">
                                            <li><span class="fa fa-check" aria-hidden="true"></span>Always Fast and friendly
                                                support</li>
                                            <li><span class="fa fa-check" aria-hidden="true"></span>We offer wide range of
                                                skills</li>
                                            <li><span class="fa fa-check" aria-hidden="true"></span>We help
                                                analyze,transform business models</li>
                                            <li><span class="fa fa-check" aria-hidden="true"></span>Experienced Professional
                                                Team</li>
                                            <li><span class="fa fa-check" aria-hidden="true"></span>consulting services
                                                include project management</li>
                                            <li><span class="fa fa-check" aria-hidden="true"></span>Manage your workflow and
                                                tasks successfully</li>
                                        </ul>
                                    </div>
                                    <div class="col-lg-6 tabw3-right ps-lg-5 mt-lg-0 mt-5">
                                        <img src="{{ asset('images/g8.jpg') }}" class="img-fluid radius-image" alt="">
                                    </div>
                                </div>
                            </div>
                            <div class="products-content">
                                <div class="row mt-4">
                                    <div class="col-lg-6 tabw3-right">
                                        <img src="assets/images/g7.jpg" class="img-fluid radius-image" alt="">
                                    </div>
                                    <div class="col-lg-6 tabw3-left ps-lg-5 mt-lg-0 mt-5">
                                        <h4 class="head">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                                            eiusmod tempor
                                            incididunt ut labore et dolore </h4>
                                        <p>Lorem ipsum dolor sit amet, elit. Id ab commodi impedit magnam sint voluptates.
                                            Minima velit expedita maiores, sit at in!</p>
                                        <ul class="w3l-right-book mt-4">
                                            <li><span class="fa fa-check" aria-hidden="true"></span>Always Fast and
                                                friendly support</li>
                                            <li><span class="fa fa-check" aria-hidden="true"></span>Experienced
                                                Professional Team</li>
                                            <li><span class="fa fa-check" aria-hidden="true"></span>Always Fast and
                                                friendly support</li>
                                            <li><span class="fa fa-check" aria-hidden="true"></span>Experienced
                                                Professional Team</li>
                                        </ul>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="w3l-servicesblock w3l-servicesblock1 py-5" id="progress">
        <div class="container py-lg-5 py-md-4 py-2">
            <div class="row">
                <div class="col-lg-6 mb-lg-0 mb-5 pe-lg-5">
                    <h6 class="title-subhny mb-2">Progress Bars</h6>

                    <h3 class="title-w3l">The growth accelerator for startups</h3>
                    <p class="mt-md-4 mt-3">Lorem ipsum viverra feugiat. Pellen tesque libero ut justo,
                        ultrices in ligula. Semper at. Lorem ipsum dolor sit amet
                        elit. Non quae, fugiat nihil ad. Lorem ipsum dolor sit amet. Lorem ipsum init
                        dolor sit, amet elit. Dolor ipsum non velit, culpa! elit ut et.</p>

                </div>
                <div class="col-lg-6 align-self pe-lg-4">
                    <div class="progress-info info1">
                        <h6 class="progress-tittle">Design <span class="">66%</span></h6>
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped" role="progressbar" style="width:66%"
                                aria-valuenow="66" aria-valuemin="0" aria-valuemax="100">
                            </div>
                        </div>
                    </div>
                    <div class="progress-info info1">
                        <h6 class="progress-tittle">Development <span class="">70%</span></h6>
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped" role="progressbar" style="width:70%"
                                aria-valuenow="70" aria-valuemin="0" aria-valuemax="100">
                            </div>
                        </div>
                    </div>
                    <div class="progress-info info2">
                        <h6 class="progress-tittle">PHP <span class="">80%</span>
                        </h6>
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped" role="progressbar" style="width:80%"
                                aria-valuenow="80" aria-valuemin="0" aria-valuemax="100">
                            </div>
                        </div>
                    </div>
                    <div class="progress-info info3">
                        <h6 class="progress-tittle">Art Direction <span class="">90%</span></h6>
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped" role="progressbar" style="width: 90%"
                                aria-valuenow="90" aria-valuemin="0" aria-valuemax="100">
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>


    <div class="w3l-team-main py-5" id="team">
        <div class="container py-md-5 py-3">
            <div class="header-secw3 text-center">
                <div class="header-secw3 text-center">
                    <h6 class="title-subhny mb-2">Our Team</h6>
                    <h3 class="title-w3l mb-3">
                        Creative Team
                    </h3>
                </div>

            </div>
            <div class="row w3ls_team_grids text-center">
                <div class="col-md-3 col-6 w3_agile_team_grid mt-md-5 mt-4">
                    <div class="box4">
                        <a href="#"> <img src="assets/images/team1.jpg" alt=" "
                                class="img-fluid radius-image"></a>
                        <div class="box-content">
                            <h3 class="title">Web Developer</h3>
                            <ul class="icon">
                                <li><a href="#" class="fab fa-facebook-f"></a></li>
                                <li><a href="#" class="fab fa-instagram"></a></li>
                            </ul>
                        </div>
                    </div>

                    <h4><a href="#url" class="title-head">
                            Glendell Paul</a></h4>
                    <p>Lorem ipsum</p>
                </div>
                <div class="col-md-3 col-6 w3_agile_team_grid mt-md-5 mt-4">
                    <div class="box4">
                        <a href="#"> <img src="assets/images/team2.jpg" alt=" "
                                class="img-fluid radius-image"></a>
                        <div class="box-content">
                            <h3 class="title">Editor</h3>
                            <ul class="icon">
                                <li><a href="#" class="fab fa-facebook-f"></a></li>
                                <li><a href="#" class="fab fa-instagram"></a></li>
                            </ul>
                        </div>
                    </div>
                    <h4><a href="#url" class="title-head">
                            Dania Ruthor</a></h4>
                    <p>Lorem ipsum</p>
                </div>
                <div class="col-md-3 col-6 w3_agile_team_grid mt-md-5 mt-4">
                    <div class="box4">
                        <a href="#"> <img src="assets/images/team3.jpg" alt=" "
                                class="img-fluid radius-image"></a>
                        <div class="box-content">
                            <h3 class="title">UX Designer</h3>
                            <ul class="icon">
                                <li><a href="#" class="fab fa-facebook-f"></a></li>
                                <li><a href="#" class="fab fa-instagram"></a></li>
                            </ul>
                        </div>
                    </div>
                    <h4><a href="#url" class="title-head">
                            Gambria Rich</a></h4>
                    <p>Lorem ipsum</p>
                </div>
                <div class="col-md-3 col-6 w3_agile_team_grid mt-md-5 mt-4">
                    <div class="box4">
                        <a href="#"> <img src="assets/images/team4.jpg" alt=" "
                                class="img-fluid radius-image"></a>
                        <div class="box-content">
                            <h3 class="title">Web Designer</h3>
                            <ul class="icon">
                                <li><a href="#" class="fab fa-facebook-f"></a></li>
                                <li><a href="#" class="fab fa-instagram"></a></li>
                            </ul>
                        </div>
                    </div>
                    <h4><a href="#url" class="title-head">
                            Laura Carl</a></h4>
                    <p>Lorem ipsum</p>
                </div>

            </div>
        </div>
    </div>


    <section class="w3l-project-main">
        <div class="container">
            <div class="w3l-project py-md-5 py-4">
                <div class="row py-5 align-items-center">
                    <div class="col-lg-8 w3l-project-right">
                        <div class="bottom-info">
                            <div class="header-section pr-lg-5">
                                <h6 class="title-subhny mb-2">Consultation</h6>
                                <h3 class="title-w3l">Request Free Consultation <br>Lets Do It!
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 w3l-project-left about-w3page-btns mt-lg-0 mt-4">
                        <div class="w3l-buttons d-sm-flex">
                            <a class="btn btn-primary btn-style me-2" href="about.html">Read More </a>
                            <a class="btn btn-outline-primary btn-style" href="contact.html">Contact Us </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
