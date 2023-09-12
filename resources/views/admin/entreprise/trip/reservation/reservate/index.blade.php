@extends('admin')

@section('title', 'Faire une réservation')

@section('content')
<div class="pagetitle">

    <h1>Gestion de trajet</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('Admin.index')}}">Tableau de bord</a></li>
        <li class="breadcrumb-item">Liste des réservation disponible</li>
      </ol>
    </nav>
  </div>


<div class="container">
    <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="margin-bottom: 20px">
        <div class="progress-bar bg-warning"></div>
    </div>

  <table class="table datatable">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Voiture</th>
        <th scope="col">Lieu de départ</th>
        <th scope="col">Lieu de d'arriver</th>
        <th scope="col">flote</th>
        <th scope="col">Date de départ</th>
        <th scope="col">Heure de départ</th>
        <th scope="col">status</th>
        <th scope="col">Action</th>

      </tr>
    </thead>

    <tbody>
        @forelse ($trip as $trips)
            <tr>
                <th scope="row">{{$trips->id}}</th>
                @php
                    $cars = App\Models\Car::findOrFail($trips->car);
                @endphp
                <td ><p style="color: blue">{{$cars->id}}</p></td>
                <td> {{$trips->place_depart}} </td>
                <td>{{$trips->place_arrivals}}</td>
                @php

               $date = Carbon\Carbon::parse($trips->date_depart)->format('D d M Y');
               $time = Carbon\Carbon::parse($trips->heure_depart)->format('H:m:s');
               @endphp
                <td> {{$trips->flote}} </td>
                <td>{{$date}}</td>
                <td> <p style="color: red">{{$time}}</p> </td>
                <td> {{$trips->status}}</td>



                <td>
                    @php

                        $verify = new Nari\Reservation\Reservation ($trips->id, $trips->car);
                    @endphp

                    @if ($verify->verify() === false)
                        <a href="{{route('Admin.Entreprise.trip.reservation.passenger.city.payement',['passenger_id' => $passenger_id, 'purcount' => $purcount + 25, 'tripId' => $trips->id, 'depart' => $depart, 'arrivals' => $arrivals])}}" class="btn btn-primary">Reserver</a>
                    @else
                        <p style="color: red">Plein</p>
                    @endif

                </td>
            </tr>
        @empty
            <tr>
                <th scope="row"></th>
                <td></td>
                <td></td>
                <td></td>
                <td style="text-align: center">Aucune trajet disponible pour le moment</td>
                <td></td>
                <td></td>
                <td></td>

                <td>

                </td>
            </tr>
        @endforelse

    </tbody>
  </table>
</div>
@endsection
