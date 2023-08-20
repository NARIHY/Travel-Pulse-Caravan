@extends('admin')
@php
    $title = "";
    if(request()->routeIS('Admin.Entreprise.flote.car.create')){
        $title = 'Ajout d\'une voiture';
    } else {
        $title = 'Edition d\'une voiture';
    }
@endphp
@section('title', $title)

@section('content')
   
<div class="pagetitle">
    <h1>Gestion de voiture</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('Admin.index')}}">Tableau de bord</a></li>
        <li class="breadcrumb-item"><a href="{{route('Admin.Entreprise.flote.car.index')}}">Nos voiture</a></li>
    </nav>
</div>

@if (session('error'))
    <div class="alert alert-danger">
        <p class="text-center">{{session('error')}}</p>
    </div>
@endif
@if (session('success'))
    <div class="alert alert-success">
        <p class="text-center">{{session('success')}}</p>
    </div>
@endif

<div class="container">
    @if (request()->routeIS('Admin.Entreprise.flote.car.create'))
        <form action="" method="post" enctype="multipart/form-data">
        @csrf 
            <label for="model">Modèle de la voiture</label>
            <input type="text" name="model" id="model" class="form-control @error('model') is-invalid @enderror" value="{{ @old('model')}} ">
            @error('model')
                <p style="color:rgb(114, 19, 19)"> {{$message}} </p>
            @enderror


            <label for="brand">Marque de la voiture</label>
            <input type="text" name="brand" id="brand" class="form-control @error('brand') is-invalid @enderror" value="{{ @old('brand')}}">
            @error('brand')
                <p style="color:rgb(114, 19, 19)"> {{$message}} </p>
            @enderror

            <label for="plate_number">Plaque d'immatriculation</label>
            <input type="text" name="plate_number" id="plate_number" class="form-control @error('plate_number') is-invalid @enderror" value="{{ @old('plate_number')}}">
            @error('plate_number')
                <p style="color:rgb(114, 19, 19)"> {{$message}} </p>
            @enderror

            <label for="category">Nos flote</label>
            <select name="category" id="category" class="form-control @error('category') is-invalid @enderror">
                <option value="">Selectionner la flotte de la voiture</option>
                    @foreach($category as $title => $id)
                        <option value="{{$title}}">{{$id}}</option>
                    @endforeach
            </select>
            @error('category')
                <p style="color: rgb(114, 19, 19)">{{$message}}</p>
            @enderror

            <label for="place">Nombre de place de la voiture</label>
            <select name="place" id="place" class="form-control @error('place') is-invalid @enderror">
                <option value="">Selectionner la flotte de la voiture</option>
                <option value="3">3</option>
                <option value="9">9</option>
                <option value="12">12</option>
                <option value="22">22</option>
                <option value="32">32</option>
                <option value="42">42</option>
            </select>
            @error('place')
            <p style="color: rgb(114, 19, 19)">{{$message}}</p>
            @enderror

            <label for="year">Année de sortie de la voiture</label>
            <select name="year" id="year" class="form-control @error('year') is-invalid @enderror">
                <option value="">Selectionner l'année de sortie de la voiture</option>
                @php
                $date = date('Y');
                @endphp
                @for($i = $date; $i >= 2000; $i--)
                    <option value="{{$i}}">{{$i}}</option>
                @endfor
            </select>
            @error('year')
            <p style="color: rgb(114, 19, 19)">{{$message}}</p>
            @enderror

            <label for="vehicule_info">Etat du vehicule</label>
            <select name="vehicule_info" id="vehicule_info" class="form-control @error('vehicule_info') is-invalid @enderror">
                <option value="">Selectionner la flotte de la voiture</option>
                <option value="Bonne etat">Bonne etat</option>
                <option value="Moyenne etat">Moyenne etat</option>
                <option value="Mauvaise etat">Mauvaise etat</option>
            </select>
            @error('vehicule_info')
            <p style="color: rgb(114, 19, 19)">{{$message}}</p>
            @enderror

            <label for="media">Ajouter une photo de la voiture</label>
            <input type="file" name="media" id="media" class="form-control @error('media') is-invalid @enderror">
            @error('media')
                <p style="color:rgb(114, 19, 19)"> {{$message}} </p>
            @enderror
            <div class="d-grid gap-2" style="margin-top: 20px">
                
                <button class="btn btn-primary" type="submit">Créer</button>
            </div>
        

        </form>
    @else
    <form action="" method="post" enctype="multipart/form-data">
        @csrf 
        @method('PUT')
            <label for="model">Modèle de la voiture</label>
            <input type="text" name="model" id="model" class="form-control @error('model') is-invalid @enderror" value="{{$car->model}} ">
            @error('model')
                <p style="color:rgb(114, 19, 19)"> {{$message}} </p>
            @enderror


            <label for="brand">Marque de la voiture</label>
            <input type="text" name="brand" id="brand" class="form-control @error('brand') is-invalid @enderror" value="{{ $car->brand}}">
            @error('brand')
                <p style="color:rgb(114, 19, 19)"> {{$message}} </p>
            @enderror

            <label for="plate_number">Plaque d'immatriculation</label>
            <input type="text" name="plate_number" id="plate_number" class="form-control @error('plate_number') is-invalid @enderror" value="{{$car->plate_number}}">
            @error('plate_number')
                <p style="color:rgb(114, 19, 19)"> {{$message}} </p>
            @enderror

            <label for="category">Nos flote</label>
            <select name="category" id="category" class="form-control @error('category') is-invalid @enderror">
                <option value="">Selectionner la flotte de la voiture</option>
                    @foreach($category as $title => $id)
                        <option value="{{$title}}" @if($title == $car->category) selected @endif>{{$id}}</option>
                    @endforeach
                    
            </select>
            @error('category')
                <p style="color: rgb(114, 19, 19)">{{$message}}</p>
            @enderror

            <label for="place">Nombre de place de la voiture</label>
            <select name="place" id="place" class="form-control @error('place') is-invalid @enderror">
                <option value="">Selectionner la flotte de la voiture</option>
                <option value="3" @if($car->place == 3) selected @endif>3</option>
                <option value="9" @if($car->place == 9) selected @endif>9</option>
                <option value="12" @if($car->place == 12) selected @endif>12</option>
                <option value="22" @if($car->place == 22) selected @endif>22</option>
                <option value="32" @if($car->place == 32) selected @endif>32</option>
                <option value="42" @if($car->place == 42) selected @endif>42</option>
            </select>
            @error('place')
            <p style="color: rgb(114, 19, 19)">{{$message}}</p>
            @enderror

            <label for="year">Année de sortie de la voiture</label>
            <select name="year" id="year" class="form-control @error('year') is-invalid @enderror">
                <option value="">Selectionner l'année de sortie de la voiture</option>
                @php
                $date = date('Y');
                @endphp
                @for($i = $date; $i >= 2000; $i--)
                    <option value="{{$i}}" @if($i == $car->year) selected @endif>{{$i}}</option>
                     
                @endfor
                
            </select>
              
            @error('year')
            <p style="color: rgb(114, 19, 19)">{{$message}}</p>
            @enderror

            <label for="vehicule_info">Etat du vehicule</label>
            <select name="vehicule_info" id="vehicule_info" class="form-control @error('vehicule_info') is-invalid @enderror">
                <option value="">Selectionner la flotte de la voiture</option>
                <option value="Bonne etat" @if($car->vehicule_info == "Bonne etat") selected @endif>Bonne etat</option>
                <option value="Moyenne etat" @if($car->vehicule_info == "Moyenne etat") selected @endif>Moyenne etat</option>
                <option value="Mauvaise etat" @if($car->vehicule_info == "Mauvaise etat") selected @endif>Mauvaise etat</option>
            </select>
            @error('vehicule_info')
            <p style="color: rgb(114, 19, 19)">{{$message}}</p>
            @enderror

            <div class="row mb-3">
                <div class="col-6">
                    <label for="media">Ajouter une photo de la voiture</label>
                    <input type="file" name="media" id="media" class="form-control @error('media') is-invalid @enderror">
                    @error('media')
                        <p style="color:rgb(114, 19, 19)"> {{$message}} </p>
                    @enderror
                </div>
                <div class="col-6">
                    @foreach($mediaCollection as $media)
              
                    <img src="{{ $media->getUrl() }}" alt="{{$media->name}}" width="100%">
                
                    @endforeach
                </div>
            </div>

            
            <div class="d-grid gap-2" style="margin-top: 20px">
                
                <button class="btn btn-primary" type="submit">Modifier</button>
            </div>
        

        </form>

    @endif

</div>

@endsection