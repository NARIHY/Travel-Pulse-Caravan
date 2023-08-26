<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Travel pulse caravan</title>

     <!-- Vendor CSS Files -->
  

</head>
<body>
    
</body>

<div >
    <h1 style="text-align: right">{{$car->model}}</h1>
    <h1 style="text-align: left">Modèle:</h1>

    <h1 style="text-align: right">{{$car->brand}}</h1>
    <h1 style="text-align: left">Marque:</h1>

    <h1 style="text-align: right">{{$car->plate_number}}</h1>
    <h1 style="text-align: left">immatriculation:</h1>


    <h1 style="text-align: right">{{$car->year}}</h1>
    <h1 style="text-align: left">Année de sortie:</h1>

    <h1 style="text-align: right">{{$car->place}} places</h1>
    <h1 style="text-align: left">Nombre de place:</h1>

    <h1 style="text-align: right">{{$car->vehicule_info}}</h1>
    <h1 style="text-align: left">Etat:</h1>

    @php 
            $flote = App\Models\Category::where('id', $car->category)
                                    ->value('flotte');
            @endphp
    <h1 style="text-align: right">{{$flote}}</h1>
    <h1 style="text-align: left">Flote:</h1>

    <img src="{{$car->media}}" alt="image"  style="float: right" width="250px" >      

    <h1 style="float: left">Photo de la voiture:</h1>

    <img src="{{$qrCode}}" alt="image"  style="float: right" >      
    
    <h1 style="text-align: left">Identification de la voiture:</h1>

</div>
</html>






