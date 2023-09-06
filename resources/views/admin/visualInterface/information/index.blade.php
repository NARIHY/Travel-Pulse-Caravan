@extends('admin')

@section('title', 'Liste de nos départ et destination')

@section('content')
<div class="pagetitle">
    <a href="{{route('Admin.Information.create')}}" class="btn btn-success" style="float: right">Ajouter une information</a>
    <h1>Interface visuelle</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('Admin.index')}}">Tableau de bord</a></li>
        <li class="breadcrumb-item">Nos informations</li>
      </ol>
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

  <table class="table datatable">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Titre</th>
        <th scope="col">Action</th>

      </tr>
    </thead>

    <tbody>
        @forelse ($information as $informations)
            <tr>
                <th scope="row">{{$informations->id}}</th>
                @php
                $cat = App\Models\Category::findOrFail($informations->title);
                @endphp

                <td ><p style="color: blue">{{$cat->flotte}}</p></td>




                <td>
                    <div class="row mb-3">
                      <div class="col-6">
                        <a href="{{route('Admin.Information.edit',['id' => $informations->id])}}" class="btn btn-primary"><i class="bi bi-pencil"></i></a>
                      </div>
                      <div class="col-6">
                        <form action="{{route('Admin.Information.delete', ['id' => $informations->id])}}" method="post">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-danger"><i class="bi bi-trash"></i></button>

                        </form>
                      </div>
                    </div>

                </td>
            </tr>
        @empty
            <tr>
                <th scope="row"></th>

                <td style="text-align: center">Aucune information displonible pour le moment</td>


                <td>

                </td>
            </tr>
        @endforelse

    </tbody>
  </table>
@endsection
