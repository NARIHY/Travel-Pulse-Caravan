@extends('public')
@section('title', 'Reservation')


@section('content')
<style>
    body {
        background-color: #f5f5f5;
        font-family: Arial, sans-serif;
        padding: 20px;
    }



    .headers {
        text-align: center;
        background-color: #000000;
        color: #fff;
        padding: 20px;
        border-radius: 10px 10px 0 0;
    }

    .info {
        margin-top: 20px;
        text-align: left
    }

    .info h4 {
        color: #007bff;
    }

    .info p {
        margin-bottom: 5px;
    }

    .qr-code {
        text-align: right;
        margin-top: 140px;
        margin-right: 20px;
    }

    .pay-button {
        text-align: center;
        margin-top: 20px;
    }

    .pay-button button {
        background-color: #007bff;
        color: #fff;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        font-weight: bold;
    }

    .pay-button button:hover {
        background-color: #0056b3;
    }
</style>
<section id="contact" class="contact" style="margin-top: 40px">
    @php

                              $car = App\Models\Car::findOrFail($trip->car);
                              $categ = App\Models\Category::findOrFail($trip->flote);

                              $date = Carbon\Carbon::parse($trip->date_depart)->format('D d M Y');
                              $time = Carbon\Carbon::parse($trip->heure_depart)->format('H:m:s');
                              $now = date('D d M Y');
                              @endphp
     <div class="container">
        <div class="headers">
            <h1>Ticket de reservation</h1>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <div class="info" style="margin-left: 10px">
                    <h4>Informations sur la Réservation :</h4>
                    <p><strong>Nom du Client :</strong> {{$passenger->name}}</p>
                    <p><strong>Prénom du Client :</strong> {{$passenger->last_name}}</p>
                    <p><strong>Date de Réservation :</strong> {{$now}}</p>
                    <p><strong>Compagnie :</strong> Travel Pulse Caravan</p>
                    <p><strong>Flote :</strong> {{$categ->flotte}}</p>
                    <p><strong>Immatriculation Voiture :</strong> {{$car->plate_number}}</p>
                    <p><strong>Date of departure :</strong> {{$date}}</p>
                    <p><strong>departure time :</strong> {{$time}}</p>
                    <p><strong>Place of departure :</strong> {{$trip->place_depart}}</p>
                    <p><strong>Lieu d'Arrivée :</strong> {{$trip->place_arrivals}}</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="qr-code">
                    <!-- Insérez ici votre code QR -->
                    {!! $qrCode !!}
                </div>
            </div>
        </div>

    </div>


</section>
@endsection
