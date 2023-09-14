@extends('admin')

@section('title', 'Liste de nos départ et destination')

@section('content')
<div class="pagetitle">
    <a href="{{route('Admin.Entreprise.trip.travel.create')}}" class="btn btn-success" style="float: right">Ajouter une ville</a>
    <h1>Gestion de trajet</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('Admin.index')}}">Tableau de bord</a></li>
        <li class="breadcrumb-item"><a href="{{route('Admin.Entreprise.trip.travel.index')}}">Nos ville de départ et destination</a></li>
      </ol>
    </nav>
  </div>
  @if (session('success'))
    <div class="alert alert-success">
        <p class="text-center">{{session('success')}}</p>
    </div>
@endif
  @if (session('error'))
    <div class="alert alert-danger">
        <p class="text-center">{{session('error')}}</p>
    </div>
@endif

  <div>
    <table class="table table-striped">
      <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Ville</th>

      </tr>
      </thead>
      <tbody>
          @foreach ($travel as $categories)
              <tr>
                  <th scope="row">{{$categories->id}}</th>
                  <td>{{$categories->place}}</td>

              </tr>
          @endforeach


      </tbody>
    </table>
    {{$travel->links()}}
  </div>
@endsection
