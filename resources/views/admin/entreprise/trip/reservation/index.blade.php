@extends('admin')

@section('title', 'Faire une réservation')

@section('content')
<div class="pagetitle">
    <a href="{{route('Admin.Entreprise.trip.reservation.create.passenger')}}" class="btn btn-success" style="float: right">Reserver</a>
    <h1>Gestion de trajet</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('Admin.index')}}">Tableau de bord</a></li>
        <li class="breadcrumb-item"><a href="{{route('Admin.Entreprise.trip.planified.index')}}">Nos réservation</a></li>
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


@endsection