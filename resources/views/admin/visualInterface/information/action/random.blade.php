@extends('admin')
@php
    $title = "";
    if(request()->routeIS('Admin.Information.create')){
        $title = 'Ajout d\'une information';
    } else {
        $title = 'Edition d\'une information';
    }
@endphp
@section('title', $title)

@section('content')
<div class="pagetitle">
    <h1>Interface visuelle</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('Admin.index')}}">Tableau de bord</a></li>
        <li class="breadcrumb-item">Nos informations</li>
        <li class="breadcrumb-item">ajout d'une information</li>
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
    @if (request()->routeIS('Admin.Information.create'))
        <form action="" method="post" enctype="multipart/form-data">
            @csrf
            <label for="title">Selectionner une titre</label>
            <select name="title" id="title" class="form-control @error('title') is-invalid @enderror">
                <option value="">Selectionner une titre</option>

                @foreach ($category as $k=>$v)
                    <option value="{{$v}}">{{$k}}</option>
                @endforeach
            </select>
            @error('title')
            <div class="invalid-feedback">{{$message}}</div>
            @enderror
            <label for="content">Description</label>
            <textarea name="content" id="content"  class="form-control @error('content') is-invalid @enderror">{{@old('content')}}</textarea>
            @error('content')
            <div class="invalid-feedback">{{$message}}</div>
            @enderror
            <label for="media">Inserer une video ou une photo</label>
            <input type="file" name="media" id="media" class="form-control @error('media') is-invalid @enderror">

            <div class="d-grid gap-2" style="margin-top: 20px">
                <button class="btn btn-primary" type="submit">Enregistrer</button>
            </div>
        </form>
    @else
    <form action="" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <label for="title">Selectionner une titre</label>
        <select name="title" id="title" class="form-control @error('title') is-invalid @enderror">
            <option value="">Selectionner une titre</option>

            @foreach ($category as $k=>$v)
                <option value="{{$v}}" @if ($information->title == $v) selected  @endif>{{$k}}</option>
            @endforeach
        </select>
        @error('title')
        <div class="invalid-feedback">{{$message}}</div>
        @enderror
        <label for="content">Description</label>
        <textarea name="content" id="content"  class="form-control @error('content') is-invalid @enderror">{{$information->content}}</textarea>
        @error('content')
        <div class="invalid-feedback">{{$message}}</div>
        @enderror
        <div class="row mb-3" style="margin-top: 20px">
            <div class="col-6">
                <label for="media">Inserer une video ou une photo</label>
                <input type="file" name="media" id="media" class="form-control @error('media') is-invalid @enderror">
                @error('media')
                    <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>
            <div class="col-6">

                @if($medias === 'image/jpeg' || $medias === 'image/png')
                    <img src="{{ $media->getUrl() }}" alt="Media" width="100%">
                @elseif($medias === 'video/mp4')
                    <video controls>
                        <source src="{{ $media->getUrl() }}" type="video/mp4" width="50%">

                    </video>
                @endif


            </div>
        </div>



        <div class="d-grid gap-2" style="margin-top: 20px">
            <button class="btn btn-primary" type="submit">Sauvgarder les modifications</button>
        </div>
    </form>
    @endif
</div>
@endsection
