<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>@yield('title') | Travel Pulse Caravan</title>
  <meta content="Compagnie de Transport Terrestre à Madagascar" name="description">
  <meta content="Travel, voyage, madagascar, compagnie de transport" name="keywords">
    <link rel="shortcut icon" href="{{asset('logi.png')}}" type="image/x-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{asset('public/assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{asset('public/assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
  <link href="{{asset('public/assets/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
  <link href="{{asset('public/assets/vendor/glightbox/css/glightbox.min.css')}}" rel="stylesheet">
  <link href="{{asset('public/assets/vendor/swiper/swiper-bundle.min.css')}}" rel="stylesheet">
  <link href="{{ asset('admin/assets/vendor/simple-datatables/style.css')}}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{asset('public/assets/css/style.css')}}" rel="stylesheet">
  <link href="{{asset('public/assets/css/myStyle.css')}}" rel="stylesheet">
  <!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-KWPGZBWG');</script>
    <!-- End Google Tag Manager -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top header-transparent">
    <div class="container d-flex align-items-center justify-content-between">

      <h1 class="logo" style="text-align: center"><a href="{{route('Public.index')}}"><img src="{{asset('lolo.png')}}" alt="TPC" width="75px" height="50px"> TRAVEL PULSE CARAVAN</a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo"><img src="{{asset('welcome/Travel pulse Caravan-logo1.png')}}" alt="" class="img-fluid"></a>-->

      <nav id="navbar" class="navbar">
        <ul>
            <li><a class="nav-link scrollto @if (request()->routeIS('Public.index')) active @endif" href="{{route('Public.index')}}">Home</a></li>
            <li><a class="nav-link scrollto @if (request()->routeIS('Public.information')) active  @endif" href="{{route('Public.information')}}">Information</a></li>
            <li><a class="nav-link scrollto @if (request()->routeIS('Public.service')) active @endif" href="{{route('Public.service')}}">Our services</a></li>
            <li><a class="nav-link scrollto @if (request()->routeIS('Public.contacts')) active @endif" href="{{route('Public.contacts')}}">Contact</a></li>
            <li><a class="nav-link scrollto @if (request()->routeIS('Public.Reservation.index')) active @endif" href="{{ route('Public.Reservation.index')}}">To book</a></li>




          @if (!Illuminate\Support\Facades\Auth::check())
            <li><a class="nav-link scrollto" href="{{route('register')}}">Register</a></li>
            <li><a class="nav-link scrollto" href="{{route('login')}}">Login</a></li>
          @else
          @php
                $user = Illuminate\Support\Facades\Auth::user();
          @endphp
            @if ($user->role == 1)
                <li><a class="nav-link scrollto" href="{{route('Client.index')}}">My space</a></li>
            @endif
          @if ($user->role != 1)
            <li><a class="nav-link scrollto" href="{{route('Admin.index')}}">Administration</a></li>
          @endif
            <li>
                <form action="{{route('logout')}}" method="post">
                    @csrf
                    <div class="nav-link scrollto">

                      <input type="submit" value="Log out" style="background: transparent; border:transparent; color:white; margin-left:5px">
                    </div>

                </form>
            </li>
          @endif

        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->

    @yield('content')

  <!-- ======= Footer ======= -->
  <footer id="footer">

    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6 footer-contact">
            <h3 class="text-center">
                <img src="{{asset('Travel pulse Caravan-logo.png')}}" alt="" width="200px">
            </h3>
            <p>
              <strong>Phone:</strong> +261 00 00 000 00<br>
              <strong>Email:</strong> travelpulsecaravan@gmail.com<br>
            </p>
          </div>

          <div class="col-lg-2 col-md-6 footer-links">
            <h4>Usefull link</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="{{route('Public.index')}}">Home</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="{{route('Public.information')}}">Information</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="{{route('Public.service')}}">Our services</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="{{route('Public.Personel.index')}}">Personal transportation</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="{{route('Public.Colis.index')}}">Express parcel</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Our service</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="{{route('Public.condition')}}">Terms of use</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="{{route('Public.terme')}}">Privacy Policy</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="{{route('Manual.greeting')}}">C.G.U</a></li>
                <!--
                    <li><i class="bx bx-chevron-right"></i> <a href="#">Location de voiture</a></li>
                -->

            </ul>
          </div>

          <div class="col-lg-4 col-md-6 footer-newsletter">
            <h4>Stay Connected with Travel Pulse Caravan: Sign up for our Exclusive News!</h4>
            <p>
                Join our community by creating an account today and don't miss any of our exciting news. Be the first to know about our exclusive offers, news and travel advice. Sign up now to stay connected with Travel Pulse Caravan!
            </p>

             <form action="{{route('Public.subscribe')}}" method="post">
                @csrf
              <input type="email" name="email"><input type="submit" value="Subscribe">
            </form>
            @if(session('good'))
                <p style="color: green">{{session('good')}}</p>
            @endif
            @if(session('bad'))
                <p style="color: red">{{session('bad')}}</p>
            @endif
          </div>

        </div>
      </div>
    </div>

    <div class="container d-md-flex py-4">

      <div class="me-md-auto text-center text-md-start">
        <div class="copyright">
          &copy; Copyright <strong><span>Briqueweb</span></strong> All rights reserved
        </div>

      </div>
      <div class="social-links text-center text-md-right pt-3 pt-md-0">
        <a href="https://www.briqueweb.com/" class="twitter"><i class="bi bi-globe"></i></a>
        <a href="https://www.facebook.com/briqueweb" class="facebook"><i class="bx bxl-facebook"></i></a>
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KWPGZBWG"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
  <!-- Vendor JS Files -->
  <script src="{{asset('public/assets/vendor/purecounter/purecounter_vanilla.js')}}"></script>
  <script src="{{asset('public/assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('public/assets/vendor/glightbox/js/glightbox.min.js')}}"></script>
  <script src="{{asset('public/assets/vendor/isotope-layout/isotope.pkgd.min.js')}}"></script>
  <script src="{{asset('public/assets/vendor/swiper/swiper-bundle.min.js')}}"></script>
  <script src="{{ asset('admin/assets/vendor/simple-datatables/simple-datatables.js')}}"></script>

  <!-- Template Main JS File -->
  <script src="{{asset('public/assets/js/main.js')}}"></script>

</body>

</html>
