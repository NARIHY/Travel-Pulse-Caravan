@extends('admin')

@section('title', 'Faire une réservation')

@section('content')
<div class="pagetitle">

    <h1>Journey management</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('Admin.index')}}">Dashboard</a></li>
        <li class="breadcrumb-item">List of reservations available</li>
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
        <th scope="col">Car</th>
        <th scope="col">Place of departure</th>
        <th scope="col">Place of arrivals</th>
        <th scope="col">fleet</th>
        <th scope="col">Date of departure</th>
        <th scope="col">departure time</th>
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
                <td ><p style="color: blue">{{$cars->plate_number}}</p></td>
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
                                try {
                                    $verify = new \Nari\Reservation\Reservation($trips->id, $trips->car);
                                    $verif = $verify->verify();
                                } catch (\Exception $e) {
                                    // Enregistrez l'exception dans les journaux Laravel pour le débogage
                                    \Log::error('Erreur lors de la vérification de la réservation : ' . $e->getMessage());
                                    // Vous pouvez également afficher un message d'erreur personnalisé ici si nécessaire
                                    $verif = false; // Par exemple
                                }


                                @endphp


                    @if ($verif === false)
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
                <td style="text-align: center">Empty</td>
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
