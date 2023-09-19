@extends('admin')

@section('title', 'Liste de tous les comptes dans notre application')

@section('content')
@php
$use = Auth::user();
$roli = new Nari\Role($use);
$roles = $roli->roles();
@endphp
<div class="pagetitle">
    <h1>Gestion des comptes</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active">Gestion des comptes</li>
      </ol>
    </nav>
  </div>
  @if ($roles === true)
  <iframe src="{{route('Admin.Compte.forbiden')}}" frameborder="0" style="margin: 0; width:100%; height:70vh"></iframe>
  @else
  <div class="container">
    @if(session('success'))
    <div class="text-center" style="color: green">
        {{session('success')}}
    </div>
    @endif
    @if(session('error'))
    <div class="text-center" style="color: rgb(255, 0, 0)">
        {{session('error')}}
    </div>
    @endif
    <table class="table table-borderless datatable">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Nom d'utilisateur</th>
            <th scope="col">Addresse email</th>
            <th scope="col">date de création</th>
            <th scope="col">Role</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
    @forelse ($user as $users)

        <tr>
          <th scope="row">{{$users->id}}</th>
          <td>{{$users->name}}</td>
          <td>{{$users->email}}</td>
          @php
          $date = Carbon\Carbon::parse($users->created_at);
          $format = $date->format('D d M Y');
          @endphp
          <td>{{$format}}</td>
          @php
            $roles = App\Models\Roles::findOrFail($users->role);
          @endphp
          <td >
            <p style="color: blue">{{$roles->title}}</p>

          </td>

          <td>
            <div class="row mb-3">
                <div class="col-md-6">
                    <a href="{{route('Admin.Compte.edit', ['id' => $users->id])}}" class="btn btn-primary">Editer</a>
                </div>
                <div class="col-md-6">
                    <form action="{{route('Admin.Compte.deleteUser',['id' => $users->id])}}" method="post">
                        @csrf
                        @method('DELETE')
                        <input type="submit" value="Suprimer" class="btn btn-danger">
                    </form>
                </div>
            </div>


          </td>
        </tr>
    @empty
        <tr>
            <th scope="row"></th>
            <td></td>
            <td>Aucun compte inscrit pour le moment</td>
            <td></td>
            <td></td>
        </tr>

    @endforelse
</tbody>
    </table>
  </div>
  @endif


@endsection
