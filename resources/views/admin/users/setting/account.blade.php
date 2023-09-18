@extends('admin')
@section('title', 'Mon espace')

@section('content')
<div class="pagetitle">
    <h1>Mon espace personnelle</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('Admin.index')}}">Tableau de bord</a></li>
        <li class="breadcrumb-item">Mon profile</li>
      </ol>
    </nav>
  </div>

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
    <form action="" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card" style="padding: 20px">
            <label for="name">Nom d'utilisateur</label>
            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{$user->name}}">
            @error('name')
                <p style="color: red">{{$message}}</p>
            @enderror
            <label for="email">Addresse email</label>
            <input type="text" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{$user->email}}">
            @error('email')
                <p style="color: red">{{$message}}</p>
            @enderror
            <div class="row mb-3" style="margin-top: 20px; margin-bottom:20px">
                    <div class="col-md-6">
                        <input type="file" name="picture" id="picture" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                            @if (empty($user->picture))
                            <div class="circle-container">
                                <img src="{{asset('admin/users-default/default.png')}}" alt="Profile" class="rounded-circle">
                            </div>
                            @else

                            <div class="circle-container">
                                <img src="/storage/{{$user->picture}}" alt="Profile" class="rounded-circle" width="250px">
                            </div>
                            @endif
                        </div>

                </div>
            </div>
            <div>
                <input type="submit" value="Enregistrer" class="btn btn-primary">
            </div>
        </div>
    </form>
  </div>
@endsection
