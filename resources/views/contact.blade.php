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
                        <h2 class="w3ltop-title pt-4">Contact Us</h2>
                        <ul class="breadcrumbs-custom-path">
                            <li><a href="{{ url('/') }}">Home</a></li>
                            <li class="active"><span class="fas fa-angle-double-right mx-2"></span> Contact</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="w3l-contact-1 py-5" id="contact">
        <div class="contacts-9 py-lg-5 py-md-4">
            <div class="container">
                <div class="row contact-view">
                    <div class="col-lg-5 cont-details pe-lg-5">
                        <div class="contactct-fm-text text-left">
                            <h6 class="title-subhny">Say Hello</h6>
                            <h3 class="title-w3l mb-2">Get In Touch
                            </h3>
                            <p class="mb-sm-5 mb-4">

                            </p>
                            <div class="cont-top">
                                <div class="cont-left text-center">
                                    <span class="fas fa-phone-alt"></span>
                                </div>
                                <div class="cont-right">
                                    <h5>Phone number</h5>
                                    <p><a href=""></a></p>
                                </div>
                            </div>
                            <div class="cont-top margin-up">
                                <div class="cont-left text-center">
                                    <span class="fas fa-envelope-open-text"></span>
                                </div>
                                <div class="cont-right">
                                    <h5>Send Email</h5>
                                    <p><a href="mailto:dalma-project@tukenya.ac.ke" class="mail">dalma-project@tukenya.ac.ke</a>
                                    </p>
                                </div>
                            </div>
                            <div class="cont-top margin-up">
                                <div class="cont-left text-center">
                                    <span class="fas fa-map-marker-alt"></span>
                                </div>
                                <div class="cont-right">
                                    <h5>Office Address</h5>
                                    <p class="pr-lg-5">Haile Salesie Avenue,<br> Nairobi, Kenya.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7 cont-details mt-lg-0 mt-5">
                        <div class="map-content-9">
                            <div class="map-iframe">
                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3988.8051498733253!2d36.820422777559834!3d-1.2912535322456247!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x182f10df5a23385d%3A0x15238033c2bcdc3b!2sThe%20Technical%20University%20Of%20Kenya!5e0!3m2!1sen!2ske!4v1732188062688!5m2!1sen!2ske" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    
    <section class="w3l-contact-1 w3hny-form-btm py-5" id="contact">
        <div class="contacts-9 py-lg-5 py-md-4">
            <div class="container">
                <div class="header-sec text-center mb-5">
                    <h6 class="title-subhny mb-2">Write Us</h6>
                    <h3 class="title-w3l">
                        Don't hesitate to contact us <br> anytime with questions
                    </h3>
                </div>

                <div class="contactct-fm map-content-9">
                    <form action="#" class="pt-lg-4" method="post">
                        <div class="twice-two">
                            <input type="text" class="form-control" name="w3lName" id="w3lName" placeholder="Name"
                                required="">
                            <input type="email" class="form-control" name="w3lSender" id="w3lSender" placeholder="Email"
                                required="">
                            <input type="text" class="form-control" name="w3lSubject" id="w3lSubject"
                                placeholder="Subject" required="">
                        </div>

                        <textarea name="w3lMessage" class="form-control" id="w3lMessage" placeholder="Message" required=""></textarea>
                        <div class="text-lg-center">
                            <button type="submit" class="btn btn-primary btn-style mt-lg-5 mt-4">Send Message</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </section>
@endsection
