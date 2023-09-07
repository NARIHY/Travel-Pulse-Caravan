@extends('admin')

@section('title', 'Faire une réservation')

@section('content')
<div class="pagetitle">

    <h1>Gestion de trajet</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('Admin.index')}}">Tableau de bord</a></li>
        <li class="breadcrumb-item">choisir le depart et l'ariver</li>
      </ol>
    </nav>
  </div>


<div class="container">
    <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="margin-bottom: 20px">
        <div class="progress-bar bg-danger"></div>
    </div>
    <form action="" method="post">
        @csrf
        <div class="row mb-3">
            <div class="col-6">
                <label for="place_depart">Lieu de départ</label>
                <select name="place_depart" id="place_depart" class="form-control @error('place_depart') is-invalid @enderror">
                    <option value="">Selectionner le lieu de départ</option>
                    @foreach ($city as $cities)
                        <option value="{{$cities}}">{{$cities}}</option>
                    @endforeach
                </select>
                @error('place_depart')
                <p style="color: rgb(114, 19, 19)">{{$message}}</p>
                @enderror
            </div>
            <div class="col-6">
                <label for="place_arrivals">Votre destination:</label>
                <select name="place_arrivals" id="place_arrivals" class="form-control @error('place_arrivals') is-invalid @enderror">
                    <option value="">Selectionner le lieu de d'arriver</option>
                    @foreach ($city as $cities)
                        <option value="{{$cities}}" >{{$cities}}</option>
                    @endforeach
                </select>
                @error('place_arrivals')
                <p style="color: rgb(114, 19, 19)">{{$message}}</p>
                @enderror
            </div>
        </div>

        <div class="d-grid gap-2" style="margin-top: 20px">

            <button class="btn btn-primary" type="submit">Continuer</button>
        </div>

    </form>
</div>

@endsection
