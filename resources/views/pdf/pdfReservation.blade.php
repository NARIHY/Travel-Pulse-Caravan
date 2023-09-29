<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reservation Pdf</title>
    <style>
       @page {
            size: A5 landscape; /* Format A5 en mode paysage */
            margin: 0;
            height: 400px;
        }
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 100%;
            height: 100%;
            margin: 0;
            background-color: #fff;

            box-sizing: border-box;
            font-size: 12px;
        }

        .headers {
            text-align: center;
            background-color: #007bff;
            color: #fff;
            margin-top: -20px;
            height: 80px;
            font-size: 20px;
            margin-bottom: 20px;
        }

        .info {
            text-align: left;
            margin-left: 20px;
        }

        .info h4 {
            color: #007bff;
            margin-top: 10px;
        }

        .qrCode {
            float: right; /* Positionnement à droite */
            margin-top: -140px; /* Ajustez la marge supérieure selon vos besoins */
            margin-right: 20px; /* Ajustez la marge droite selon vos besoins */
        }

    </style>
</head>
<body>
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
                        <p><strong>Date de Départ :</strong> {{$date}}</p>
                        <p><strong>Heure de Départ :</strong> {{$time}}</p>
                        <p><strong>Lieu de Départ :</strong> {{$trip->place_depart}}</p>
                        <p><strong>Lieu d'Arrivée :</strong> {{$trip->place_arrivals}}</p>
                    </div>
                    <img src="data:image/png;base64, {{base64_encode($qrCode)}}" alt="codeQr" class="qrCode">
                </div>

            </div>

        </div>

    </section>
</body>
</html>
<!DOCTYPE html>
<html>
