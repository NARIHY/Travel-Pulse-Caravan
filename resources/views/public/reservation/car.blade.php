@extends('public')

@section('title' , 'Reservation')
<style>
    /* Style pour la carte */
.card {
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    margin-bottom: 20px;
}

/* Style pour les images */
.card img {
    width: 100%;
    height: auto;
    border-radius: 10px;
}

/* Style pour les détails de la voiture */
.card h5 {
    font-size: 18px;
    font-weight: bold;
    margin: 10px 0;
}

/* Style responsive */
@media (max-width: 768px) {
    .card {
        padding: 15px;
    }

    .card .row {
        flex-direction: column;
    }

    .card .col-6 {
        flex: 0 0 100%;
        max-width: 100%;
        padding: 10px;
        margin-bottom: 15px;
    }

    .card img {
        max-width: 100%;
    }
}

</style>

@section('content')
    <div class="container" style="margin-top: 100px">
        <div class="card" style="padding: 20px">
            <div class="row mb-3">
                <div class="col-md-6">
                    @foreach ($media as $medias)
                        <img src="{{$medias->getUrl()}}" alt="{{$car->model}}" width="100%" style="margin-top: 10px">
                    @endforeach
                </div>
                <div class="col-md-6">

                            <h5><b style="color: red">Modèle de la voiture:</b>  {{$car->model}}</h5>
                                @php
                                    $cat = App\Models\Category::findOrFail($car->category);
                                @endphp
                            <h5><b style="color: red">Marque de la voiture:</b>  {{$car->brand}}</h5>
                            <h5><b style="color: red">Flotte:</b>  {{$cat->flotte}}</h5>
                            <h5><b style="color: red">Année de sortie:</b>  {{$car->year}}</h5>
                            <h5><b style="color: red">Immatriculation:</b>  {{$car->plate_number}}</h5>
                            <h5><b style="color: red">Nombre de place:</b>  {{$car->place}} places</h5>

                            <p style="text-align: justify">
                                Nos voitures transcendent les simples véhicules. Chacune est une œuvre d'art roulante, un hymne à l'innovation, au design et à la performance. Elles sont bien plus que de simples moyens de transport, ce sont des partenaires de voyage fidèles, prêts à vous emmener là où votre cœur le désire.

Que vous souhaitiez vous aventurer en ville ou partir sur la route de l'inconnu, nos voitures s'adaptent à votre rythme. Elles incarnent l'élégance, avec une fusion de technologie avancée et de confort inégalé. Chaque trajet devient une expérience inoubliable, une symphonie de puissance, de sophistication et de douceur de conduite.

Découvrez la route sous un nouvel angle, découvrez l'émotion de la conduite avec nos véhicules exceptionnels. Embarquez pour une aventure qui transcende les limites, car avec nos voitures, chaque voyage devient une destination en soi.
                            </p>

                </div>
            </div>
        </div>
    </div>
@endsection
