<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reservation PDF</title>
    <style>
        @page {
            size: A5 landscape;
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
            font-size: 14px;
        }
        .headers {
            text-align: center;
            background-color: #000000;
            color: #ffffff;
            padding: 20px;
            font-size: 24px;
        }
        .info {
            margin: 20px;
            padding: 10px;
        }
        .info h2 {
            color: #007bff;
        }
        .info p {
            margin-bottom: 10px;
        }
        .qrCode {
            float: right;
            margin-top: -200px;
            margin-right: 20px;
        }
    </style>
</head>
<body>
    <section id="contact" class="contact">
        @php
            $car = App\Models\Car::findOrFail($trip->car);
            $categ = App\Models\Category::findOrFail($trip->flote);
            $date = Carbon\Carbon::parse($trip->date_depart)->format('l, d F Y');
            $time = Carbon\Carbon::parse($trip->heure_depart)->format('H:i:s');
            $now = date('l, d F Y');
        @endphp
        <div class="container">
            <div class="headers">
                <h1>Ticket de réservation</h1>
            </div>
            <div class="info">
                <h2>Informations sur la Réservation :</h2>
                <p><strong>Client name:</strong> {{$passenger->name}} {{$passenger->last_name}}</p>
                <p><strong>Booking date:</strong> {{$now}}</p>
                <p><strong>Company:</strong> Travel Pulse Caravan</p>
                <p><strong>Fleet:</strong> {{$categ->flotte}}</p>
                <p><strong>Vehicle registration:</strong> {{$car->plate_number}}</p>
                <p><strong>Date of departure:</strong> {{$date}}</p>
                <p><strong>Departure time:</strong> {{$time}}</p>
                <p><strong>Place of departure:</strong> {{$trip->place_depart}}</p>
                <p><strong>Arrival point:</strong> {{$trip->place_arrivals}}</p>
            </div>
            <img src="data:image/png;base64, {{base64_encode($qrCode)}}" alt="codeQr" class="qrCode">
        </div>
    </section>
</body>
</html>
