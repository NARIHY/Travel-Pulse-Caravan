@extends('public')

@section('title', 'Mon espace')

@section('content')
<section class="client-space" style="margin-top: 40px">
    <div class="container">
        <h4>Mes réservations:</h4>
        <div class="table-responsive">
        @forelse ($passenger as $p)

            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Voiture</th>
                    <th scope="col">Flotte</th>
                    <th scope="col">Status</th>

                    <th scope="col">Date et departure time</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
            @php
            //get every reservation where are the passenger id
            $reservation = App\Models\Reservation::where('passenger_id', $p->id)->paginate(10);
            @endphp

                        @forelse ($reservation as $r)

                            @php
                                //get every things in trip_id
                                $trip = App\Models\Trip::findOrFail($r->trip_id);
                                //get car
                                $car = App\Models\Car::findOrFail($trip->car);
                                //flotte
                                $flotte = App\Models\Category::findOrFail($car->category);
                                //date time
                                $date = Carbon\Carbon::parse($trip->date_depart);
                                $time = Carbon\Carbon::parse($trip->heure_depart);
                                //formate their date time
                                $dateFormattee = $date->format('Y-m-d');
                                $timeFormatee = $time->format('H:i:s');
                            @endphp
                                <tr>
                                    <th scope="row">{{$r->id}}</th>
                                    <td> {{$car->plate_number}} </td>
                                    <td> {{$flotte->flotte}} </td>
                                    <td>{{$trip->status}}</td>
                                    <td> {{$dateFormattee}}  {{$timeFormatee}} </td>
                                    <td>
                                        @if ($r->stat != "abord")
                                            @if (!$date->isPast() )
                                                <div class="row mb-3">
                                                    <div class="col-md-6">
                                                        <a href="{{route('Public.Reservation.Auth.success' , ['reservationId' => $r->id])}}" class="btn btn-primary" style="color: white">Voir</a>
                                                    </div>
                                                    @php
                                                    //Actuale date
                                                    $dateActuelle = Carbon\Carbon::now();
                                                    $differenceEnJours = $dateActuelle->diffInDays($date);
                                                    @endphp

                                                    @if ($differenceEnJours >=3)
                                                        <div class="col-md-6">
                                                            <form action="{{route('Client.abord', ['reservationId' => $r->id])}}" method="post">
                                                                @csrf
                                                                <input type="submit" value="Annuler" class="btn btn-danger" onclick="afficherAlerte()" />
                                                            </form>
                                                        </div>
                                                    @endif

                                                </div>
                                            @else
                                                <p style="color: red">Indisponible</p>
                                            @endif
                                        @else
                                            <p style="color: red">Annulé</p>
                                        @endif


                                    </td>
                                </tr>
                            @empty

                            @endforelse
                        </tbody>
                    </table>
                    {{$reservation->links()}}




        @empty
                <p>Vous n'avez passée aucune réservation pour le moment.</p>
        @endforelse
    </div>
    </div>
</section>
<script>
    function afficherAlerte() {
        // Afficher l'alerte lorsque le bouton est cliqué
        alert("Êtes-vous sûr de vouloir annuler ?");
    }
</script>
@endsection

