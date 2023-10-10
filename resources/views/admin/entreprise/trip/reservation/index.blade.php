@extends('admin')

@section('title', 'Faire une réservation')

@section('content')
<div class="pagetitle">
    <a href="{{route('Admin.Entreprise.trip.reservation.create.passenger')}}" class="btn btn-success" style="float: right">Reserver</a>
    <h1>Journey management</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('Admin.index')}}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{route('Admin.Entreprise.trip.planified.index')}}">Our reservation</a></li>
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

<table class="table datatable">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Car</th>
        <th scope="col">Place of departure</th>
        <th scope="col">Lieu de d'arriver</th>
        <th scope="col">fleet</th>
        <th scope="col">Date of departure</th>
        <th scope="col">departure time</th>
        <th scope="col">status</th>

      </tr>
    </thead>

    <tbody>
        @forelse ($trip as $trips)
            <tr>
                <th scope="row">{{$trips->id}}</th>
                @php
                $cars = App\Models\Car::findOrFail($trips->car);
                @endphp
                <td ><p style="color: blue">{{$cars->plate_number}}</p></td>
                <td> {{$trips->place_depart}} </td>
                <td>{{$trips->place_arrivals}}</td>
                @php

               $date = Carbon\Carbon::parse($trips->date_depart)->format('D d M Y');
               $time = Carbon\Carbon::parse($trips->heure_depart)->format('H:m:s');
               @endphp
                <td> {{$trips->flote}} </td>
                <td>{{$date}}</td>
                <td> <p style="color: red">{{$time}}</p> </td>
                <td> {{$trips->status}}</td>




            </tr>
        @empty
            <tr>
                <th scope="row"></th>
                <td></td>
                <td></td>
                <td></td>
                <td style="text-align: center">No trips available at the moment</td>
                <td></td>
                <td></td>


                <td>

                </td>
            </tr>
        @endforelse

    </tbody>
  </table>


@endsection
