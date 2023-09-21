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

  <!-- Template Main CSS File -->
  <link href="{{asset('public/assets/css/style.css')}}" rel="stylesheet">
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top header-transparent">
    <div class="container d-flex align-items-center justify-content-between">

      <h1 class="logo"><a href="index.html">Travel Pulse Caravan</a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto @if (request()->routeIS('Public.index')) active @endif" href="{{route('Public.index')}}">Acceuil</a></li>

          <li><a class="nav-link scrollto" href="">Services</a></li>
          <li><a class="nav-link scrollto " href="">Réserver</a></li>


          <li><a class="nav-link scrollto" href="#contact">Contact</a></li>
          <li><a class="nav-link scrollto" href="">Information</a></li>
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
              <strong>Email:</strong> contact@exemple.mg<br>
            </p>
          </div>

          <div class="col-lg-2 col-md-6 footer-links">
            <h4>Lien utile</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="{{route('Public.index')}}">Acceuil</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Information</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Nos service</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Conditions d'utilisation</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Politique de confidentialité</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Notre service</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Transport personnelle</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Colis express</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Location de voiture</a></li>

            </ul>
          </div>

          <div class="col-lg-4 col-md-6 footer-newsletter">
            <h4>Joinniez vous à notre NewsLetter</h4>
            <p>Restez à l'affût de l'extraordinaire avec les dernières nouvelles et offres exclusives de Travel Pulse Caravan. Bienvenue dans notre newsletter !</p>
            <form action="" method="post">
              <input type="email" name="email"><input type="submit" value="S'inscrire">
            </form>
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

  <!-- Vendor JS Files -->
  <script src="{{asset('public/assets/vendor/purecounter/purecounter_vanilla.js')}}"></script>
  <script src="{{asset('public/assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('public/assets/vendor/glightbox/js/glightbox.min.js')}}"></script>
  <script src="{{asset('public/assets/vendor/isotope-layout/isotope.pkgd.min.js')}}"></script>
  <script src="{{asset('public/assets/vendor/swiper/swiper-bundle.min.js')}}"></script>
  <script src="{{asset('public/assets/vendor/php-email-form/validate.js')}}"></script>

  <!-- Template Main JS File -->
  <script src="{{asset('public/assets/js/main.js')}}"></script>

</body>

</html>
