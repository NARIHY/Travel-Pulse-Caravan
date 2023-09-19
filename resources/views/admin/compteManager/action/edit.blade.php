@extends('admin')

@section('title', 'Editer un compte en particulier')

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
        <li class="breadcrumb-item">Gestion des comptes</li>
        <li class="breadcrumb-item active">Edition d'un compte</li>
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
    <form action="" method="post">
        @csrf
        @method('PUT')
        <label for="name">Nom d'utilisateur</label>
        <input type="text" name="name" id="name" class="form-control" disabled value="{{$user->name}}">
        <label for="email">Addresse email</label>
        <input type="text" name="email" id="email" class="form-control" disabled value="{{$user->email}}">

        <label for="role">Role de l'utilisateur</label>
        <select name="role" id="role" class="form-control">
            <option value="">Choisir le rôle</option>
            @foreach ($role as $k=>$v)
            <option value="{{$v}}" @if ($user->role == $v) selected @endif> {{$k}}</option>
            @endforeach
        </select>
        <div class="d-grid gap-2" style="margin-top: 20px">
            <button class="btn btn-primary" type="submit"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Enregistrer</font></font></button>
        </div>
    </form>
  </div>
  @endif
@endsection
