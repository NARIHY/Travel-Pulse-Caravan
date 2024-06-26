@extends('admin')

@section('title', $car->brand.' '.$car->model)

@section('content')
<div class="pagetitle">
    <a href="{{route('Admin.Entreprise.flote.car.generatePDF', ['id' => $car->id])}}" class="btn btn-success" style="float: right">Exporter <i class="ri-download-fill"></i></a>
    <h1>Car management</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('Admin.index')}}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{route('Admin.Entreprise.flote.car.index')}}">Our Cars</a></li>
        <li class="breadcrumb-item">{{$car->brand.' '.$car->model. ' '.$car->plate_number}}</li>
    </nav>
</div>



<div class="container">
    <div class="card" style="padding: 20px 20px 20px 20px">
       <div class="row mb-3">
            <div class="col-6">
                <h4 style="color:blue">Model:</h4>
            </div>
            <div class="col-6">
                <h4>{{$car->model}}</h4>
            </div>
       </div>
       <div class="row mb-3">
            <div class="col-6">
                <h4 style="color:blue">Brand:</h4>
            </div>
            <div class="col-6">
                <h4>{{$car->brand}}</h4>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-6">
                <h4 style="color:blue">Numberplate:s</h4>
            </div>
            <div class="col-6">
                <h4>{{$car->plate_number}}</h4>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-6">
                <h4 style="color:blue">Years of productions</h4>
            </div>
            <div class="col-6">
                <h4>{{$car->year}}</h4>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-6">
                <h4 style="color:blue">Number of place</h4>
            </div>
            <div class="col-6">
                <h4>{{$car->place}} places</h4>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-6">
                <h4 style="color:blue">Conditions</h4>
            </div>
            <div class="col-6">
                <h4>{{$car->vehicule_info}}</h4>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-6">
                <h4 style="color:blue">Fleet</h4>
            </div>
            @php
            $flote = App\Models\Category::where('id', $car->category)
                                    ->value('flotte');
            @endphp
            <div class="col-6">
                <h4>{{$flote}}</h4>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-6">
                <h4 style="color:blue; margin-top:50%">Car picture</h4>
            </div>
            <div class="col-6">
                @foreach($mediaCollection as $media)

                <img src="{{ $media->getUrl() }}" alt="{{$media->name}}" width="100%">

                @endforeach
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-6">
                <h4 style="color:blue">Qrcode</h4>
            </div>
            <div class="col-6">
                {{$qrCode}}

            </div>
        </div>
    </div>

</div>
@endsection
