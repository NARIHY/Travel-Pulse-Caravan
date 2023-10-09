@extends('admin')
@php
    $title = "";
    if(request()->routeIS('Admin.Entreprise.flote.car.create')){
        $title = 'Ajout d\'une voiture';
    } else {
        $title = 'Edition d\'une voiture';
    }
@endphp
@section('title', $title)

@section('content')

<div class="pagetitle">
    <h1>Car management</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('Admin.index')}}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{route('Admin.Entreprise.flote.car.index')}}">Our cars</a></li>
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

<div class="container">
    @if (request()->routeIS('Admin.Entreprise.flote.car.create'))
        <form action="" method="post" enctype="multipart/form-data">
        @csrf
            <label for="model">Car model</label>
            <input type="text" name="model" id="model" class="form-control @error('model') is-invalid @enderror" value="{{ @old('model')}} ">
            @error('model')
                <p style="color:rgb(114, 19, 19)"> {{$message}} </p>
            @enderror


            <label for="brand">Car brand</label>
            <input type="text" name="brand" id="brand" class="form-control @error('brand') is-invalid @enderror" value="{{ @old('brand')}}">
            @error('brand')
                <p style="color:rgb(114, 19, 19)"> {{$message}} </p>
            @enderror

            <label for="plate_number">Numberplate</label>
            <input type="text" name="plate_number" id="plate_number" class="form-control @error('plate_number') is-invalid @enderror" value="{{ @old('plate_number')}}">
            @error('plate_number')
                <p style="color:rgb(114, 19, 19)"> {{$message}} </p>
            @enderror

            <label for="category">Our fleet</label>
            <select name="category" id="category" class="form-control @error('category') is-invalid @enderror">
                <option value="">Select the car fleet</option>
                    @foreach($category as $title => $id)
                        <option value="{{$title}}">{{$id}}</option>
                    @endforeach
            </select>
            @error('category')
                <p style="color: rgb(114, 19, 19)">{{$message}}</p>
            @enderror

            <label for="place">Number of car seats</label>
            <select name="place" id="place" class="form-control @error('place') is-invalid @enderror">
                <option value="">Select the number of seats in the car</option>
                @foreach ($place as $p)
                    <option value="{{$p}}">{{$p}}</option>
                @endforeach
            </select>
            @error('place')
            <p style="color: rgb(114, 19, 19)">{{$message}}</p>
            @enderror

            <label for="year">Year of release of the car</label>
            <select name="year" id="year" class="form-control @error('year') is-invalid @enderror">
                <option value="">Select the year the car was released</option>
                @php
                $date = date('Y');
                @endphp
                @for($i = $date; $i >= 2000; $i--)
                    <option value="{{$i}}">{{$i}}</option>
                @endfor
            </select>
            @error('year')
            <p style="color: rgb(114, 19, 19)">{{$message}}</p>
            @enderror

            <label for="vehicule_info">Vehicle condition</label>
            <select name="vehicule_info" id="vehicule_info" class="form-control @error('vehicule_info') is-invalid @enderror">
                <option value="">Select the car fleet</option>
                @foreach ($statement as $state)
                    <option value="{{$state}}">{{$state}}</option>
                @endforeach
            </select>
            @error('vehicule_info')
            <p style="color: rgb(114, 19, 19)">{{$message}}</p>
            @enderror

            <label for="media">Add a photo of the car</label>
            <input type="file" name="media" id="media" class="form-control @error('media') is-invalid @enderror">
            @error('media')
                <p style="color:rgb(114, 19, 19)"> {{$message}} </p>
            @enderror
            <div class="d-grid gap-2" style="margin-top: 20px">

                <button class="btn btn-primary" type="submit">Create</button>
            </div>


        </form>
    @else
    <form action="" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
            <label for="model">Car model</label>
            <input type="text" name="model" id="model" class="form-control @error('model') is-invalid @enderror" value="{{$car->model}} ">
            @error('model')
                <p style="color:rgb(114, 19, 19)"> {{$message}} </p>
            @enderror


            <label for="brand">Car brand</label>
            <input type="text" name="brand" id="brand" class="form-control @error('brand') is-invalid @enderror" value="{{ $car->brand}}">
            @error('brand')
                <p style="color:rgb(114, 19, 19)"> {{$message}} </p>
            @enderror

            <label for="plate_number">Numberplate</label>
            <input type="text" name="plate_number" id="plate_number" class="form-control @error('plate_number') is-invalid @enderror" value="{{$car->plate_number}}">
            @error('plate_number')
                <p style="color:rgb(114, 19, 19)"> {{$message}} </p>
            @enderror

            <label for="category">Our fleet</label>
            <select name="category" id="category" class="form-control @error('category') is-invalid @enderror">
                <option value="">Select the car fleet</option>
                    @foreach($category as $title => $id)
                        <option value="{{$title}}" @if($title == $car->category) selected @endif>{{$id}}</option>
                    @endforeach

            </select>
            @error('category')
                <p style="color: rgb(114, 19, 19)">{{$message}}</p>
            @enderror

            <label for="place">Number of car seats</label>
            <select name="place" id="place" class="form-control @error('place') is-invalid @enderror">
                <option value="">Select the number of seats the car has</option>
                @foreach ($place as $p)
                    <option value="{{$p}}" @if($car->place == $car->place) selected @endif>{{$p}}</option>
                @endforeach
            </select>
            @error('place')
            <p style="color: rgb(114, 19, 19)">{{$message}}</p>
            @enderror

            <label for="year">Year of release of the car</label>
            <select name="year" id="year" class="form-control @error('year') is-invalid @enderror">
                <option value="">Select the year the car was released</option>
                @php
                $date = date('Y');
                @endphp
                @for($i = $date; $i >= 2000; $i--)
                    <option value="{{$i}}" @if($i == $car->year) selected @endif>{{$i}}</option>

                @endfor

            </select>

            @error('year')
            <p style="color: rgb(114, 19, 19)">{{$message}}</p>
            @enderror

            <label for="vehicule_info">Vehicule condition</label>
            <select name="vehicule_info" id="vehicule_info" class="form-control @error('vehicule_info') is-invalid @enderror">
                <option value="">Select the car fleet</option>
                @foreach ($statement as $state)
                    <option value="{{$state}}" @if($car->vehicule_info == $state) selected @endif>{{$state}}</option>
                @endforeach
            </select>
            @error('vehicule_info')
            <p style="color: rgb(114, 19, 19)">{{$message}}</p>
            @enderror

            <div class="row mb-3">
                <div class="col-6">
                    <label for="media">Add a photo of the car</label>
                    <input type="file" name="media" id="media" class="form-control @error('media') is-invalid @enderror">
                    @error('media')
                        <p style="color:rgb(114, 19, 19)"> {{$message}} </p>
                    @enderror
                </div>
                <div class="col-6">
                    @foreach($mediaCollection as $media)

                    <img src="{{ $media->getUrl() }}" alt="{{$media->name}}" width="100%">

                    @endforeach
                </div>
            </div>


            <div class="d-grid gap-2" style="margin-top: 20px">

                <button class="btn btn-primary" type="submit">Update</button>
            </div>


        </form>

    @endif

</div>

@endsection
