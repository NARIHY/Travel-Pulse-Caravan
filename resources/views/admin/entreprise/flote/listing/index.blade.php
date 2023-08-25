@extends('admin')

@section('title', 'Liste de tous nos flote')

@section('content')
    <div class="container">
        @if(session('error'))
      <div class="alert alert-danger" style="text-align: center">
        {{session('error')}}
      </div>
    @endif
        <table class="table table-striped">
            <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">flote</th>
              <th scope="col">Action</th>
              
            </tr>
            </thead>
            <tbody>
                @foreach ($category as $categories)
                    <tr>
                        <th scope="row">{{$categories->id}}</th>
                        <td>{{$categories->flotte}}</td>
                        <td><a href="{{route('Admin.Entreprise.flote.car.listing.flote.listing', ['id' => $categories->id, 'category' => $categories->flotte])}}" class="btn btn-primary">Voir</a></td>
                    </tr>
                @endforeach
           
            
            </tbody>
          </table>
    </div>

@endsection