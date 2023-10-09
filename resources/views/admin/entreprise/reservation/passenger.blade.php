@extends('admin')

@section('title', 'Reservation')

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
    <div>
        <table class="table datatable">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Immatriculation</th>
                <th scope="col">Passager</th>

                <th scope="col">Horaire</th>

              </tr>
            </thead>
            <tbody>
                @forelse ($reservation as $reservations)
                    <tr>
                        <th scope="row">{{$reservations->id}}</th>
                        @php
                            $trip = App\Models\Trip::findOrFail($reservations->trip_id);
                            $car = App\Models\Car::findOrFail($trip->car);
                        @endphp
                        <td>
                            {{$car->plate_number}}
                        </td>

                        @php
                        $passenger = App\Models\Passenger::findOrFail($reservations->passenger_id);
                        @endphp
                        <td>
                            {{$passenger->name}} {{$passenger->last_name}}
                        </td>


                        @php
                            $dateDepart = Carbon\Carbon::parse($reservations->created_at); // Convertit la date en objet Carbon

                            // Formate la date et l'heure selon le format souhaité
                            $dateFormatee = $dateDepart->format('d/m/Y H:i:s'); // Format de date (par exemple, "10/12/2023")

                        @endphp
                        <td> {{$dateFormatee}} </td>



                    </tr>
                @empty
                    <tr>
                        <th scope="row"></th>
                        <td style="text-align: center">Aucune flote pour le moment</td>
                        <td>

                        </td>
                        <td>

                        </td>
                        <td>

                        </td>

                    </tr>
                @endforelse

            </tbody>
          </table>
          {{$reservation->links()}}
    </div>
@endsection
