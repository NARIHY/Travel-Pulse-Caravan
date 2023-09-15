@extends('admin')

@section('title', 'Message reçu')

@section('content')
<div class="pagetitle">
    <h1>Message reçu</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active">Message reçu</li>
      </ol>
    </nav>
  </div>
  <div class="container">
    <table class="table table-borderless datatable">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Nom</th>
            <th scope="col">Prénon</th>
            <th scope="col">Sujet de conversation</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
    @forelse ($contact as $contacts)

        <tr>
          <th scope="row">{{$contacts->id}}</th>
          <td>{{$contacts->name}}</td>
          <td>{{$contacts->last_name}}</td>

          <td>{{$contacts->subject}}</td>

          <td>
            <a href="{{route('Admin.Contact.view', ['id' => $contacts->id])}}" class="btn btn-primary">Voir</a>

          </td>
        </tr>
    @empty
        <tr>
            <th scope="row"></th>
            <td></td>
            <td>Vide pour le moment</td>
            <td></td>
            <td></td>
        </tr>

    @endforelse
</tbody>
    </table>
  </div>

@endsection
