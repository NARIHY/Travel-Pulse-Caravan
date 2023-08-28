@extends('admin')
@php
    $title = "";
    if(request()->routeIS('Admin.Entreprise.trip.planified.create')){
        $title = 'Planification d\'un trajet';
    } else {
        $title = 'PModification d\'un trajet planifier';
    }
@endphp
@section('title', $title)

@section('content')
   
<div class="pagetitle">
    <h1>Gestion de trajet</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('Admin.index')}}">Tableau de bord</a></li>
        <li class="breadcrumb-item"><a href="{{route('Admin.Entreprise.trip.planified.index')}}">Nos trajets</a></li>
        <li class="breadcrumb-item">gestion de trajet</li>
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
    @if(request()->routeIS('Admin.Entreprise.trip.planified.create'))
        <form action="" method="post">
            @csrf
            <label for="car">Selectionner une voiture</label>
            <select name="car" id="car" class="form-control @error('car') is-invalid @enderror">
                <option value="">Selectionner la voiture</option>
                @foreach ($car as $cars)
                    <option value="{{$cars}}">{{$cars}}</option>    
                @endforeach
            </select>
            @error('car')
            <p style="color: rgb(114, 19, 19)">{{$message}}</p>
            @enderror

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
                    <label for="place_arrivals">Lieu d'arriver</label>
                    <select name="place_arrivals" id="place_arrivals" class="form-control @error('place_arrivals') is-invalid @enderror">
                        <option value="">Selectionner le lieu de d'arriver</option>
                        @foreach ($city as $cities)
                            <option value="{{$cities}}">{{$cities}}</option>    
                        @endforeach
                    </select>
                    @error('place_arrivals')
                    <p style="color: rgb(114, 19, 19)">{{$message}}</p>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-6">
                    <label for="date_depart">Date de départ</label>
                    <input type="date" name="date_depart" id="date_depart" class="form-control @error('date_depart') is-invalid @enderror">
                    @error('date_depart')
                    <p style="color: rgb(114, 19, 19)">{{$message}}</p>
                    @enderror
                </div>
                <div class="col-6">
                    <label for="heure_depart">heure de départ</label>
                    <input type="time" name="heure_depart" id="date_depart" class="form-control @error('heure_depart') is-invalid @enderror">
                    @error('heure_depart')
                    <p style="color: rgb(114, 19, 19)">{{$message}}</p>
                    @enderror
                </div>
            </div>
            <label for="status">Status</label>
                    <select name="status" id="status" class="form-control @error('status') is-invalid @enderror">
                        <option value="">Selectionner le status</option>
                        @foreach ($statement as $statues)
                            <option value="{{$statues}}">{{$statues}}</option>    
                        @endforeach
                    </select>
                    @error('status')
                    <p style="color: rgb(114, 19, 19)">{{$message}}</p>
                    @enderror
                    <div class="d-grid gap-2" style="margin-top: 20px">
                
                        <button class="btn btn-primary" type="submit">Sauvgarder</button>
                    </div>
        </form>
    @else 
    <form action="" method="post">
        @csrf
        @method('PUT')
        <label for="car"> Selectionner une voiture</label>
        <select name="car" id="car" class="form-control @error('car') is-invalid @enderror">
            <option value="{{$trip->car}}">{{$trip->car}}</option>
           
        </select>
        @error('car')
        <p style="color: rgb(114, 19, 19)">{{$message}}</p>
        @enderror

        <div class="row mb-3">
            <div class="col-6">
                <label for="place_depart">Lieu de départ</label>
                <select name="place_depart" id="place_depart" class="form-control @error('place_depart') is-invalid @enderror">
                    <option value="">Selectionner le lieu de départ</option>
                    @foreach ($city as $cities)
                        <option value="{{$cities}}" @if($cities === $trip->place_depart) selected @endif>{{$cities}}</option>    
                    @endforeach
                </select>
                @error('place_depart')
                <p style="color: rgb(114, 19, 19)">{{$message}}</p>
                @enderror
            </div>
            <div class="col-6">
                <label for="place_arrivals">Lieu d'arriver</label>
                <select name="place_arrivals" id="place_arrivals" class="form-control @error('place_arrivals') is-invalid @enderror">
                    <option value="">Selectionner le lieu de d'arriver</option>
                    @foreach ($city as $cities)
                        <option value="{{$cities}}" @if($cities === $trip->place_arrivals) selected @endif>{{$cities}}</option>    
                    @endforeach
                </select>
                @error('place_arrivals')
                <p style="color: rgb(114, 19, 19)">{{$message}}</p>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            @php 
               $time = Carbon\Carbon::parse($trip->heure_depart)->format('H:m');
            @endphp 
            <div class="col-6">
                <label for="date_depart">Date de départ</label>
                <input type="date" name="date_depart" id="date_depart" class="form-control @error('date_depart') is-invalid @enderror" value="{{$trip->date_depart}}">
                @error('date_depart')
                <p style="color: rgb(114, 19, 19)">{{$message}}</p>
                @enderror
            </div>
            <div class="col-6">
                <label for="heure_depart">heure de départ</label>
                <input type="time" name="heure_depart" id="date_depart" class="form-control @error('heure_depart') is-invalid @enderror" value="{{$time}}">
                @error('heure_depart')
                <p style="color: rgb(114, 19, 19)">{{$message}}</p>
                @enderror
            </div>
        </div>
        <label for="status">Status</label>
                <select name="status" id="status" class="form-control @error('status') is-invalid @enderror">
                    <option value="">Selectionner le status</option>
                    @foreach ($statement as $statues)
                        <option value="{{$statues}}"  @if($statues === $trip->status) selected @endif>{{$statues}}</option>    
                    @endforeach
                </select>
                @error('status')
                <p style="color: rgb(114, 19, 19)">{{$message}}</p>
                @enderror
                <div class="d-grid gap-2" style="margin-top: 20px">
            
                    <button class="btn btn-success" type="submit">Sauvgarder</button>
                </div>
    </form>
    @endif
</div>
@endsection