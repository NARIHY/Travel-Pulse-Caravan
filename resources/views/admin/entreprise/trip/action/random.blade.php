@extends('admin')
@php
    $title = "";
    if(request()->routeIS('Admin.Entreprise.trip.planified.create')){
        $title = 'Planification d\'un trajet';
    } else {
        $title = 'Modification d\'un trajet planifier';
    }
@endphp
@section('title', $title)

@section('content')

<div class="pagetitle">
    <h1>Journey management</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('Admin.index')}}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{route('Admin.Entreprise.trip.planified.index')}}">Nos trajets</a></li>
        <li class="breadcrumb-item">journey management</li>
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

<div class="container">
    @if(request()->routeIS('Admin.Entreprise.trip.planified.create'))
        <form action="" method="post">

            @csrf
            <label for="car">Select a car</label>
            <select name="car" id="car" class="form-control @error('car') is-invalid @enderror">
                <option value="">Select a car</option>
                @foreach ($car as $k=>$v)
                    <option value="{{$v}}">{{$k}}</option>
                @endforeach
            </select>
            @error('car')
            <p style="color: rgb(114, 19, 19)">{{$message}}</p>
            @enderror

            <div class="row mb-3">
                <div class="col-6">
                    <label for="place_depart">Place of departure</label>
                    <select name="place_depart" id="place_depart" class="form-control @error('place_depart') is-invalid @enderror">
                        <option value="">Select departure location</option>
                        @foreach ($city as $cities)
                            <option value="{{$cities}}">{{$cities}}</option>
                        @endforeach
                    </select>
                    @error('place_depart')
                    <p style="color: rgb(114, 19, 19)">{{$message}}</p>
                    @enderror
                </div>
                <div class="col-6">
                    <label for="place_arrivals">Arrival location</label>
                    <select name="place_arrivals" id="place_arrivals" class="form-control @error('place_arrivals') is-invalid @enderror">
                        <option value="">Select the location of arrival</option>
                        @foreach ($city as $cities)
                            <option value="{{$cities}}">{{$cities}}</option>
                        @endforeach
                    </select>
                    @error('place_arrivals')
                    <p style="color: rgb(114, 19, 19)">{{$message}}</p>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-6">
                    <label for="date_depart">Date of departure</label>
                    <input type="date" name="date_depart" id="date_depart" class="form-control @error('date_depart') is-invalid @enderror">
                    @error('date_depart')
                    <p style="color: rgb(114, 19, 19)">{{$message}}</p>
                    @enderror
                </div>
                <div class="col-6">
                    <label for="heure_depart">departure time</label>
                    <input type="time" name="heure_depart" id="date_depart" class="form-control @error('heure_depart') is-invalid @enderror">
                    @error('heure_depart')
                    <p style="color: rgb(114, 19, 19)">{{$message}}</p>
                    @enderror
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-6">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control @error('status') is-invalid @enderror">
                        <option value="">Select status</option>
                        @foreach ($statement as $statues)
                            <option value="{{$statues}}">{{$statues}}</option>
                        @endforeach
                    </select>
                    @error('status')
                    <p style="color: rgb(114, 19, 19)">{{$message}}</p>
                    @enderror
                </div>
                <div class="col-6">
                    <label for="price">Price</label>
                    <div class="input-group mb-3">

                        <span class="input-group-text" id="basic-addon3">Ar</span>
                        <input type="text" name="price" id="price" class="form-control @error('price') is-invalid @enderror" value="{{@old('price')}}">
                        @error('price')
                        <p style="color: rgb(114, 19, 19)">{{$message}}</p>
                        @enderror
                    </div>
                </div>
            </div>



                    <div class="d-grid gap-2" style="margin-top: 20px">

                        <button class="btn btn-primary" type="submit">Save</button>
                    </div>
        </form>
    @else
    <form action="" method="post">
        @csrf
        @method('PUT')
        <label for="car"> Select a car</label>
        <select name="car" id="car" class="form-control @error('car') is-invalid @enderror">
            <option value="">Select a car</option>
            @foreach ($car as $k=>$v)
                <option value="{{$v}}" @if ($v == $trip->car) selected @endif>{{$k}}</option>
            @endforeach

        </select>
        @error('car')
        <p style="color: rgb(114, 19, 19)">{{$message}}</p>
        @enderror

        <div class="row mb-3">
            <div class="col-6">
                <label for="place_depart">Place of departure</label>
                <select name="place_depart" id="place_depart" class="form-control @error('place_depart') is-invalid @enderror">
                    <option value="">Select departure location</option>
                    @foreach ($city as $cities)
                        <option value="{{$cities}}" @if($cities === $trip->place_depart) selected @endif>{{$cities}}</option>
                    @endforeach
                </select>
                @error('place_depart')
                <p style="color: rgb(114, 19, 19)">{{$message}}</p>
                @enderror
            </div>
            <div class="col-6">
                <label for="place_arrivals">Arrival location</label>
                <select name="place_arrivals" id="place_arrivals" class="form-control @error('place_arrivals') is-invalid @enderror">
                    <option value="">Select the location of arrival</option>
                    @foreach ($city as $cities)
                        <option value="{{$cities}}" @if($cities === $trip->place_arrivals) selected @endif>{{$cities}}</option>
                    @endforeach
                </select>
                @error('place_arrivals')
                <p style="color: rgb(114, 19, 19)">{{$message}}</p>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            @php
               $time = Carbon\Carbon::parse($trip->heure_depart)->format('H:m');
            @endphp
            <div class="col-6">
                <label for="date_depart">Date of departure</label>
                <input type="date" name="date_depart" id="date_depart" class="form-control @error('date_depart') is-invalid @enderror" value="{{$trip->date_depart}}">
                @error('date_depart')
                <p style="color: rgb(114, 19, 19)">{{$message}}</p>
                @enderror
            </div>
            <div class="col-6">
                <label for="heure_depart">departure time</label>
                <input type="time" name="heure_depart" id="date_depart" class="form-control @error('heure_depart') is-invalid @enderror" value="{{$time}}">
                @error('heure_depart')
                <p style="color: rgb(114, 19, 19)">{{$message}}</p>
                @enderror
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-6">
                <label for="status">Status</label>
                <select name="status" id="status" class="form-control @error('status') is-invalid @enderror">
                    <option value="">Select status</option>
                    @foreach ($statement as $statues)
                        <option value="{{$statues}}"  @if($statues === $trip->status) selected @endif>{{$statues}}</option>
                    @endforeach
                </select>
                @error('status')
                <p style="color: rgb(114, 19, 19)">{{$message}}</p>
                @enderror
            </div>
            <div class="col-6">
                <label for="price">Price</label>

                <div class="input-group mb-3">

                    <span class="input-group-text" id="basic-addon3">Ar</span>
                    <input type="text" name="price" id="price" class="form-control @error('price') is-invalid @enderror" value="{{$trip->price}}">
                    @error('price')
                    <p style="color: rgb(114, 19, 19)">{{$message}}</p>
                    @enderror
                </div>
            </div>
        </div>



                <div class="d-grid gap-2" style="margin-top: 20px">

                    <button class="btn btn-success" type="submit">Save</button>
                </div>
    </form>
    @endif
</div>
@endsection
