@extends('admin')

@section('title', 'Verification')

@section('content')
<div class="pagetitle">
    <h1>Réservation</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('Admin.index')}}">Dashboard</a></li>
        <li class="breadcrumb-item">Vérification d'une réservation</li>
      </ol>
    </nav>
</div>

<div class="container">
    <div class="card" style="padding: 20px">
        @foreach ($passenger as $passengers)
        <div class="row mb-3">
            <div class="col-md-6">
                <h4 class="text-primary">Ticket numbert:</h4>
                <h4 class="text-primary">Company:</h4>
                <h4 class="text-primary">Fleet:</h4>
                <h4 class="text-primary">Car registration:</h4>
                <h4 class="text-primary">Traject:</h4>
                <h4 class="text-primary">Hourly:</h4>
                <h4 class="text-primary">Date of reservation</h4>
                <h4 class="text-primary">Passenger's first and last name:</h4>
                <h4 class="text-primary">Passenger phone:</h4>
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
