@extends('admin')
@php
    $title = "";
    if(request()->routeIS('Admin.Publicite.create')){
        $title = 'Ajout d\'une nouvelle publicitée';
    } else {
        $title = 'Edition d\'une publicitée';
    }
@endphp
@section('title', $title)

@section('content')
<div class="pagetitle">
    <h1>Visual interface</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('Admin.index')}}">Dashboard</a></li>
        <li class="breadcrumb-item">Nos informations</li>
        <li class="breadcrumb-item">publicité</li>
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
    @if (request()->routeIS('Admin.Publicite.create'))

    <form action="" method="post" enctype="multipart/form-data">
        @csrf
        <label for="title">Titre du publication</label>
        <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{@old('title')}}">
        @error('title')
            <p style="color:rgb(114, 19, 19)"> {{$message}} </p>
        @enderror



        <label for="media">Ajouter une video ou une photo</label>
        <input type="file" name="media[]" id="media" class="form-control @error('media') is-invalid @enderror" multiple>
        @error('media')
            <p style="color:rgb(114, 19, 19)"> {{$message}} </p>
        @enderror

        <label for="content">Contenu de la publication</label>
        <textarea name="content" id="content" cols="30" rows="10" class="form-control @error('content') is-invalid @enderror">
            {{@old('content')}}
        </textarea>
        @error('content')
        <p style="color:rgb(114, 19, 19)"> {{$message}} </p>
        @enderror

        <div class="d-grid gap-2" style="margin-top: 20px">

            <button class="btn btn-primary" type="submit">Créer</button>
        </div>
    </form>
    @else

    <form action="" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <label for="title">Titre du publication</label>
        <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{$home->title}}">
        @error('title')
            <p style="color:rgb(114, 19, 19)"> {{$message}} </p>
        @enderror

        <div class="row mb-3" style="margin-top: 20px">
            <div class="col-6">
                <label for="media" >Ajouter une video ou une photo</label>
                <input type="file" name="media[]" id="media" class="form-control @error('media') is-invalid @enderror" multiple>
                @error('media')
                    <p style="color:rgb(114, 19, 19)"> {{$message}} </p>
                @enderror
            </div>
            <div class="col-6">
                @php
                    //count element
                    $count = $mediaCollection->count();
                    //We were going to count element
                    if ($count == 1) {
                        $first = $mediaCollection->get(0);
                        $type = $mediaCollection->get(0)
                                                ->value('mime_type');
                        $f = $first->getUrl();
                    } else if ($count == 2) {
                        //get the second picture
                        $first = $mediaCollection->get(0);
                        $f = $first->getUrl();
                        $second = $mediaCollection->get(1);
                        $s = $second->getUrl();
                    } else if ($count == 3) {
                        //get the second picture

                        $first = $mediaCollection->get(0);
                        $f = $first->getUrl();
                        $second = $mediaCollection->get(1);
                        $s = $second->getUrl();
                        //get the third picture
                        $third = $mediaCollection->get(2);
                        $t = $third->getUrl();
                    } else {
                        return null;
                    }



                @endphp





                        @if ($count < 2)
                            @if ($type == 'image/jpeg' || $type == 'image/jpg' || $type = 'image/png')
                            <img src="{{$f}}" class="d-block w-100" alt="...">
                            @else
                            <video controls>
                                <source src="{{$f}}" type="video/mp4" width="100%">
                           </video>
                            @endif

                        @elseif($count >= 2 && $count < 3)

                        <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
                            <div class="carousel-inner">
                              <div class="carousel-item active">
                                <img src="{{$f}}" class="d-block w-100" alt="..." height="350px">
                              </div>
                              <div class="carousel-item">
                                <img src="{{$s}}" class="d-block w-100" alt="..." height="350px">
                              </div>

                            </div>

                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
                              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                              <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
                              <span class="carousel-control-next-icon" aria-hidden="true"></span>
                              <span class="visually-hidden">Next</span>
                            </button>

                          </div><!-- End Slides with fade transition -->

                        </div>
                        @else
                        <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
                            <div class="carousel-inner">
                              <div class="carousel-item active">
                                <img src="{{$f}}" class="d-block w-100" alt="..." height="350px">
                              </div>
                              <div class="carousel-item">
                                <img src="{{$s}}" class="d-block w-100" alt="..." height="350px">
                              </div>
                              <div class="carousel-item">
                                <img src="{{$t}}" class="d-block w-100" alt="..." height="350px">
                              </div>
                            </div>

                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
                              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                              <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
                              <span class="carousel-control-next-icon" aria-hidden="true"></span>
                              <span class="visually-hidden">Next</span>
                            </button>

                          </div><!-- End Slides with fade transition -->

                        </div>
                        @endif


            </div>
        </div>
        <label for="content" style="margin-top: 20px">Contenu de la publication</label>
                        <textarea name="content" id="content" cols="30" rows="10" class="form-control @error('content') is-invalid @enderror">
                            {{$home->content}}
                        </textarea>
                        @error('content')
                        <p style="color:rgb(114, 19, 19)"> {{$message}} </p>
                        @enderror
                        <div class="d-grid gap-2" style="margin-top: 20px">
                            <button class="btn btn-primary" type="submit">Modifier</button>
                        </div>
    </form>

    @endif
</div>
@endsection
