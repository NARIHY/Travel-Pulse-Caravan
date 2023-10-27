@extends('admin')
@php
    $title = "";
    if(request()->routeIS('Admin.Newsletter.create')){
        $title = 'Ajout \'un nouvelle newsletter';
    } else {
        $title = 'Edition \'un newsletter';
    }
@endphp
@section('title', $title)

@section('content')

<div class="pagetitle">
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
    @if (request()->routeIS('Admin.Newsletter.create'))
        <form action="" method="post">
            @csrf
            <label for="title">Title (*)</label>
            <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{@old('title')}}">
            @error('title')
                <p style="color: red">{{$message}}</p>
            @enderror
            <label for="content">Content of the letter (*)</label>
            <textarea name="content" id="content" cols="30" rows="10" class="form-control @error('content') is-invalid @enderror">
            {{@old('content')}}
            </textarea>
            @error('content')
                <p style="color: red">{{$message}}</p>
            @enderror
            <div class="d-grid gap-2" style="margin-top: 10px">

                <button class="btn btn-primary" type="submit"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Save</font></font></button>
              </div>
        </form>
    @else
    <form action="" method="post">
        @csrf
        @method('PUT')
        <label for="title">Title (*)</label>
        <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{$newsletter->title}}">
        @error('title')
            <p style="color: red">{{$message}}</p>
        @enderror
        <label for="content">Content of the letter (*)</label>
        <textarea name="content" id="content" cols="30" rows="10" class="form-control @error('content') is-invalid @enderror">
        {{$newsletter->content}}
        </textarea>
        @error('content')
            <p style="color: red">{{$message}}</p>
        @enderror
        <div class="d-grid gap-2" style="margin-top: 10px">

            <button class="btn btn-primary" type="submit"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Save</font></font></button>
          </div>
    </form>
    @endif
</div>
@endsection
