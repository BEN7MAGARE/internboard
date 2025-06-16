@extends('layouts.main')

@section('title')
    Contact @parent
@endsection

@section('header_styles')
    <link rel="stylesheet" href="{{ asset('css/iziToast.min.css') }}">
@endsection

@section('content')
    <main class="main">

        <div class="page-title mt-5" data-aos="fade">
            <div class="heading mt-3">
                <div class="container">
                    <div class="row d-flex justify-content-center text-center">
                        <div class="col-lg-8">
                            <h1 class="translatable">Contact Us</h1>
                            <p class="mb-0 translatable">Get in touch with us for any inquiries, questions or sponsorships.</p>
                        </div>
                    </div>
                </div>
            </div>
            <nav class="breadcrumbs">
                <div class="container">
                    <ol>
                        <li><a href="{{ route('home') }}" class="translatable">Home</a></li>
                        <li class="current translatable">Contact Us</li>
                    </ol>
                </div>
            </nav>
        </div>

        <section id="contact" class="contact section">

            <div class="container section-title" data-aos="fade-up">
                <h2 class="translatable">Contact</h2>
                <p class="translatable">Get in touch with us for any inquiries, questions or sponsorships. </p>
            </div>

            <div class="container-fluid" data-aos="fade-up" data-aos-delay="100">

                <div class="row gy-4">

                    <div class="col-lg-6">

                        <div class="row gy-4">
                            <div class="col-md-6">
                                <div class="info-item" data-aos="fade" data-aos-delay="200">
                                    <i class="bi bi-geo-alt"></i>
                                    <h3 class="translatable">Address</h3>
                                    <p>{{ config('app.physicalAddress') }}</p>
                                    <p>{{ config('app.city') }}, {{ config('app.country') }}</p>
                                    <p>{{ config('app.postal') }}</p>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="info-item" data-aos="fade" data-aos-delay="300">
                                    <i class="bi bi-telephone"></i>
                                    <h3 class="translatable">Call Us</h3>
                                    <p>{{ config('app.phone') }}</p>
                                    <p>{{ config('app.phone2') }}</p>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="info-item" data-aos="fade" data-aos-delay="400">
                                    <i class="bi bi-envelope"></i>
                                    <h3 class="translatable">Email Us</h3>
                                    <p>{{ config('app.email') }}</p>
                                    <p>{{ config('app.email2') }}</p>
                                    <p>{{ config('app.email3') }}</p>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="info-item" data-aos="fade" data-aos-delay="500">
                                    <i class="bi bi-clock"></i>
                                    <h3 class="translatable">Open Hours</h3>
                                    <p class="translatable">Monday - Friday</p>
                                    <p class="translatable">9:00AM - 05:00PM</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <form action="{{ url('contact') }}" method="post" id="contactForm">
                            @csrf
                            <div class="row gy-4">

                                <div class="col-md-6">
                                    <input type="text" name="name" class="form-control" placeholder="Your Name"
                                        required="">
                                </div>

                                <div class="col-md-6 ">
                                    <input type="email" class="form-control" name="email" placeholder="Your Email"
                                        required="">
                                </div>

                                <div class="col-12">
                                    <input type="text" class="form-control" name="subject" placeholder="Subject"
                                        required="">
                                </div>

                                <div class="col-12">
                                    <textarea class="form-control" name="message" rows="6" placeholder="Message" required=""></textarea>
                                </div>
                                <div id="contactFeedback"></div>

                                <div class="col-12 text-center">
                                    <button type="submit" class="btn btn-primary translatable">Send Message</button>
                                </div>

                            </div>
                        </form>
                    </div>

                </div>

                <div class="col-lg-12 mt-5">
                    <div class="map-content-9">
                        <div class="map-iframe">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3988.7729623486393!2d36.86269287478946!3d-1.3116050356539344!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x182f1103fb66eb3b%3A0x92b41c137f85d6a7!2sMukuru%20Slums%20Devevelopment%20Projects%2C%20(MSDP%20Kenya)!5e0!3m2!1sen!2ske!4v1747042979989!5m2!1sen!2ske"
                                width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                </div>

            </div>

        </section>

    </main>
@endsection

@section('footer_scripts')
    <script src="{{ asset('js/iziToast.min.js') }}"></script>
    <script src="{{ asset('js/functions.js') }}"></script>
    <script src="{{ asset('js/contact.js') }}"></script>
@endsection
