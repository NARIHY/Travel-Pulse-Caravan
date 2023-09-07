@extends('admin')

@section('title', 'Faire une réservation')

@section('content')
<div class="pagetitle">

    <h1>Gestion de trajet</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('Admin.index')}}">Tableau de bord</a></li>
        <li class="breadcrumb-item">Information sur le passager</li>
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
    <div class="progress mb-3" role="progressbar" aria-label="Success example with label" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
        <div class="progress-bar"></div>
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
        <div class="row mb-3">
            <div class="col-6">
                <label for="phone_number">Téléphone du passager:</label>
                <div class="input-group mb-3">

                    <span class="input-group-text" id="basic-addon3">+261</span>
                    <input type="text" class="form-control @error('phone_number') is-invalid @enderror" id="basic-url" aria-describedby="basic-addon3" name="phone_number" value="{{@old('phone_number')}}">

                </div>
                @error('phone_number')
                <p style="color: rgb(163, 0, 0)"> {{$message}} </p>
                @enderror
            </div>
            <div class="col-6">
                <label for="emergency_contact">Téléphone du personne à contacter en cas d'urgence:</label>
                <div class="input-group mb-3">

                    <span class="input-group-text" id="basic-addon3">+261</span>
                    <input type="text" class="form-control @error('emergency_contact') is-invalid @enderror" id="basic-url" aria-describedby="basic-addon3" name="emergency_contact" value="{{@old('phone_number')}}">

                </div>
                @error('emergency_contact')
                    <p style="color: rgb(163, 0, 0)"> {{$message}} </p>
                @enderror
            </div>
        </div>

        <div>
            <label for="email">Addresse email:</label>
            <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{@old('email')}}">
            @error('email')
            <p style="color: rgb(163, 0, 0)"> {{$message}} </p>
            @enderror
        </div>

        <div>
            <label for="address">Lieu de résidence:</label>
            <input type="text" name="address" id="address" class="form-control @error('address') is-invalid @enderror" value="{{@old('address')}}">
            @error('address')
            <p style="color: rgb(163, 0, 0)"> {{$message}} </p>
            @enderror
        </div>

        <div class="d-grid gap-2" style="margin-top: 20px">

            <button class="btn btn-primary" type="submit">Continuer</button>
        </div>

    </form>
</div>

@endsection
