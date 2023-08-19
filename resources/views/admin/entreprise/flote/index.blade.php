@extends('admin')

@section('title', 'Nos flote')

@section('content')

<div class="pagetitle">
    <a href="{{route('Admin.Entreprise.flote.create')}}" class="btn btn-success" style="float: right">Ajouter une flote</a>
    <h1>Acceuil du site</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('Admin.index')}}">Tableau de bord</a></li>
        <li class="breadcrumb-item"><a href="{{route('Admin.Entreprise.flote.index')}}">Nos flote</a></li>
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
                <th scope="col">Titre</th>
                <th scope="col">Action</th>
               
              </tr>
            </thead>
            <tbody>
                @forelse ($category as $categories)
                    <tr>
                        <th scope="row">{{$categories->id}}</th>
                        <td>{{$categories->flotte}}</td>
                        <td>    
                            <a href="{{route('Admin.Entreprise.flote.edit', ['id'=> $categories->id])}}" class="btn btn-primary">Modifier</a>
                            
                        </td>
                    </tr>
                @empty
                    <tr>
                        <th scope="row"></th>
                        <td style="text-align: center">Aucune flote pour le moment</td>
                        <td>
                        
                        </td>
                    </tr>
                @endforelse
             
            </tbody>
          </table>
    </div>
  </section>

@endsection