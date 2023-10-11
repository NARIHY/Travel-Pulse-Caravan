@extends('admin')

@section('title', 'Editer un compte en particulier')

@section('content')
@php
$use = Auth::user();

@endphp
<div class="pagetitle">
    <h1>Account management</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item">Account management</li>
        <li class="breadcrumb-item active">Edition d'un compte</li>
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
    <form action="" method="post">
        @csrf
        @method('PUT')
        <label for="name">Username</label>
        <input type="text" name="name" id="name" class="form-control" disabled value="{{$user->name}}">
        <label for="email">E-mail address</label>
        <input type="text" name="email" id="email" class="form-control" disabled value="{{$user->email}}">

        <label for="role">User role</label>
        <select name="role" id="role" class="form-control">
            <option value="">Choose a role</option>
            @foreach ($role as $k=>$v)
            <option value="{{$v}}" @if ($user->role == $v) selected @endif> {{$k}}</option>
            @endforeach
        </select>
        <div class="d-grid gap-2" style="margin-top: 20px">
            <button class="btn btn-primary" type="submit"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Save</font></font></button>
        </div>
    </form>
  </div>

@endsection
