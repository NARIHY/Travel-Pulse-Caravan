@extends('admin')

@section('title', 'Faire une réservation, payement en cache')

@section('content')
<div class="pagetitle">
   
    <h1>Gestion de trajet</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('Admin.index')}}">Tableau de bord</a></li>
        <li class="breadcrumb-item">Réservation réussi</li>
      </ol>
    </nav>
  </div>


<div class="container">
    <div class="progress mb-3" role="progressbar" aria-label="Success example with label" aria-valuenow="{{$purcount}}" aria-valuemin="0" aria-valuemax="100">
        <div class="progress-bar bg-success w-{{$purcount}}">{{$purcount}}</div>
    </div>

    <div class="alert alert-success" style="text-align: center">
        Reservation réussi
    </div>

</div>
@endsection