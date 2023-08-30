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
    <div class="progress mb-3" role="progressbar" aria-label="Success example with label" aria-valuenow="{{$purcount}}" aria-valuemin="0" aria-valuemax="100">
        <div class="progress-bar bg-success w-{{$purcount}}">{{$purcount}}</div>
    </div>
    <form action="" method="post">
        @csrf
        <div class="row mb-3">
            <div class="col-6">
                <label for="name">Nom du passager:</label>
                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{@old('name')}}">
                @error('name') 
                <p style="color: rgb(163, 0, 0)"> {{$message}} </p> 
                @enderror
            </div>
            <div class="col-6">
                <label for="last_name">Prénon du passager:</label>
                <input type="text" name="last_name" id="last_name" class="form-control @error('last_name') is-invalid @enderror" value="{{@old('last_name')}}">
                @error('last_name') 
                <p style="color: rgb(163, 0, 0)"> {{$message}} </p> 
                @enderror
            </div>
        </div>
        
        <div class="d-grid gap-2" style="margin-top: 20px">
                
            <button class="btn btn-primary" type="submit">Continuer</button>
        </div>
       
    </form>
</div>

@endsection