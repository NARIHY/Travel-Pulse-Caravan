@extends('admin')

@section('title', 'Tableau de bord')

@section('content')
   
<div class="pagetitle">
    <h1>Tableau de bord</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('Admin.index')}}">Tableau de bord</a></li>
        <li class="breadcrumb-item active">Acceuil</li>
      </ol>
    </nav>
  </div>

  <!-- -->
  <section class="section dashboard">
    <div>
        interieur
    </div>
  </section>

@endsection