@extends('public')

@section('title' , 'Reservation')

@section('content')
    <div class="container" style="margin-top: 100px">
        <div class="introduction">
            <h3 class="colis-title" style="text-align: left">L'Art de Voyager au-Delà de l'Ordinaire !</h3>
            <p class="colis-content">
                Travel Pulse Caravan révolutionne votre expérience de voyage. Notre réservation est votre porte d'entrée vers une aventure exceptionnelle. Découvrez une flotte diversifiée, de la Flotte Lite économique à la Flotte VVIP prestigieuse. Personnalisez votre itinéraire en toute simplicité. Notre équipe dévouée répond à vos besoins spécifiques. Nous ne vendons pas de simples voyages, mais des expériences uniques. Réservez dès maintenant pour un voyage empreint de classe, de confort et de fiabilité. Voyagez au-delà de l'ordinaire avec Travel Pulse Caravan, votre partenaire de confiance pour des découvertes sans limites.
            </p>
        </div>

        <div class="planing">
            <h3 class="planing-title">Nos plans de voyage</h3>
            <div class="table-responsive">
                <table class="table datatable">
                    <thead>
                    <tr>
                      <th scope="col">Flotte</th>
                      <th scope="col">Trajet</th>
                      <th scope="col">Date et Heure</th>
                      <th scope="col">Voiture</th>
                      <th scope="col">Reservation</th>
                      <th scope="col">Status</th>
                      @php
                        $user = Illuminate\Support\Facades\Auth::user();
                      @endphp

                      @if ($user)
                        <th scope="col">Action</th>
                      @endif
                    </tr>
                    </thead>
                    <tbody>

                        @forelse ($trip as $trips)
                        <tr>
                            @php
                            $flote = App\Models\Category::findOrFail($trips->flote);
                            @endphp
                            <th scope="row">{{$flote->flotte}}</th>
                            <td>{{$trips->place_depart}} - {{$trips->place_arrivals}} </td>
                            @php
                                $date = Carbon\Carbon::parse($trips->date_depart);
                                $dateFormatee = $date->format('d/m/Y');
                            @endphp
                            <td>{{$dateFormatee}} {{$trips->heure_depart}} </td>
                            @php
                                $car = App\Models\Car::findOrFail($trips->car)
                            @endphp

                            <td>
                                <a href="{{route('Public.Reservation.car', ['id' => $car->id])}}" style="color: green">{{$car->plate_number}}</a>
                            </td>
                            <td>
                                @php
                                try {
                                    $verify = new Nari\Reservation\Reservation($trips->id, $trips->car);
                                    $verif = $verify->verify();
                                } catch (\Exception $e) {
                                    // Enregistrez l'exception dans les journaux Laravel pour le débogage
                                    \Log::error('Erreur lors de la vérification de la réservation : ' . $e->getMessage());
                                    // Vous pouvez également afficher un message d'erreur personnalisé ici si nécessaire
                                    $verif = false; // Par exemple
                                }


                                @endphp

                                @if ($verif === false)
                                    <p style="color: blue">Disponible</p>
                                @else
                                    <p style="color: red">Indisponible</p>
                                @endif

                            </td>
                            <td>{{$trips->status}}</td>
                            @if ($user)
                                <td>
                                    <a href="{{route('Public.Reservation.Auth.passenger', ['tripId' => $trips->id, 'carId' => $trips->car])}}" class="btn btn-primary" style="color: white">Reserver</a>
                                </td>
                            @endif

                        </tr>
                        @empty
                        <tr>
                            <th scope="row"></th>
                            <td></td>
                            <td></td>
                            <td> Aucune reservation disponible pour le moment</td>
                            <td></td>
                            <td></td>
                            @if ($user)
                                <td></td>
                            @endif

                        </tr>
                        @endforelse


                    </tbody>
                  </table>
            </div>
        </div>
    </div>
@endsection
