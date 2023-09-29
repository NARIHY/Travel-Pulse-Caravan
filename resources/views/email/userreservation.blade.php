<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reservation Pdf</title>
    <style>
        /* Ajoutez ici vos styles CSS */
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
            font-size: 12px;
        }
        .headers {
            text-align: center;
            background-color: #000000;
            color: #fff;
            margin-top: -20px;
            padding: 20px;
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
        .content {
            margin: 20px;
        }
        .content p {
            margin-bottom: 15px;
        }
        .salutation {
            font-size: 18px;
            color: #007bff;
            margin-top: 10px;
        }
        .finals {
            font-style: italic;
            margin-top: 20px;
        }
        .link {
            color: #007bff;
            text-decoration: none;
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
            <div class="container">
                <div class="header">
                    <h1>Confirmation de Réservation</h1>
                </div>
                <div class="content">
                    <p class="salutation">Cher client,</p>
                    <p>
                        C'est avec une grande joie que nous vous annonçons que votre réservation a été traitée avec succès ! Nous tenons à vous remercier pour la confiance que vous avez placée en notre compagnie. Votre réservation marque le début d'une aventure exceptionnelle, que ce soit pour une escapade romantique, des vacances en famille ou un voyage d'affaires crucial.
                    </p>
                    <p>
                        Nous sommes déterminés à faire de votre voyage une expérience mémorable. Notre équipe a soigneusement préparé chaque détail pour vous assurer un voyage en toute sérénité. Vous pouvez vous attendre à des moments extraordinaires à chaque étape de votre voyage.
                    </p>
                    <p>
                        Merci de choisir notre compagnie. Nous sommes impatients de vous servir et de vous offrir un voyage inoubliable.
                    </p>
                    <p class="finals">Cordialement, L'équipe de Travel Pulse Caravan</p>
                    <p><strong>Lien vers votre ticket de réservation :</strong> <a class="link" href="{{ route('Public.Reservation.Auth.PdfG', ['reservationId' => $reservation->id]) }}">Cliquez ici</a></p>
                </div>
            </div>
        </div>
    </section>
</body>
</html>
