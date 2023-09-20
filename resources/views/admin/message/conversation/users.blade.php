<!DOCTYPE html>
<html lang="en">
<head><script src="{{asset('bootstrap/js/color-modes.js')}}"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Message</title>
    <style>
        .left {
            width: 100%;
            float: left;
        }
        .right {
            width: 100%;
            float: right;
        }
        .left .message {
            background-color: #3a36f8; /* Remplacez par la couleur de fond souhaitée */
            padding: 5px;
            display: inline-block;
            border-radius: 5px; /* Ajoutez des coins arrondis pour l'élément */
            color: white;
        }
        .right .message {
            background-color: #10bd00; /* Remplacez par la couleur de fond souhaitée */
            padding: 5px;
            display: inline-block;
            border-radius: 5px; /* Ajoutez des coins arrondis pour l'élément */
            color: white;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body >


    <div class="container" style="padding: 20px">

        @forelse ($message as $mess)
    @php
    $expediteurId = $mess->expediteur;
    $destinataireId = $mess->destinataire;
    $content = $mess->content;
    $formattedDate = Carbon\Carbon::parse($mess->created_at)->diffForHumans();
    @endphp

    @if ($expediteurId == $user->id)
        <div class="right">
            <div class="message-item">
                <div style="float: right" style="margin-right: 20px; margin-top:10px">
                    @if (empty($user->picture))
                    <img src="{{asset('admin/users-default/default.png')}}" alt="Profile" class="rounded-circle" width="50px">
                    @else
                        <img src="/storage/{{$user->picture}}" alt="{{$user->name}}" class="rounded-circle" width="50px">
                    @endif
                </div>
                <div style="float: right">
                    <h5 style="text-align: right; margin-right: 10px">{{$user->name}}</h5>
                    <h6 class="message" style="text-align: right">{{$content}}</h6>
                    <p>{{$formattedDate}}</p>
                </div>

            </div>

        </div>

    @elseif ( $diffUserSender !== null)
        <div class="left">
            <div class="message-item">
                <div style="float: left">
                    @if (empty($diffUserSender->picture))
                    <img src="{{asset('admin/users-default/default.png')}}" alt="Profile" class="rounded-circle" width="50px">
                    @else
                        <img src="/storage/{{$diffUserSender->picture}}" alt="{{$diffUserSender->name}}" class="rounded-circle" width="50px">
                    @endif
                </div>
                <div style="float: left; margin-left: 20px">
                    <h5>{{$diffUserSender->name}}</h5>
                    <h6 class="message">{{$content}}</h6>
                    <p>{{$formattedDate}}</p>
                </div>

            </div>

        </div>

        @elseif ( $diffUserExpeditor !== null)
        <div class="left">
            <div class="message-item">
                <div style="float: left">
                    @if (empty($diffUserExpeditor->picture))
                    <img src="{{asset('admin/users-default/default.png')}}" alt="Profile" class="rounded-circle" width="50px">
                    @else
                        <img src="/storage/{{$diffUserExpeditor->picture}}" alt="{{$diffUserExpeditor->name}}" class="rounded-circle" width="50px">
                    @endif
                </div>
                <div style="float: left; margin-left: 20px">
                    <h5>{{$diffUserExpeditor->name}}</h5>
                <h6 class="message">{{$content}}</h6>
                    <p>{{$formattedDate}}</p>
                </div>

            </div>


        </div>
    @endif


@empty
    <div>
        Aucun message pour le moment
    </div>
@endforelse




    </div>



    <svg xmlns="http://www.w3.org/2000/svg" class="d-none">
        <symbol id="check2" viewBox="0 0 16 16">
          <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"/>
        </symbol>
        <symbol id="circle-half" viewBox="0 0 16 16">
          <path d="M8 15A7 7 0 1 0 8 1v14zm0 1A8 8 0 1 1 8 0a8 8 0 0 1 0 16z"/>
        </symbol>
        <symbol id="moon-stars-fill" viewBox="0 0 16 16">
          <path d="M6 .278a.768.768 0 0 1 .08.858 7.208 7.208 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277.527 0 1.04-.055 1.533-.16a.787.787 0 0 1 .81.316.733.733 0 0 1-.031.893A8.349 8.349 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.752.752 0 0 1 6 .278z"/>
          <path d="M10.794 3.148a.217.217 0 0 1 .412 0l.387 1.162c.173.518.579.924 1.097 1.097l1.162.387a.217.217 0 0 1 0 .412l-1.162.387a1.734 1.734 0 0 0-1.097 1.097l-.387 1.162a.217.217 0 0 1-.412 0l-.387-1.162A1.734 1.734 0 0 0 9.31 6.593l-1.162-.387a.217.217 0 0 1 0-.412l1.162-.387a1.734 1.734 0 0 0 1.097-1.097l.387-1.162zM13.863.099a.145.145 0 0 1 .274 0l.258.774c.115.346.386.617.732.732l.774.258a.145.145 0 0 1 0 .274l-.774.258a1.156 1.156 0 0 0-.732.732l-.258.774a.145.145 0 0 1-.274 0l-.258-.774a1.156 1.156 0 0 0-.732-.732l-.774-.258a.145.145 0 0 1 0-.274l.774-.258c.346-.115.617-.386.732-.732L13.863.1z"/>
        </symbol>
        <symbol id="sun-fill" viewBox="0 0 16 16">
          <path d="M8 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z"/>
        </symbol>
      </svg>

      <div class="dropdown position-fixed bottom-0 end-0 mb-3 me-3 bd-mode-toggle">
        <button class="btn btn-bd-primary py-2 dropdown-toggle d-flex align-items-center"
                id="bd-theme"
                type="button"
                aria-expanded="false"
                data-bs-toggle="dropdown"
                aria-label="Toggle theme (auto)">
          <svg class="bi my-1 theme-icon-active" width="1em" height="1em"><use href="#circle-half"></use></svg>
          <span class="visually-hidden" id="bd-theme-text">Toggle theme</span>
        </button>
        <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="bd-theme-text">
          <li>
            <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="light" aria-pressed="false">
              <svg class="bi me-2 opacity-50 theme-icon" width="1em" height="1em"><use href="#sun-fill"></use></svg>
              Light
              <svg class="bi ms-auto d-none" width="1em" height="1em"><use href="#check2"></use></svg>
            </button>
          </li>
          <li>
            <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="dark" aria-pressed="false">
              <svg class="bi me-2 opacity-50 theme-icon" width="1em" height="1em"><use href="#moon-stars-fill"></use></svg>
              Dark
              <svg class="bi ms-auto d-none" width="1em" height="1em"><use href="#check2"></use></svg>
            </button>
          </li>
          <li>
            <button type="button" class="dropdown-item d-flex align-items-center active" data-bs-theme-value="auto" aria-pressed="true">
              <svg class="bi me-2 opacity-50 theme-icon" width="1em" height="1em"><use href="#circle-half"></use></svg>
              Auto
              <svg class="bi ms-auto d-none" width="1em" height="1em"><use href="#check2"></use></svg>
            </button>
          </li>
        </ul>
      </div>


  <svg xmlns="http://www.w3.org/2000/svg" class="d-none">
    <symbol id="arrow-right-short" viewBox="0 0 16 16">
      <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z"/>
    </symbol>
    <symbol id="x-lg" viewBox="0 0 16 16">
      <path fill-rule="evenodd" d="M13.854 2.146a.5.5 0 0 1 0 .708l-11 11a.5.5 0 0 1-.708-.708l11-11a.5.5 0 0 1 .708 0Z"/>
      <path fill-rule="evenodd" d="M2.146 2.146a.5.5 0 0 0 0 .708l11 11a.5.5 0 0 0 .708-.708l-11-11a.5.5 0 0 0-.708 0Z"/>
    </symbol>
  </svg>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
