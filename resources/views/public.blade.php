<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>@yield('title') | Travel Pulse Caravan</title>
  <meta content="Compagnie de Transport Terrestre à Madagascar" name="description">
  <meta content="Travel, voyage, madagascar, compagnie de transport" name="keywords">


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

      <h1 class="logo"><a href="{{route('Public.index')}}">Travel Pulse Caravan</a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto @if (request()->routeIS('Public.index')) active @endif" href="{{route('Public.index')}}">Acceuil</a></li>

          <li><a class="nav-link scrollto @if (request()->routeIS('Public.service')) active @endif" href="{{route('Public.service')}}">Nos préstation</a></li>
          <li><a class="nav-link scrollto @if (request()->routeIS('Public.Reservation.index')) active @endif" href="{{ route('Public.Reservation.index')}}">Réserver</a></li>


          <li><a class="nav-link scrollto @if (request()->routeIS('Public.contacts')) active @endif" href="{{route('Public.contacts')}}">Contact</a></li>
          <li><a class="nav-link scrollto @if (request()->routeIS('Public.information')) active  @endif" href="{{route('Public.information')}}">Information</a></li>
          @if (!Illuminate\Support\Facades\Auth::check())
            <li><a class="nav-link scrollto" href="{{route('register')}}">S'inscrire</a></li>
            <li><a class="nav-link scrollto" href="{{route('login')}}">Se connecter</a></li>
          @else
          @php
                $user = Illuminate\Support\Facades\Auth::user();
          @endphp

          @if ($user->role != 1)
            <li><a class="nav-link scrollto" href="{{route('Admin.index')}}">Administration</a></li>
          @endif
            <li>
                <form action="{{route('logout')}}" method="post">
                    @csrf
                    <div class="nav-link scrollto">

                      <input type="submit" value="Déconnexion" style="background: transparent; border:transparent; color:white; margin-left:5px">
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
            <h3>Travel Pulse Caravan</h3>
            <p>
              Mahamasina<br>
              ANTANANARIVO<br>
              MADAGASCAR <br><br>
              <strong>Phone:</strong> +261 00 000 00<br>
              <strong>Email:</strong> travelpulsecaravan@gmail.com<br>
            </p>
          </div>

          <div class="col-lg-2 col-md-6 footer-links">
            <h4>Lien utile</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="{{route('Public.index')}}">Acceuil</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="{{route('Public.information')}}">Information</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="{{route('Public.service')}}">Nos service</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="{{route('Public.condition')}}">Conditions d'utilisation</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="{{route('Public.terme')}}">Politique de confidentialité</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Notre service</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="{{route('Public.Personel.index')}}">Transport personnelle</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="{{route('Public.Colis.index')}}">Colis express</a></li>
                <!--
                    <li><i class="bx bx-chevron-right"></i> <a href="#">Location de voiture</a></li>
                -->

            </ul>
          </div>

          <div class="col-lg-4 col-md-6 footer-newsletter">
            <h4>Restez Connectés avec Travel Pulse Caravan : Inscrivez-vous pour nos Actualités Exclusives !</h4>
            <p>
                Rejoignez notre communauté en créant un compte dès aujourd'hui et ne manquez aucune de nos actualités passionnantes. Soyez les premiers informés de nos offres exclusives, de nos nouveautés et de nos conseils de voyage. Inscrivez-vous maintenant pour rester connectés avec Travel Pulse Caravan !
            </p>
          </div>

        </div>
      </div>
    </div>

    <div class="container d-md-flex py-4">

      <div class="me-md-auto text-center text-md-start">
        <div class="copyright">
          &copy; Copyright <strong><span>Briqueweb</span></strong>
        </div>
        <div class="credits">
          Designed by NARIHY
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
