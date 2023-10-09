@extends('admin')

@section('title', 'Liste de tous nos voiture pour la flote'. $flote->flotte)

@section('content')
<div class="container">
    <div class="pagetitle">
        <a href="{{ route('Admin.Entreprise.flote.create') }}" class="btn btn-success" style="float: right">Add a Fleet</a>
        <h1>Fleet Management</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('Admin.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('Admin.Entreprise.flote.index') }}">Our Fleet</a></li>
                <li class="breadcrumb-item">Listing of Our Cars in Particular</li>
            </ol>
        </nav>
    </div>
    <table class="table datatable">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Model</th>
                <th scope="col">Brand</th>
                <th scope="col">License Plate</th>
                <th scope="col">Year</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($car as $cars)
            <tr>
                <th scope="row"><a href="{{ route('Admin.Entreprise.flote.car.view', ['id' => $cars->id]) }}" style="text-decoration: none">{{ $cars->id }}</a></th>
                <td>{{ $cars->model }}</td>
                <td>{{ $cars->brand }}</td>
                <td>{{ $cars->plate_number }}</td>
                <td>{{ $cars->year }}</td>
                <td>
                    <a href="{{ route('Admin.Entreprise.flote.car.view', ['id' => $cars->id]) }}" class="btn btn-primary">View</a>
                </td>
            </tr>
            @empty
            <tr>
                <th scope="row"></th>
                <td></td>
                <td style="text-align: center">No cars available at the moment</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>


@endsection
