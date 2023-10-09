@extends('admin')

@section('title', 'Liste de tous nos flote')

@section('content')
    <div class="container">

      <div class="pagetitle">
        <a href="{{route('Admin.Entreprise.flote.car.carInformation.create')}}" class="btn btn-success" style="float: right">Ajouter une information a une voiture</a>
        <h1>Fleet management</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('Admin.index')}}">Dashboard</a></li>
            <li class="breadcrumb-item">Advanced information on our car</li>

          </ol>
        </nav>
      </div>
        @if(session('error'))
            <div class="alert alert-danger" style="text-align: center">
                {{session('error')}}
            </div>
        @endif
        @if(session('success'))
            <div class="alert alert-success" style="text-align: center">
                {{session('success')}}
            </div>
        @endif

        <table class="table datatable">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Car</th>
                <th scope="col">mileage</th>
                <th scope="col">Max fuel</th>
                <th scope="col">Min weight</th>
                <th scope="col">Max weight</th>
                <th scope="col">Action</th>

              </tr>
            </thead>
            <tbody>
                @forelse ($carInformation as $cars)
                    <tr>
                        <th scope="row">{{$cars->id}}</th>
                        @php

                          $category = App\Models\Car::where('id', $cars->car)
                                                          ->value('plate_number');
                        @endphp
                        <td><a href="{{route('Admin.Entreprise.flote.car.view', ['id' => $cars->car])}}">{{$category}}</a></td>
                        <td>{{number_format($cars->kilometers, thousands_separator: ' ')}}</td>
                        <td>{{$cars->max_fuel}} l</td>
                        <td>{{number_format($cars->min_weight, thousands_separator: ' ')}} Kg</td>
                        <td>{{number_format($cars->max_weight, thousands_separator: ' ')}} Kg</td>



                        <td>

                            <a href="" class="btn btn-primary">Modifier</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <th scope="row"></th>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td style="text-align: center">No car information for the moments</td>
                        <td></td>
                        <td></td>

                        <td>

                        </td>
                    </tr>
                @endforelse

            </tbody>
          </table>

@endsection
