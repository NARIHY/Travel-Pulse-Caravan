@extends('admin')

@section('title', 'Ajout de départ et destination')

@section('content')
<div class="pagetitle">
    <a href="{{route('Admin.Entreprise.flote.create')}}" class="btn btn-success" style="float: right">Ajouter une flote</a>
    <h1>Gestion de trajet</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('Admin.index')}}">Tableau de bord</a></li>
        <li class="breadcrumb-item"><a href="{{route('Admin.Entreprise.trip.travel.index')}}">Nos ville de départ et destination</a></li>
      </ol>
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
    <form action="" method="post">
        @csrf 
        <label for="place">Entrer le nom de la ville</label> 
        <input type="text" name="place" id="place" class="form-control @error('place') is-invalid @enderror" value="{{old('place')}}">
        <div>
            @error('place')
                <p style="color: rgb(175, 13, 13)">{{$message}}</p>
            @enderror
        </div>
            
        <div class="d-grid gap-2" style="margin-top: 20px">
                
            <button class="btn btn-primary" type="submit">Ajouter</button>
        </div>
    
    </form>
  </div>
@endsection