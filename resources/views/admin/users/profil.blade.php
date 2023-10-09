@extends('admin')

@section('title', 'Mon profile')

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

    <div class="card" style="padding: 20px">
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
                <h2>{{$user->name}}</h2>



        </div>


      <div class="row mb-3 text-center">
        <div class="col-md-6">
            <h4 style="color: blue">Role</h4>
            <h4 style="color: blue">Email</h4>
            <h4 style="color: blue">Registration date</h4>
        </div>
        <div class="col-md-6">
            @php
                $role = App\Models\Roles::findOrFail($user->role);
            @endphp
            <h4>{{$role->title}}</h4>
            <h4>{{$user->email}}</h4>
            @php
            $date = Carbon\Carbon::parse($user->created_at);
            $format = $date->format('D d M Y');
            @endphp
            <h4>{{$format}}</h4>
        </div>

    </div>
  </div>



@endsection
