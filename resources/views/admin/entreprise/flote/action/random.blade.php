@extends('admin')
@php
    $title = "";
    if(request()->routeIS('Admin.Entreprise.flote.create')){
        $title = 'Création d\'une flote';
    } else {
        $title = 'Edition d\'une flote';
    }
@endphp
@section('title', $title)

@section('content')
   
<div class="pagetitle">
    <h1>Acceuil du site</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('Admin.index')}}">Tableau de bord</a></li>
        <li class="breadcrumb-item"><a href="{{route('Admin.Entreprise.flote.index')}}">Nos flote</a></li>
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
    @if (request()->routeIS('Admin.Entreprise.flote.create'))
        
    <form action="" method="post" enctype="multipart/form-data">
        @csrf
        <label for="flotte">Nom du flotte</label>
        <input type="text" name="flotte" id="flotte" class="form-control @error('flotte') is-invalid @enderror" value="{{$category->flotte}}">
        @error('flotte')
            <p style="color:rgb(114, 19, 19)"> {{$message}} </p>
        @enderror

        <div class="d-grid gap-2" style="margin-top: 20px">
            
            <button class="btn btn-primary" type="submit">Créer</button>
        </div>
    </form>
    @else

    <form action="" method="post">
        @csrf
        @method('PUT')
        <label for="flotte">Nom du flotte</label>
        <input type="text" name="flotte" id="flotte" class="form-control @error('flotte') is-invalid @enderror" value="{{$category->flotte}}">
        @error('flotte')
            <p style="color:rgb(114, 19, 19)"> {{$message}} </p>
        @enderror

        <div class="d-grid gap-2" style="margin-top: 20px">
            <button class="btn btn-primary" type="submit">Modifier</button>
        </div>
    </form>
        
    @endif
</div>

@endsection