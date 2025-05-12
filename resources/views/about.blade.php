@extends('layouts.main')

@section('title')
    About Us @parent
@endsection

@section('content')
    
  <main class="main">

<!-- Page Title -->
<div class="page-title mt-5" data-aos="fade">
  <div class="heading mt-3">
    <div class="container">
      <div class="row d-flex justify-content-center text-center">
        <div class="col-lg-8">
          <h1>About Us</h1>
          <p class="mb-0">Empowering TVET graduates from Informal Settlements in Kenya.</p>
        </div>
      </div>
    </div>
  </div>
  <nav class="breadcrumbs">
    <div class="container">
      <ol>
        <li><a href="{{ route('home') }}">Home</a></li>
        <li class="current">About Us</li>
      </ol>
    </div>
  </nav>
</div><!-- End Page Title -->

<!-- Service Details Section -->
<section id="service-details" class="service-details section">

  <div class="container-fluid">

    <div class="row gy-5">

      <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">

        <div class="service-box">
          <h4>Our Services</h4>
          <div class="services-list">
            <a href="#" class="active"><i class="bi bi-arrow-right-circle"></i><span>Employability and Entrepreneurship Training</span></a>
            <a href="#"><i class="bi bi-arrow-right-circle"></i><span>Linking TVET graduates to employment opportunities</span></a>
            <a href="#"><i class="bi bi-arrow-right-circle"></i><span>Youth Empowerment and Sponsorship</span></a>
            <a href="#"><i class="bi bi-arrow-right-circle"></i><span>TVET Skills Development</span></a>
            <a href="#"><i class="bi bi-arrow-right-circle"></i><span>Marketing</span></a>
          </div>
        </div>

        <div class="service-box">
          <h4>Download Catalog</h4>
          <div class="download-catalog">
            <a href="#"><i class="bi bi-filetype-pdf"></i><span>Catalog PDF</span></a>
            <a href="#"><i class="bi bi-file-earmark-word"></i><span>Catalog DOC</span></a>
          </div>
        </div>

        <div class="help-box d-flex flex-column justify-content-center align-items-center">
          <i class="bi bi-headset help-icon"></i>
          <h4>Have a Question?</h4>
          <p class="d-flex align-items-center mt-2 mb-0"><i class="bi bi-telephone me-2"></i> <span>{{ config('app.phone') }}</span></p>
          <p class="d-flex align-items-center mt-1 mb-0"><i class="bi bi-envelope me-2"></i> <a href="mailto:{{ config('app.email') }}">{{ config('app.email') }}</a></p>
        </div>

      </div>

      <div class="col-lg-8 ps-lg-5" data-aos="fade-up" data-aos-delay="200">
        <img src="{{ asset('images/services.jpg') }}" alt="" class="img-fluid services-img">
        <h3>Our Services</h3>
        <p>
          We offer a range of services to support the development and empowerment of TVET graduates from informal settlements in Kenya. Our services include employability and entrepreneurship training, linking TVET graduates to employment opportunities, youth empowerment and sponsorship, and TVET skills development.
        </p>
        <ul>
          <li><i class="bi bi-check-circle"></i> <span>Employability and entrepreneurship training</span></li>
          <li><i class="bi bi-check-circle"></i> <span>Linking TVET graduates to employment opportunities</span></li>
          <li><i class="bi bi-check-circle"></i> <span>Youth empowerment and sponsorship</span></li>
        </ul>
        <p>
        </p>
        <p>
        </p>
      </div>

    </div>

  </div>

</section>

</main>
@endsection
