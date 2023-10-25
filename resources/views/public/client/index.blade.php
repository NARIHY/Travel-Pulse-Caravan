@extends('public')

@section('title', 'My space')

@section('content')
<section class="client-space" style="margin-top: 40px">
    <div class="container">
        <h4>My reservations:</h4>
        <div class="table-responsive">
        @forelse ($passenger as $p)

            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Car</th>
                    <th scope="col">Fleet</th>
                    <th scope="col">Status</th>

                    <th scope="col">Date and departure time</th>
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
                                                        <a href="{{route('Public.Reservation.Auth.success' , ['reservationId' => $r->id])}}" class="btn btn-primary" style="color: white">See</a>
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
                                                                <input type="submit" value="Cancel" class="btn btn-danger" onclick="afficherAlerte()" />
                                                            </form>
                                                        </div>
                                                    @endif

                                                </div>
                                            @else
                                                <p style="color: red">Indisponible</p>
                                            @endif
                                        @else
                                            <p style="color: red">Canceled</p>
                                        @endif


                                    </td>
                                </tr>
                            @empty

                            @endforelse
                        </tbody>
                    </table>
                    {{$reservation->links()}}




        @empty
                <p>You have not made any reservations yet.</p>
        @endforelse
    </div>
    </div>
</section>
<script>
    function afficherAlerte() {
        // Afficher l'alerte lorsque le bouton est cliqué
        alert("Are you sure you want to cancel?");
    }
</script>
@endsection

