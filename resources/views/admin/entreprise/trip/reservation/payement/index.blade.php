@extends('admin')

@section('title', 'Faire une réservation, payement en cache')

@section('content')
<div class="pagetitle">

    <h1>Gestion de trajet</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('Admin.index')}}">Tableau de bord</a></li>
        <li class="breadcrumb-item">Payement</li>
      </ol>
    </nav>
  </div>


<div class="container">

      <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="margin-bottom: 20px">
        <div class="progress-bar bg-primary"></div>
      </div>

    <div class="card" style="padding: 20px 20px 20px 20px">
        <div class="row mb-3">
            <div class="col-6">
                <h4 style="color: blue">Nom du client:</h4>
                <h4 style="color: blue">Prénon du client:</h4>
                <h4 style="color: blue">Date de reservation:</h4>
                <h4 style="color: blue">Compagnie:</h4>
                <h4 style="color: blue">Flote:</h4>
                <h4 style="color: blue">Immatriculation voiture:</h4>
                <h4 style="color: blue">Date de départ:</h4>
                <h4 style="color: blue">Heure de départ:</h4>
                <h4 style="color: blue">Lieu de départ:</h4>
                <h4 style="color: blue">Lieu d'arriver:</h4>
            </div>
            <div class="col-6">
                @php
                $client = App\Models\Passenger::findOrFail($passenger_id);
                $trip = App\Models\Trip::findOrFail($tripId);
                $car = $trip->car;

                $date = Carbon\Carbon::parse($trip->date_depart)->format('D d M Y');
                $time = Carbon\Carbon::parse($trip->heure_depart)->format('H:m:s');
                $now = date('D d M Y');
                @endphp
                <h4>{{$client->name}}</h4>
                <h4>{{$client->last_name}}</h4>
                <h4>{{$now}}</h4>
                <h4>Travel Pulse Caravan</h4>
                <h4>{{$trip->flote}}</h4>
                <h4>{{$car}}</h4>
                <h4>{{$date}}</h4>
                <h4>{{$time}}</h4>
                <h4> {{$depart}} </h4>
                <h4>{{$arrivals}}</h4>
            </div>
        </div>
        <form action="" method="post">
            @csrf
            <input type="submit" class="btn btn-primary" style="float: right" value="Payement en espèce">
        </form>
    </div>
</div>
<script type="text/javascript">
        // Obtenez la valeur actuelle de la barre de progression (par exemple, 75%)
    const nouvelleValeur = 80;

    // Sélectionnez la barre de progression avec jQuery
    const barreDeProgression = $("#maBarreDeProgression");

    // Animez la largeur de la barre de progression jusqu'à la nouvelle valeur
    barreDeProgression.animate({ width: nouvelleValeur + "%" }, 1000); // 1000 ms pour l'animation (1 seconde)

</script>
@endsection
