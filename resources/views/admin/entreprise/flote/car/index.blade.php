@extends('admin')

@section('title', 'Nos voiture')

@section('content')

<div class="pagetitle">
    <a href="{{route('Admin.Entreprise.flote.car.create')}}" class="btn btn-success" style="float: right">Add new car</a>
    <h1>Fleet management</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('Admin.index')}}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{route('Admin.Entreprise.flote.index')}}">Our cars</a></li>
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
                <th scope="col">Model</th>
                <th scope="col">Brand</th>
                <th scope="col">Numberplate</th>
                <th scope="col">Fleets</th>
                <th scope="col">Years of production</th>
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
                        @php

                          $category = App\Models\Category::where('id', $cars->category)
                                                          ->value('flotte');
                        @endphp
                        <td>{{$category}}</td>
                        <td>{{$cars->year}}</td>
                        <td>

                            <div class="row mb-3">
                              <div class="col-6">
                                <a href="{{route('Admin.Entreprise.flote.car.edit', ['id'=> $cars->id])}}" class="btn btn-primary">Modify</a>
                              </div>
                              <div class="col-6">
                                  <form action="{{route('Admin.Entreprise.flote.car.delete', ['id' => $cars->id])}}" method="post">
                                      @csrf
                                      @method('DELETE')
                                      <input type="submit" class="btn btn-danger" value="Delete">
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
                        <td style="text-align: center">Empty</td>
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
