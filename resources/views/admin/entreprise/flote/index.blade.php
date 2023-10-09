@extends('admin')

@section('title', 'Nos flote')

@section('content')

<div class="pagetitle">
    <a href="{{ route('Admin.Entreprise.flote.create') }}" class="btn btn-success" style="float: right">Add a Fleet</a>
    <h1>Fleet Management</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('Admin.index') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('Admin.Entreprise.flote.index') }}">Our Fleet</a></li>
        </ol>
    </nav>
</div>

<section class="section dashboard">
    @if(session('success'))
    <div class="alert alert-success" style="text-align: center">
        {{ session('success') }}
    </div>
    @endif
    @if(session('error'))
    <div class="alert alert-danger" style="text-align: center">
        {{ session('error') }}
    </div>
    @endif

    <div>
        <table class="table datatable">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($category as $categories)
                <tr>
                    <th scope="row">{{ $categories->id }}</th>
                    <td>{{ $categories->flotte }}</td>
                    <td>
                        <a href="{{ route('Admin.Entreprise.flote.edit', ['id' => $categories->id]) }}"
                            class="btn btn-primary">Edit</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <th scope="row"></th>
                    <td style="text-align: center">No fleets available at the moment</td>
                    <td></td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</section>


@endsection
