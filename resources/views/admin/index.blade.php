@extends('admin')

@section('title', 'Dashboard')

@section('content')

<div class="pagetitle">
    <h1>Dashboard</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('Admin.index')}}">Dashboard</a></li>
        <li class="breadcrumb-item active">Home</li>
      </ol>
    </nav>
  </div>

  <!-- -->
  <section class="section dashboard">
    <div>

    </div>
  </section>

@endsection
