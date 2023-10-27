@extends('admin')

@section('title', 'Liste de tous nos  newsletter pas poster')

@section('content')

  <div class="pagetitle">
    <a href="{{route('Admin.Newsletter.create')}}" class="btn btn-success" style="float: right">Add a newsletter</a>
    <h1>NewsLetter</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="">Newsletter management</a></li>
    </nav>
</div>

  <div class="container">

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
    <table class="table table-borderless datatable">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">Action</th>

          </tr>
        </thead>


    <tbody>
        @forelse ($newsletter as $c)
        <tr>
          <th scope="row">{{$c->id}}</th>
          <td>{{$c->title}}</td>

          <td>
            <div class="row mb-3">
                <div class="col-6">

                    <form action="{{route('Admin.Newsletter.send', ['id' => $c->id])}}" method="post">
                    @csrf
                    <input type="submit" class="btn btn-secondary" value="Posts">
                    </form>
                </div>
                <div class="col-6">
                    <a href="{{route('Admin.Newsletter.edit', ['id' => $c->id])}}" class="btn btn-primary"> Edit</a>

                </div>
            </div>

          </td>
        </tr>

    @empty

        <tr>
            <th scope="row"></th>
            <td>No newsletter at the moment</td>
            <td></td>
        </tr>

    @endforelse
</tbody>
    </table>
  </div>
@endsection
