@extends('public')

@section('title', 'Our prestation')

@section('content')
<section id="about" class="about" style="margin-top: 30px">
    <div class="container">
        @foreach ($lite as $lites)
            <div class="row" style="margin-bottom: 20px">
                <div class="col-lg-6">
                    @php
                        $cat = App\Models\Category::findOrFail($lites->title);
                    @endphp
                    <h3>{{$cat->flotte}}</h3>
                    <p style="text-align: justify">
                        {{$lites->content}}
                    </p>

                </div>
                <div class="col-lg-6 pt-4 pt-lg-0">
                    @php
                    $mediaCollection = Spatie\MediaLibrary\MediaCollections\Models\Media::where('collection_name', 'information_home')
                                        ->where('model_type', App\Models\Information::class)
                                        ->where('model_id', $lites->id)
                                        ->orderBy('created_at','desc')
                                        ->limit(1)
                                        ->get();
                    @endphp
                    @foreach ($mediaCollection as $media)
                        <img src="{{$media->getUrl()}}" class="img-fluid" alt="{{$lites->title}}" width="100%">
                    @endforeach


                </div>
            </div>
        @endforeach
        @foreach ($prenium as $preniums)
        <div class="row" style="margin-bottom: 20px">
            <div class="col-lg-6">
                @php
                $mediaCollection = Spatie\MediaLibrary\MediaCollections\Models\Media::where('collection_name', 'information_home')
                                    ->where('model_type', App\Models\Information::class)
                                    ->where('model_id', $preniums->id)
                                    ->orderBy('created_at','desc')
                                    ->limit(1)
                                    ->get();
                @endphp
                @foreach ($mediaCollection as $media)
                    <img src="{{$media->getUrl()}}" class="img-fluid" alt="{{$preniums->title}}" width="100%">
                @endforeach

            </div>
            <div class="col-lg-6 pt-4 pt-lg-0">
                @php
                    $cat = App\Models\Category::findOrFail($preniums->title);
                @endphp
            <h3>{{$cat->flotte}}</h3>
            <p style="text-align: justify">
                {{$preniums->content}}
            </p>

            </div>
        </div>
    @endforeach

    @foreach ($vip as $vips)
        <div class="row" style="margin-bottom: 20px">
            <div class="col-lg-6">
                @php
                $cat = App\Models\Category::findOrFail($vips->title);
                @endphp
            <h3>{{$cat->flotte}}</h3>
                <p style="text-align: justify">
                    {{$vips->content}}
                </p>

            </div>
            <div class="col-lg-6 pt-4 pt-lg-0">
                @php
                $mediaCollection = Spatie\MediaLibrary\MediaCollections\Models\Media::where('collection_name', 'information_home')
                                    ->where('model_type', App\Models\Information::class)
                                    ->where('model_id', $vips->id)
                                    ->orderBy('created_at','desc')
                                    ->limit(1)
                                    ->get();
                @endphp
                @foreach ($mediaCollection as $media)
                    <img src="{{$media->getUrl()}}" class="img-fluid" alt="{{$vips->title}}" width="100%">
                @endforeach


            </div>
        </div>
    @endforeach

    @foreach ($vvip as $vips)
        <div class="row" style="margin-bottom: 20px">
            <div class="col-lg-6">
                @php
                $mediaCollection = Spatie\MediaLibrary\MediaCollections\Models\Media::where('collection_name', 'information_home')
                                    ->where('model_type', App\Models\Information::class)
                                    ->where('model_id', $vips->id)
                                    ->orderBy('created_at','desc')
                                    ->limit(1)
                                    ->get();
                @endphp
                @foreach ($mediaCollection as $media)
                    <img src="{{$media->getUrl()}}" class="img-fluid" alt="{{$vips->title}}" width="100%">
                @endforeach

            </div>
            <div class="col-lg-6 pt-4 pt-lg-0">
                @php
                    $cat = App\Models\Category::findOrFail($vips->title);
                @endphp
            <h3>{{$cat->flotte}}</h3>
            <p style="text-align: justify">
                {{$vips->content}}
            </p>

            </div>
        </div>
    @endforeach

    @foreach ($colis as $vips)
        <div class="row" style="margin-bottom: 20px">
            <div class="col-lg-6">
                @php
                    $cat = App\Models\Category::findOrFail($vips->title);
                @endphp
                <h3>{{$cat->flotte}}</h3>
                <p style="text-align: justify">
                    {{$vips->content}}
                </p>

            </div>
            <div class="col-lg-6 pt-4 pt-lg-0">
                @php
                $mediaCollection = Spatie\MediaLibrary\MediaCollections\Models\Media::where('collection_name', 'information_home')
                                    ->where('model_type', App\Models\Information::class)
                                    ->where('model_id', $vips->id)
                                    ->orderBy('created_at','desc')
                                    ->limit(1)
                                    ->get();
                @endphp
                @foreach ($mediaCollection as $media)
                    <img src="{{$media->getUrl()}}" class="img-fluid" alt="{{$vips->title}}" width="100%">
                @endforeach


            </div>
        </div>
    @endforeach


    </div>
</section><!-- End About Section -->
@endsection
