@php
use Illuminate\Support\Facades\Auth;
$user = Auth::user();

@endphp
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>@yield('title') | Travel Pulse Caravan</title>
  <meta content="" name="description">
  <meta content="" name="keywords">


  <!-- Vendor CSS Files -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link href="{{ asset('admin/assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
  <link href="{{ asset('admin/assets/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
  <link href="{{ asset('admin/assets/vendor/quill/quill.snow.css')}}" rel="stylesheet">
  <link href="{{ asset('admin/assets/vendor/quill/quill.bubble.css')}}" rel="stylesheet">
  <link href="{{ asset('admin/assets/vendor/remixicon/remixicon.css')}}" rel="stylesheet">
  <link href="{{ asset('admin/assets/vendor/simple-datatables/style.css')}}" rel="stylesheet">


  <!-- Template Main CSS File -->
  <link href="{{asset('admin/assets/css/style.css')}}" rel="stylesheet">
  <link href="{{asset('admin/assets/css/progress.css')}}" rel="stylesheet">
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="{{route('Admin.index')}}" class="logo d-flex align-items-center">
        <img src="assets/img/logo.png" alt="">
        <span class="d-none d-lg-block">Dashboard</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->



    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle " href="#">
            <i class="bi bi-search"></i>
          </a>
        </li><!-- End Search Icon-->



        @php
            //recuperer tous les message ou l'expediteur est l'utilisateur connecter
            $userId = $user->id;
            $participantId = App\Models\Participant::where(function ($query) use ($userId) {
                                                        $query->where('expediteur', $userId)
                                                            ->orWhere('destinataire', $userId);
                                                    })
                                                    ->orderBy('created_at', 'desc')
                                                    ->limit(5)
                                                    ->get();
            $cscount = App\Models\Participant::where(function ($query) use ($userId) {
                                                        $query->where('expediteur', $userId)
                                                            ->orWhere('destinataire', $userId);
                                                    })
                                                    ->orderBy('created_at', 'desc')
                                                    ->limit(5)
                                                    ->count();


            @endphp
        <li class="nav-item dropdown">

          <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
            <i class="bi bi-chat-left-text"></i>
            <span class="badge bg-success badge-number">{{$cscount}}</span>
          </a><!-- End Messages Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow messages">
            <li class="dropdown-header">
                App messaging
              <a href="{{route('Admin.Message.Creation.index')}}"><span class="badge rounded-pill bg-primary p-2 ms-2">Start</span></a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            @forelse ($participantId as $participant)
                        @php
                            $message = App\Models\Message::where('participant', $participant->id)
                                                            ->orderBy('created_at', 'desc')
                                                            ->value('content');





                            //
                            $differentUser = "";
                            if ($participant->expediteur != $user->id) {
                                $differentUser = $participant->expediteur;
                            }

                            if ($participant->destinataire != $user->id) {
                                $differentUser = $participant->destinataire;
                            }
                            //recuperation de l'user different de l'user actuel
                            $diffUser = App\Models\User::findOrFail($differentUser);


                            $d = App\Models\Message::where('participant', $participant->id)
                                                            ->where('expediteur', '!=', $user->id)
                                                            ->limit(1)
                                                            ->orderBy('created_at', 'desc')
                                                            ->get();
                        @endphp

                @if (!empty($message))
                    <li class="message-item">
                        <a href="{{route('Admin.Message.discution', ['participant' => $participant->id])}}">
                            @if (empty($diffUser->picture))
                                <img src="{{asset('admin/users-default/default.png')}}" alt="Profile" class="rounded-circle">
                            @else
                                <img src="/storage/{{$diffUser->picture}}" alt="{{$diffUser->name}}" class="rounded-circle">

                            @endif

                        <div>

                            <h4>{{$diffUser->name}}</h4>
                            <p>{{$message}}</p>
                            @foreach ($d as $date)
                            @php
                            $formattedDate = Carbon\Carbon::parse($date->created_at)->diffForHumans();

                            @endphp
                            <p>{{$formattedDate}}</p>
                            @endforeach

                        </div>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                @endif
            @empty
            <li class="message-item">
                <a href="#">

                  <div>
                    <h4></h4>
                    <p>No message for the moment</p>
                    <p></p>
                  </div>
                </a>
              </li>
              <li>
                <hr class="dropdown-divider">
              </li>
            @endforelse




            <li class="dropdown-footer">
              <a href="{{route('Admin.Message.allMessage')}}">Show all message</a>
            </li>

          </ul><!-- End Messages Dropdown Items -->

        </li><!-- End Messages Nav -->

        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            @if (empty($user->picture))
                <img src="{{asset('admin/users-default/default.png')}}" alt="Profile" class="rounded-circle">
            @else
                <img src="/storage/{{$user->picture}}" alt="Profile" class="rounded-circle">
            @endif

            <span class="d-none d-md-block dropdown-toggle ps-2">{{$user->name}}</span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6>{{$user->name}}</h6>
              @php
                $role = App\Models\Roles::findOrFail($user->role)
              @endphp
              <span>{{$role->title}}</span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="{{route('Admin.Utilisateur.profile')}}">
                <i class="bi bi-person"></i>
                <span>My profile</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="{{route('Admin.Utilisateur.edit')}}">
                <i class="bi bi-gear"></i>
                <span>Parameters</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="" onclick="alerte()">
                <i class="bi bi-question-circle"></i>
                <span>Need help ?</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
                <form action="{{route('logout')}}" method="post">
                    @csrf
                    <div class="dropdown-item d-flex align-items-center">
                        <i class="bi bi-box-arrow-right"></i>
                      <input type="submit" value="Log out" style="background: transparent; border:transparent">
                    </div>

                </form>

            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{route('Admin.index')}}">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-menu-button-wide"></i><span>Visual Interface</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{route('Admin.Home.index')}}">
              <i class="bi bi-circle"></i><span>Home</span>
            </a>
          </li>
          <li>
            <a href="{{route('Admin.Information.listing')}}">
              <i class="bi bi-circle"></i><span>Information</span>
            </a>
          </li>
          <li>
            <a href="{{route('Admin.Publicite.listing')}}">
              <i class="bi bi-circle"></i><span>Publicity</span>
            </a>
          </li>
        </ul>
      </li><!-- End Components Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-journal-text"></i><span>Company</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="">
              <i class="bi bi-circle"></i><span>Company Information</span>
            </a>
          </li>
          <li>
            <a href="{{route('Admin.Entreprise.flote.index')}}">
              <i class="bi bi-circle"></i><span>Our fleets</span>
            </a>
          </li>

        </ul>
      </li><!-- End Forms Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-layout-text-window-reverse"></i><span>Vehicle fleet</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{route('Admin.Entreprise.flote.car.index')}}">
              <i class="bi bi-circle"></i><span>List of our cars</span>
            </a>
          </li>
          <li>
            <a href="{{route('Admin.Entreprise.flote.car.listing.flote.index')}}">
              <i class="bi bi-circle"></i><span>List of our cars by fleet</span>
            </a>
          </li>
          <li>
            <a href="{{route('Admin.Entreprise.flote.car.carInformation.index')}}">
              <i class="bi bi-circle"></i><span>Information about our cars</span>
            </a>
          </li>
        </ul>
      </li><!-- End Tables Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#charts-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-globe2"></i><span>Travel management</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="charts-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{route('Admin.Entreprise.trip.travel.index')}}">
              <i class="bi bi-circle"></i><span>Departs and Destinations</span>
            </a>
          </li>
          <li>
            <a href="{{route('Admin.Entreprise.trip.planified.index')}}">
              <i class="bi bi-circle"></i><span>Journey planning</span>
            </a>
          </li>
          <li>
            <a href="{{route('Admin.Entreprise.trip.reservation.index')}}">
              <i class="bi bi-circle"></i><span>Reservations</span>
            </a>
          </li>
          <li>
            <a href="{{route('Admin.Verification.Passenger.listing')}}">
              <i class="bi bi-circle"></i><span>List of reservations</span>
            </a>
          </li>
        </ul>
      </li><!-- End Charts Nav -->



     <!-- End Icons Nav -->

      <li class="nav-heading">Pages</li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{route('Admin.Utilisateur.profile')}}">
          <i class="bi bi-person"></i>
          <span>Profile</span>
        </a>
      </li><!-- End Profile Page Nav -->
      @if ($user->role == 3)
      <li class="nav-item">
        <a class="nav-link collapsed" href="{{route('Admin.Compte.listing')}}">
            <i class="bi bi-person"></i>
          <span>Account management</span>
        </a>
      </li>
      @endif




      <li class="nav-item">
        <a class="nav-link collapsed" href="{{route('Admin.Contact.listing')}}">
          <i class="bi bi-envelope"></i>
          <span>Message received</span>
        </a>
      </li><!-- End Contact Page Nav -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="{{route('Public.index')}}">
            <i class="bi bi-globe2"></i>
          <span>Site</span>
        </a>
      </li><!-- Sites -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="{{route('Admin.Newsletter.listing')}}">
          <i class="bi bi-envelope"></i>
          <span>Newsletter</span>
        </a>
      </li><!-- End Contact Page Nav -->










    </ul>

  </aside><!-- End Sidebar-->

  <main id="main" class="main">

    <section class="section dashboard">
      @yield('content')
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>Travel Pulse Caravan</span></strong>. All Rights Reserved
    </div>

  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <script>
    function alerte() {
        window.alert('Contacter l\'Administrateur du site, \n maheninarandrianarisoa@gmail.com')
    }
  </script>
  <!-- Vendor JS Files -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <script src="{{ asset('admin/assets/vendor/apexcharts/apexcharts.min.js')}}"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

  <script src="{{ asset('admin/assets/vendor/chart.js/chart.umd.js')}}"></script>
  <script src="{{ asset('admin/assets/vendor/echarts/echarts.min.js')}}"></script>
  <script src="{{ asset('admin/assets/vendor/quill/quill.min.js')}}"></script>
  <script src="{{ asset('admin/assets/vendor/simple-datatables/simple-datatables.js')}}"></script>
  <script src="{{ asset('admin/assets/vendor/tinymce/tinymce.min.js')}}"></script>
  <script src="{{ asset('admin/assets/vendor/php-email-form/validate.js')}}"></script>

  <!-- Template Main JS File -->
  <script src="{{ asset('admin/assets/js/main.js')}}"></script>

</body>

</html>

