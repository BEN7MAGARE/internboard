<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>@yield('title') - InternBoard</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon"> -->

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Raleway:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

  <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">

  <link href="{{ asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('assets/css/some.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/iziToast.min.css') }}">


  <script src="https://kit.fontawesome.com/4930f74824.js" crossorigin="anonymous"></script>


  @yield('header_styles')

</head>

<body>

  {{-- <section id="topbar" class="topbar d-flex align-items-center">
    <div class="container d-flex justify-content-center justify-content-md-between">
      <div class="contact-info d-flex align-items-center">
        <i class="bi bi-envelope d-flex align-items-center"><a href="mailto:contact@example.com">contact@example.com</a></i>
        <i class="bi bi-phone d-flex align-items-center ms-4"><span>+1 5589 55488 55</span></i>
      </div>
      <div class="social-links d-none d-md-flex align-items-center">
        <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
        <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
        <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
        <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></i></a>
      </div>
    </div>
  </section> --}}

  <header id="header" class="header d-flex align-items-center">

    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">
      <a href="{{ url('/') }}" class="logo d-flex align-items-center">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <img src="{{ asset('assets/img/logo.png') }}" alt="">
        {{-- <img src="{{ asset('assets/img/aiccad_logo.png') }}" alt="">
        <img src="{{ asset('assets/img/msdp.jpg') }}" alt=""> --}}
        {{-- <h1>Intern<span>Board</span></h1> --}}
      </a>
      <nav id="navbar" class="navbar">
        <ul>
          <li><a  class="{{ Request::is('/') ? 'active' : '' }}" href="{{ url('/') }}">Home</a></li>

          <li><a  class="{{ Request::is('jobs') ? 'active' : '' }}" href="{{ route('jobs.index') }}">Opportunities</a></li>

          {{-- <li class="dropdown"><a href="#"><span>Drop Down</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
            <ul>
              <li><a href="#">Drop Down 1</a></li>
              <li class="dropdown"><a href="#"><span>Deep Drop Down</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
                <ul>
                  <li><a href="#">Deep Drop Down 1</a></li>
                </ul>
              </li>
              <li><a href="#">Drop Down 2</a></li>
            </ul>
          </li> --}}

          <li><a href="{{ route('contact') }}" class="{{ Request::is('contact') ? 'active' : '' }}">Contact</a></li>

          @guest
          <li>
            <a href="{{ route('login') }}" class="{{ Request::is('login') ? 'active' : '' }}">Login &nbsp;<i class="fa fa-sign-in"></i></a>
          </li>
              @else
              <li class="dropdown"><a href="#"><span>{{ auth()->user()->first_name }}</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
            <ul>

              <li><a href="{{ route('profile.edit') }}">My Profile</a></li>
              <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <a href="route('logout')"
                        onclick="event.preventDefault();
                                this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </a>
                </form>
              </li>
            </ul>
          </li>
          @endguest
        </ul>
      </nav>

      <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
      <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>
    </div>
  </header>

    @yield('content')

    <section id="clients" class="clients">
      <div class="container" data-aos="zoom-out">

        <h3 class="mb-2"><b>Partners</b></h3>

        <div class="clients-slider swiper">
          <div class="swiper-wrapper align-items-center">
            <div class="swiper-slide"><img src="{{ asset('assets/img/aiccad_logo.png') }}" class="img-fluid" alt="" height="300px"></div>
            <div class="swiper-slide"><img src="{{ asset('assets/img/msdp.jpg') }}" class="img-fluid" alt=""></div>
          </div>
        </div>
      </div>
    </section>

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">

    <div class="container">
      <div class="row gy-4">
        <div class="col-lg-5 col-md-12 footer-info">
          <a href="{{ url('/') }}" class="logo d-flex align-items-center">
            <span>InternBoard</span>
          </a>
          <p>This platform </p>
          {{-- <div class="social-links d-flex mt-4">
            <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
            <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
            <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
            <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
          </div> --}}
        </div>

        <div class="col-lg-2 col-6 footer-links">
          <h4>Useful Links</h4>
          <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#">About us</a></li>
            <li><a href="#">Services</a></li>
            <li><a href="#">Terms of service</a></li>
            <li><a href="#">Privacy policy</a></li>
          </ul>
        </div>

        <div class="col-lg-2 col-6 footer-links">
          <h4>Our Services</h4>
          <ul>
            <li><a href="#">Job Advertisement</a></li>
            <li><a href="#">Applications for jobs</a></li>
            {{-- <li><a href="#"></a></li>
            <li><a href="#">Marketing</a></li>
            <li><a href="#">Graphic Design</a></li> --}}
          </ul>
        </div>

        <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
          <h4>Contact Us</h4>
          {{-- <p>
            A108 Adam Street <br>
            New York, NY 535022<br>
            United States <br><br>
            <strong>Phone:</strong> +1 5589 55488 55<br>
            <strong>Email:</strong> info@example.com<br>
          </p> --}}

        </div>

      </div>
    </div>

    <div class="container mt-4">
      <div class="copyright">
        &copy; Copyright <strong><span>The Technical University of Kenya</span></strong>. All Rights Reserved
      </div>
    </div>

  </footer>

  <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
  <script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
  <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
  <script src="{{ asset('assets/js/iziToast.min.js') }}"></script>
  <script src="{{ asset('assets/js/main.js') }}"></script>
    @yield('footer_scripts')
</body>

</html>
