<!DOCTYPE html>
<html>
<head>
    <title>Travel Pulse Caravan</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            margin: 20px;
        }

        .header {
            text-align: center;
            font-size: 20px;
            height: 150px;
            margin-bottom: 20px;
        }

        .content {
            font-size: 14px;
            line-height: 1.5;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <div class="header">
        <div style="float: right; padding-bottom: 20px">
           <img src="data:image/png;base64, {{base64_encode($qrCode)}}" alt="codeQr" width="150px" >
        </div>
        <h3>Fiche technique du {{$car->model}} {{$car->brand}} <br> N* {{$car->id}}</h3>
    </div>

    <div class="content" style="margin-top: 20px">
        <table>
            <tr>
                <th ></th>
                <th style="color: red">Information sur la voiture</th>
            </tr>
            <tr>
                <td style="color: blue">Modèle</td>
                <td style="text-align: center">{{$car->model}}</td>
            </tr>
            <tr>
                <td style="color: blue">Marque</td>
                <td style="text-align: center">{{$car->brand}}</td>
            </tr>

            <tr>
                <td style="color: blue">Plaque d'immatriculation</td>
                <td style="text-align: center"> {{$car->plate_number}} </td>
            </tr>
            <tr>
                <td style="color: blue">Nombre de place</td>
                <td style="text-align: center"> {{$car->place}} </td>
            </tr>
            <tr>
                <td style="color: blue">Année de sorti à madagascar</td>
                <td style="text-align: center"> {{$car->year}} </td>
            </tr>
            <!-- Ajoutez d'autres lignes de tableau ici... -->
            <tr>
                <td style="color: blue">Kilometrage</td>
                <td style="text-align: center">{{number_format($carInformation->kilometers, thousands_separator: ' ')}} Km</td>
            </tr>
            <tr>
                <td style="color: blue">Capacité de la réservoir</td>
                <td style="text-align: center"> {{$carInformation->max_fuel}} l</td>
            </tr>
            <tr>
                <td style="color: blue">Poids vide</td>
                <td style="text-align: center"> {{number_format($carInformation->min_weight, thousands_separator: ' ')}} Kg</td>
            </tr>
            <tr>
                <td style="color: blue">Charge maximale</td>
                <td style="text-align: center"> {{number_format($carInformation->max_weight, thousands_separator: ' ')}} Kg</td>
            </tr>
            <tr>
                <td style="color: blue">Date d'expiration de la visite technique:</td>
                <td style="text-align: center"> {{$carInformation->maintains}} </td>
            </tr>
            <tr>
                <td style="color: blue">Nom de la compagnie</td>
                <td style="text-align: center">
                    Travel Pulse Caravan
                </td>
            </tr>

            <tr>
                <td style="color: blue">Flote</td>
                @php 
                $flote = App\Models\Category::where('id', $car->category)
                                        ->value('flotte');
                @endphp
                <td style="text-align: center">{{$flote}}</td>
            </tr>

        </table>

    </div>
</body>
</html>