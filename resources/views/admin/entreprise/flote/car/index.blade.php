@extends('admin')

@section('title', 'Nos voiture')

@section('content')

<div class="pagetitle">
    <a href="{{route('Admin.Entreprise.flote.car.create')}}" class="btn btn-success" style="float: right">Ajouter une voiture</a>
    <h1>Gestion de flote</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('Admin.index')}}">Tableau de bord</a></li>
        <li class="breadcrumb-item"><a href="{{route('Admin.Entreprise.flote.index')}}">Nos voiture</a></li>
      </ol>
    </nav>
  </div>

  <!-- -->
  <section class="section dashboard">
    @if(session('success'))
      <div class="alert alert-success" style="text-align: center">
        {{session('success')}}
      </div>
    @endif
    @if(session('error'))
      <div class="alert alert-danger" style="text-align: center">
        {{session('error')}}
      </div>
    @endif

    <div>
        <table class="table datatable">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Modèle</th>
                <th scope="col">Marque</th>
                <th scope="col">Imatriculation</th>
                <th scope="col">Flote</th>
                <th scope="col">Année</th>
                <th scope="col">Action</th>
               
              </tr>
            </thead>
            <tbody>
                @forelse ($car as $cars)
                    <tr>
                        <th scope="row">{{$cars->id}}</th>
                        <td>{{$cars->model}}</td>
                        <td>{{$cars->brand}}</td>
                        <td>{{$cars->plate_number}}</td>
                        @php 
                          
                          $category = App\Models\Category::where('id', $cars->category)
                                                          ->value('flotte');
                        @endphp
                        <td>{{$category}}</td>
                        <td>{{$cars->year}}</td>
                        <td>    
                            
                            <div class="row mb-3">
                              <div class="col-6">
                                <a href="{{route('Admin.Entreprise.flote.car.edit', ['id'=> $cars->id])}}" class="btn btn-primary">Modifier</a>
                              </div>
                              <div class="col-6">
                                  <form action="{{route('Admin.Entreprise.flote.car.delete', ['id' => $cars->id])}}" method="post">
                                      @csrf
                                      @method('DELETE')
                                      <input type="submit" class="btn btn-danger" value="Supprimer">
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
                        <td style="text-align: center">Aucune flote pour le moment</td>
                        <td></td>
                        <td></td>
                        
                        <td>
                        
                        </td>
                    </tr>
                @endforelse
             
            </tbody>
          </table>
          {{$car->links()}}
    </div>
  </section>

@endsection