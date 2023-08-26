@extends('admin')

@section('title', 'Liste de tous nos voiture pour la flote'. $flote->flotte)

@section('content')
    <div class="container">
        <div class="pagetitle">
            <a href="{{route('Admin.Entreprise.flote.create')}}" class="btn btn-success" style="float: right">Ajouter une flote</a>
            <h1>Gestion de flote</h1>
            <nav>
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('Admin.index')}}">Tableau de bord</a></li>
                <li class="breadcrumb-item"><a href="{{route('Admin.Entreprise.flote.index')}}">Nos flote</a></li>
                <li class="breadcrumb-item">Listing de nos voiture en particulier</li>
              </ol>
            </nav>
          </div>
        <table class="table datatable">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Modèle</th>
                <th scope="col">Marque</th>
                <th scope="col">Imatriculation</th>
                
                <th scope="col">Année</th>
                <th scope="col">Action</th>
               
              </tr>
            </thead>
            <tbody>
                @forelse ($car as $cars)
                    <tr>
                        <th scope="row"><a href="{{route('Admin.Entreprise.flote.car.view', ['id' => $cars->id])}}" style="text-decoration: none">{{$cars->id}}</a></th>
                        <td>{{$cars->model}}</td>
                        <td>{{$cars->brand}}</td>
                        <td>{{$cars->plate_number}}</td>
                       
                        <td>{{$cars->year}}</td>
                        <td>
                            <a href="{{route('Admin.Entreprise.flote.car.view', ['id'=> $cars->id])}}" class="btn btn-primary">Voir</a>
                        </td>
                        
                    </tr>
                @empty
                    <tr>
                        <th scope="row"></th>
                        <td></td>
                        
                        <td style="text-align: center">Aucune voiture dispo pour le moment</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        
                        <td>
                        
                        </td>
                    </tr>
                @endforelse
             
            </tbody>
          </table>
    </div>

@endsection