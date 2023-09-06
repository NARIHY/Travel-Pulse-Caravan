@extends('admin')

@section('title', 'Acceuil du site')

@section('content')

<div class="pagetitle">
    <a href="{{route('Admin.Home.create')}}" class="btn btn-success" style="float: right">Ajouter une publication</a>
    <h1>Interface visuelle</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('Admin.index')}}">Tableau de bord</a></li>
        <li class="breadcrumb-item"><a href="{{route('Admin.Home.index')}}">acceuil du site</a></li>
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
                @forelse ($home as $homes)
                    <tr>
                        <th scope="row">{{$homes->id}}</th>
                        <td>{{$homes->title}}</td>
                        <td>

                           <div class="row mb-3">
                                <div class="col-6">
                                    <a href="{{route('Admin.Home.edit', ['id'=> $homes->id])}}" class="btn btn-primary">Modifier</a>
                                </div>
                                <div class="col-6">
                                    <form action="{{route('Admin.Home.delete', ['id' => $homes->id])}}" method="post">
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
                        <td style="text-align: center">Aucune publication pour le moment</td>
                        <td>

                        </td>
                    </tr>
                @endforelse

            </tbody>
          </table>
    </div>
  </section>

@endsection
