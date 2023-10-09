@extends('admin')

@section('title', 'Liste de tous nos flote')

@section('content')
    <div class="container">

      <div class="pagetitle">
        <a href="{{route('Admin.Entreprise.flote.create')}}" class="btn btn-success" style="float: right">Ajouter une flote</a>
        <h1>Fleet management</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('Admin.index')}}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{route('Admin.Entreprise.flote.index')}}">Our fleets</a></li>
            <li class="breadcrumb-item">Listing of our specific cars</li>
          </ol>
        </nav>
      </div>
        @if(session('error'))
      <div class="alert alert-danger" style="text-align: center">
        {{session('error')}}
      </div>
    @endif
        <table class="table table-striped">
            <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">fleets</th>
              <th scope="col">Action</th>

            </tr>
            </thead>
            <tbody>
                @foreach ($category as $categories)
                    <tr>
                        <th scope="row">{{$categories->id}}</th>
                        <td>{{$categories->flotte}}</td>
                        <td><a href="{{route('Admin.Entreprise.flote.car.listing.flote.listing', ['id' => $categories->id, 'category' => $categories->flotte])}}" class="btn btn-primary">See</a></td>
                    </tr>
                @endforeach


            </tbody>
          </table>
    </div>

@endsection
