@php
use \Illuminate\Support\Facades\Auth;
$user = Auth::user();

@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>user manual</title>
    <style>
        /* Styles pour le bouton "Back to Top" */
        .back-to-top {
            display: none; /* Masquer le bouton par défaut */
            position: fixed;
            border-radius: 50%;

            border: transparent;
            bottom: 20px;
            right: 20px;

        }
        .back-to-top:hover {
            color: blue;
        }
        .back-to-top::before {
            content: '';
            border: transparent;
            text-align: right;
            position: absolute;
            background: #ff0000;
            width: 100%;
            height: 0;
            bottom: 0;
            left: 0;
            z-index: -1;
            transition: all 0.3s;
        }
        .back-to-top:hover::before {
            height: 100%;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    @yield('css')
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
          <a class="navbar-brand" href="{{route('Public.index')}}">Travel Pulse Caravan</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
              <a class="nav-link active" aria-current="page" href="{{route('Public.index')}}">Home</a>
              @if ($user)
                @if ($user->role != 1)
                <a class="nav-link" href="{{route('Admin.index')}}">Administration</a>
                @endif
              @endif
            </div>
          </div>
        </div>
      </nav>
    <div class="container">
        @yield('content')
        <a href="#" id="back-to-top" class="btn btn-primary back-to-top text-center" role="button">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-airplane-fill" viewBox="0 0 16 16">
                <path d="M6.428 1.151C6.708.591 7.213 0 8 0s1.292.592 1.572 1.151C9.861 1.73 10 2.431 10 3v3.691l5.17 2.585a1.5 1.5 0 0 1 .83 1.342V12a.5.5 0 0 1-.582.493l-5.507-.918-.375 2.253 1.318 1.318A.5.5 0 0 1 10.5 16h-5a.5.5 0 0 1-.354-.854l1.319-1.318-.376-2.253-5.507.918A.5.5 0 0 1 0 12v-1.382a1.5 1.5 0 0 1 .83-1.342L6 6.691V3c0-.568.14-1.271.428-1.849Z"/>
            </svg>
        </a>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script>
        let btn = document.getElementById('back-to-top');
         // Cachez le bouton "Back to Top" au chargement de la page
        $('#back-to-top').hide();
        // Afficher ou masquer le bouton "Back to Top" en fonction de la position de défilement
        $(window).scroll(function () {
            if ($(this).scrollTop() > 100) {
                $('#back-to-top').fadeIn();
            } else {
                $('#back-to-top').fadeOut();
            }
        });

        // Faire défiler la page vers le haut lorsque le bouton est cliqué
        $('#back-to-top').click(function () {
            $('body,html').animate({
                scrollTop: 0
            }, 600);
            return false;
        });

    </script>
</body>
</html>
