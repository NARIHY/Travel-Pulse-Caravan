@extends('admin')

@section('title', 'Liste de nos départ et destination')

@section('content')
<div class="pagetitle">
    <a href="{{route('Admin.Entreprise.trip.planified.create')}}" class="btn btn-success" style="float: right">Ajouter un trajet</a>
    <h1>Gestion de trajet</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('Admin.index')}}">Tableau de bord</a></li>
        <li class="breadcrumb-item"><a href="{{route('Admin.Entreprise.trip.planified.index')}}">Nos trajets</a></li>
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
        <th scope="col">Voiture</th>
        <th scope="col">Lieu de départ</th>
        <th scope="col">Lieu de d'arriver</th>
        <th scope="col">flote</th>
        <th scope="col">Date de départ</th>
        <th scope="col">Heure de départ</th>
        <th scope="col">status</th>
        <th scope="col">Action</th>
       
      </tr>
    </thead>
    
    <tbody>
        @forelse ($trip as $trips)
            <tr>
                <th scope="row">{{$trips->id}}</th>
               
                <td ><p style="color: blue">{{$trips->car}}</p></td>
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
                
                
             
                <td>    
                    <div class="row mb-3">
                      <div class="col-6">
                        <a href="{{route('Admin.Entreprise.trip.planified.edit', ['id' => $trips->id])}}" class="btn btn-primary"><i class="bi bi-pencil"></i></a>
                      </div>
                      <div class="col-6">
                        <form action="{{route('Admin.Entreprise.trip.planified.delete', ['id' => $trips->id])}}" method="post">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-danger"><i class="bi bi-trash"></i></button>
                          
                        </form>
                      </div>
                    </div>
                    
                </td>
            </tr>
        @empty
            <tr>
                <th scope="row"></th>
                <td></td>
                <td></td>
                <td></td>
                <td style="text-align: center">Aucune trajet disponible pour le moment</td>
                <td></td>
                <td></td>
                <td></td>
                
                <td>
                
                </td>
            </tr>
        @endforelse
     
    </tbody>
  </table>
@endsection