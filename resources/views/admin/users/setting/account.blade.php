@extends('admin')
@section('title', 'Mon espace')

@section('content')
<div class="pagetitle">
    <h1>My personal space</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('Admin.index')}}">Dashboard</a></li>
        <li class="breadcrumb-item">My profile</li>
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






        <div class="card" style="padding: 20px">
            <label for="name">Username</label>
            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{$user->name}}" disabled>
            @error('name')
                <p style="color: red">{{$message}}</p>
            @enderror
            <label for="email">Email address</label>
            <input type="text" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{$user->email}}" disabled>
            @error('email')
                <p style="color: red">{{$message}}</p>
            @enderror
            <!--
            <div class="row mb-3" style="margin-top: 20px; margin-bottom:20px">
                    <div class="col-md-6">
                        <input type="file" name="picture" id="picture" class="form-control" disabled>
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
        -->
            <div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="exampleModalToggleLabel">{{$user->name}}</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('Admin.Utilisateur.update')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <label for="name">Username</label>
                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{$user->name}}"/>

                            <label for="email">Email address</label>
                            <input type="text" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{$user->email}}"/>
                            <!--
                                for prenium
                            <label for="picture">Photo de profil</label>
                            <input type="file" name="picture" id="picture" class="form-control"/>
                        -->
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" class="form-control"/>

                            <input type="submit" class="btn btn-primary" style="width: 100%; margin-top: 15px" value="Sauvgarder"/>
                        </form>
                    </div>
                    <div class="modal-footer">
                      <p>Travel Pulse Carvan</p>
                    </div>
                  </div>
                </div>
              </div>
              <a class="btn btn-primary" data-bs-toggle="modal" href="#exampleModalToggle" role="button" style="margin-top: 20px">Update</a>
        </div>





@endsection
