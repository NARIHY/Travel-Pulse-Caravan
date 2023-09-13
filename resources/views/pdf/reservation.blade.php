<!DOCTYPE html>
<html>
<head>
    <title>Travel Pulse Caravan</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            margin: 0;
            padding: 0;
        }

        .header {
            text-align: center;
            font-size: 20px;
            height: 100px;
            background-color: #0074E4;
            color: white;
            padding-top: 20px;
        }

        .content {
            font-size: 14px;
            line-height: 1.5;
            margin: 20px;
            /* Supprimer la page-break */
        }

        .qrCode {
            float: right;
            margin-right: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            padding: 8px;
            text-align: left;
            /* Supprimer les bordures */
            border: none;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            /* Supprimer le pied de page */
            display: none;
        }
    </style>
</head>
<body>
    <div class="header">
        <h3>Travel Pulse Caravan</h3>
    </div>

    <div class="content">
        <div class="qrCode">
            <img src="data:image/png;base64, {{base64_encode($qrCode)}}" alt="codeQr" width="150px" >
        </div>
        <div class="information">
            <table>
                <tr>
                    <th colspan="2" style="text-align: center;">Réservation d'une place</th>
                </tr>
                <tr>
                    <th>Flote:</th>
                    <td>{{$flotte->flotte}}</td>
                </tr>
                <tr>
                    <th>Immatriculation de la voiture</th>
                    <td>{{$car->plate_number}}</td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>{{$trip->status}}</td>
                </tr>
                <tr>
                    <th>Destination</th>
                    <td>{{$trip->place_depart}} à {{$trip->place_arrivals}}</td>
                </tr>
                <tr>
                    <th>Heure de départ</th>
                    <td>{{$carDepart}}</td>
                </tr>
                <tr>
                    <th>Prix du ticket</th>
                    <td>{{number_format($trip->price, 0, '.', ' ')}} Ar</td>
                </tr>
            </table>
        </div>
    </div>

</body>
</html>
