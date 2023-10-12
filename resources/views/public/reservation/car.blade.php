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

                    <h5><b style="color: red">Car Model:</b>  {{$car->model}}</h5>
                    @php
                        $cat = App\Models\Category::findOrFail($car->category);
                    @endphp
                    <h5><b style="color: red">Car Brand:</b>  {{$car->brand}}</h5>
                    <h5><b style="color: red">Fleet:</b>  {{$cat->fleet}}</h5>
                    <h5><b style="color: red">Year of Manufacture:</b>  {{$car->year}}</h5>
                    <h5><b style="color: red">License Plate:</b>  {{$car->plate_number}}</h5>
                    <h5><b style="color: red">Number of Seats:</b>  {{$car->place}} seats</h5>

                    <p style="text-align: justify">
                        Our cars transcend simple vehicles. Each one is a rolling work of art, an ode to innovation, design, and performance. They are more than just means of transportation; they are loyal travel partners, ready to take you wherever your heart desires.

                        Whether you want to venture in the city or head down the road of the unknown, our cars adapt to your pace. They embody elegance, with a fusion of advanced technology and unmatched comfort. Every journey becomes an unforgettable experience, a symphony of power, sophistication, and smooth driving.

                        Discover the road from a new perspective, experience the thrill of driving with our exceptional vehicles. Embark on an adventure that goes beyond boundaries because with our cars, every journey becomes a destination in itself.
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
