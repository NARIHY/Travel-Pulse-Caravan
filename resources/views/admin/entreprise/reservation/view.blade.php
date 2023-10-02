@extends('admin')

@section('title', 'Verification')

@section('content')
<div class="pagetitle">
    <h1>Réservation</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('Admin.index')}}">Tableau de bord</a></li>
        <li class="breadcrumb-item">Vérification d'une réservation</li>
      </ol>
    </nav>
</div>

<div class="container">
    <div class="card" style="padding: 20px">
        @foreach ($passenger as $passengers)
        <div class="row mb-3">
            <div class="col-md-6">
                <h4 class="text-primary">Numéro de ticket:</h4>
                <h4 class="text-primary">Compagnie:</h4>
                <h4 class="text-primary">Flotte:</h4>
                <h4 class="text-primary">Immatriculation de la voiture:</h4>
                <h4 class="text-primary">Trajet:</h4>
                <h4 class="text-primary">Horaire:</h4>
                <h4 class="text-primary">Date de la réservation:</h4>
                <h4 class="text-primary">Nom et prénom du passager:</h4>
                <h4 class="text-primary">Téléphone du passager:</h4>
            </div>
            <div class="col-md-6">
                <h4>79-{{$passengers->id}}58-5489-15-uz</h4>
                @php
                $trip = App\Models\Trip::findOrFail($passengers->trip_id);
                $category = App\Models\Category::findOrFail($trip->flote);
                $car = App\Models\Car::findOrFail($trip->car);
                $passenger = App\Models\Passenger::findOrFail($passengers->passenger_id);
                @endphp
                <h4>Travel Pulse Caravan</h4>
                <h4>{{$category->flotte}}</h4>
                <h4>{{$car->plate_number}}</h4>
                @php
                $dateDepart = Carbon\Carbon::parse($trip->date_depart);
                $heureDepart = Carbon\Carbon::parse($trip->heure_depart);
                $dateFormatee = $dateDepart->format('d/m/Y');
                $heureFormatee = $heureDepart->format('H:i:s');
                @endphp
                <h4>{{$trip->place_depart}}-{{$trip->place_arrivals}}</h4>
                <h4>{{$dateFormatee}} {{$heureFormatee}}</h4>
                @php
                $dateDeparts = Carbon\Carbon::parse($passengers->created_at);
                $d = $dateDeparts->format('d/m/Y H:i:s');
                @endphp
                <h4>{{$d}}</h4>
                <h4>{{$passenger->name}} {{$passenger->last_name}}</h4>
                <h4>{{$passenger->phone_number}}</h4>
            </div>
        </div>

        @endforeach
    </div>
</div>
@endsection
