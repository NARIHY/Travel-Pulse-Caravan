@extends('admin')
@php
    $title = "";
    if(request()->routeIS('Admin.Entreprise.flote.car.carInformation.create')){
        $title = 'Ajout d\'une information sur une voiture';
    } else {
        $title = 'Edition d\'une information sur une voiture';
    }
@endphp
@section('title', $title)

@section('content')
<div class="pagetitle">
    <h1>Gestion de voiture</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('Admin.index')}}">Tableau de bord</a></li>
        <li class="breadcrumb-item"><a href="{{route('Admin.Entreprise.flote.car.carInformation.index')}}">liste des voitures qui sont definie</a></li>
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
    @if(request()->routeIS('Admin.Entreprise.flote.car.carInformation.create'))

    <form action="" method="post">
        @csrf
        <label for="car">Immatriculation</label>
        <select name="car" id="car" class="form-control @error('car') is-invalid @enderror">
            <option value="">Selectionner la flotte de la voiture</option>
                @foreach($car as $k => $v)
                    <option value="{{$v}}">{{$k}}</option>
                @endforeach
        </select>
        @error('car')
            <p style="color: rgb(114, 19, 19)">{{$message}}</p>
        @enderror

        <label for="kilometers">Nombre totale de kilometre</label>
        <input type="text" name="kilometers" id="kilometers" class="form-control @error('kilometers') is-invalid @enderror" value="{{@old('kilometers')}}">
        @error('kilometers')
            <p style="color: rgb(114, 19, 19)">{{$message}}</p>
        @enderror

        <label for="max_fuel">reservoir maximale</label>
        <input type="number" name="max_fuel" id="max_fuel" class="form-control @error('max_fuel') is-invalid @enderror" max="100" value="{{@old('max_fuel')}}">
        @error('max_fuel')
            <p style="color: rgb(114, 19, 19)">{{$message}}</p>
        @enderror

        <label for="min-weight">Charge minimale</label>
        <input type="number" name="min_weight" id="min-weight" class="form-control @error('min-weight') is-invalid @enderror"  value="{{@old('min-weight')}}">
        @error('min-weight')
            <p style="color: rgb(114, 19, 19)">{{$message}}</p>
        @enderror

        <label for="max-weight">Charge maximale</label>
        <input type="number" name="max_weight" id="max-weight" class="form-control @error('max-weight') is-invalid @enderror"  value="{{@old('max-weight')}}">
        @error('max-weight')
            <p style="color: rgb(114, 19, 19)">{{$message}}</p>
        @enderror

        <label for="maintains">Date d'expiration de la visite technique</label>
        <input type="date" name="maintains" id="maintains" class="form-control @error('maintains') is-invalid @enderror">
        @error('maintains')
        <p style="color: rgb(114, 19, 19)">{{$message}}</p>
        @enderror

        <div class="d-grid gap-2" style="margin-top: 20px">
                
            <button class="btn btn-primary" type="submit">Ajouter</button>
        </div>
        
    </form>

    @else
    @endif
</div>
@endsection