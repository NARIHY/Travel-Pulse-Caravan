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
    <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="margin-bottom: 20px">
        <div class="progress-bar bg-success"></div>
      </div>


      <h2 style="color: green">Réservation réussi</h2>

      <a href="{{route('Admin.pdf.export', ['purcount' => $purcount,'passenger_id' => $passenger_id, 'tripId' => $tripId])}}">Exporter</a>



</div>
@endsection