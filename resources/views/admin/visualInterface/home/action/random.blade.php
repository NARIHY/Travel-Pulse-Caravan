@extends('admin')
@php
    $title = "";
    if(request()->routeIS('Admin.Home.create')){
        $title = 'Création d\'une publication';
    } else {
        $title = 'Edition d\'une publication';
    }
@endphp
@section('title', $title)

@section('content')

<div class="pagetitle">
    <h1>Acceuil du site</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('Admin.index')}}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{route('Admin.Home.index')}}">Site home</a></li>
      </ol>
    </nav>
</div>

@if (session('error'))
    <div class="alert alert-danger">
        <p class="text-center">{{session('error')}}</p>
    </div>
@endif
@if (session('success'))
    <div class="alert alert-danger">
        <p class="text-center">{{session('success')}}</p>
    </div>
@endif

<div class="container">
    @if (request()->routeIS('Admin.Home.create'))

    <form action="" method="post" enctype="multipart/form-data">
        @csrf
        <label for="title">Title of publication</label>
        <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{@old('title')}}">
        @error('title')
            <p style="color:rgb(114, 19, 19)"> {{$message}} </p>
        @enderror



        <label for="media">Add new picture</label>
        <input type="file" name="media" id="video" class="form-control @error('media') is-invalid @enderror">
        @error('media')
            <p style="color:rgb(114, 19, 19)"> {{$message}} </p>
        @enderror

        <label for="content">Content of the publication</label>
        <textarea name="content" id="content" cols="30" rows="10" class="form-control @error('content') is-invalid @enderror">
            {{@old('content')}}
        </textarea>
        @error('content')
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
        <label for="title">Title of publication</label>
        <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{$home->title}}">
        @error('title')
            <p style="color:rgb(114, 19, 19)"> {{$message}} </p>
        @enderror

        <div class="row mb-3" style="margin-top: 20px">
            <div class="col-6">
                <label for="media">Adding new picture</label>
                <input type="file" name="media" id="media" class="form-control @error('media') is-invalid @enderror">
                @error('media')
                    <p style="color:rgb(114, 19, 19)"> {{$message}} </p>
                @enderror
            </div>
            <div class="col-6">
                @foreach($mediaCollection as $media)
                @if($media->mime_type === 'image/jpeg' || $media->mime_type === 'image/png')
                    <img src="{{ $media->getUrl() }}" alt="Media" width="100%">
                @elseif($media->mime_type === 'video/mp4')
                    <video controls>
                        <source src="{{ $media->getUrl() }}" type="video/mp4" width="50%">
                        Your browser does not support the video tag.
                    </video>
                @endif
            @endforeach

            </div>
        </div>







        <label for="content" style="margin-top: 20px">Content of publication</label>
        <textarea name="content" id="content" cols="30" rows="10" class="form-control @error('content') is-invalid @enderror">
            {{$home->content}}
        </textarea>
        @error('content')
        <p style="color:rgb(114, 19, 19)"> {{$message}} </p>
        @enderror

        <div class="d-grid gap-2" style="margin-top: 20px">
            <button class="btn btn-primary" type="submit">Modify</button>
        </div>
    </form>

    @endif
</div>

@endsection
