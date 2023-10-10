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
    @if (session('error'))
        <div class="alert alert-danger">
            {{session('error')}}
        </div>
    @endif
    <div>
        <table class="table datatable">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Immatriculation</th>
                <th scope="col">Trajet</th>
                <th scope="col">Status</th>
                <th scope="col">Horaire</th>
                <th scope="col">Action</th>

              </tr>
            </thead>
            <tbody>
                @forelse ($trip as $trips)
                    <tr>
                        <th scope="row">{{$trips->id}}</th>
                        @php
                        $car = App\Models\Car::findOrFail($trips->car);
                        @endphp
                        <td>{{$car->plate_number}}</td>
                        <td>
                            {{$trips->place_depart}} - {{$trips->place_arrivals}}
                        </td>
                        <td>
                            {{$trips->status}}
                        </td>
                        @php
                            $dateDepart = Carbon\Carbon::parse($trips->date_depart); // Convertit la date en objet Carbon
                            $heureDepart = Carbon\Carbon::parse($trips->heure_depart); // Convertit l'heure en objet Carbon
                            // Formate la date et l'heure selon le format souhaité
                            $dateFormatee = $dateDepart->format('d/m/Y'); // Format de date (par exemple, "10/12/2023")
                            $heureFormatee = $heureDepart->format('H:i:s');
                        @endphp
                        <td>
                            {{$dateFormatee}} {{$heureFormatee}}
                        </td>
                        <td>
                            <a href="{{route('Admin.Verification.Passenger.verify', ['id' => $trips->id])}}" class="btn btn-primary">Show</a>
                        </td>

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
                        <td>

                        </td>

                    </tr>
                @endforelse

            </tbody>
          </table>
          {{$trip->links()}}
    </div>
  </div>
@endsection
