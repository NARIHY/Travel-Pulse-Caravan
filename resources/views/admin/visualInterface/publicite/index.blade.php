@extends('admin')

@section('title', 'Liste de nos départ et destination')

@section('content')
<div class="pagetitle">
    <a href="{{route('Admin.Publicite.create')}}" class="btn btn-success" style="float: right">Add new publicity</a>
    <h1>Visual interface</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('Admin.index')}}">Dashboard</a></li>
        <li class="breadcrumb-item">Our Publicity</li>
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
        <th scope="col">Title</th>
        <th scope="col">Action</th>

      </tr>
    </thead>

    <tbody>
        @forelse ($publicity as $publicities)
            <tr>
                <th scope="row">{{$publicities->id}}</th>


                <td ><p style="color: blue">{{$publicities->title}}</p></td>




                <td>
                    <div class="row mb-3">
                      <div class="col-6">
                        <a href="{{route('Admin.Publicite.edit',['id' => $publicities->id])}}" class="btn btn-primary"><i class="bi bi-pencil"></i></a>
                      </div>
                      <div class="col-6">
                        <form action="{{route('Admin.Publicite.delete', ['id' => $publicities->id])}}" method="post">
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

                <td style="text-align: center">No advertising available at the moment</td>


                <td>

                </td>
            </tr>
        @endforelse

    </tbody>
  </table>
@endsection
