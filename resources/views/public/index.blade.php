@extends('public')

@section('title', 'Acceuil')

@section('content')
 <!-- ======= Hero Section ======= -->
 <section id="hero" class="d-flex align-items-center justify-content-center">
    <div class="container position-relative">
      <h1>Welcome to Travel Pulse Caravan</h1>
      <h2>Your trusted partner for unforgettable trips.</h2>

    </div>
  </section><!-- End Hero -->

  <section id="about" class="about">
    <div class="container">
        @foreach ($home as $homes)
            <div class="row">
                <div class="col-lg-6">
                    @php
                    $mediaCollection = Spatie\MediaLibrary\MediaCollections\Models\Media::where('collection_name', 'home_collection')
                                        ->where('model_type', App\Models\HomeAdmin::class)
                                        ->where('model_id', $homes->id)
                                        ->get();
                    @endphp
                    @foreach ($mediaCollection as $media)
                        <img src="{{$media->getUrl()}}" class="img-fluid" alt="{{$homes->title}}" width="100%">
                    @endforeach

                </div>
                <div class="col-lg-6 pt-4 pt-lg-0">
                <h3>{{$homes->title}}</h3>
                <p style="text-align: justify">
                    {{$homes->content}}
                </p>

                </div>
            </div>
        @endforeach


    </div>
  </section><!-- End About Section -->
  <!-- ======= Services Section ======= -->
  <section id="services" class="services">
    <div class="container">
      <div class="section-title">
        <h2>Our services</h2>
        <p>
            At Travel Pulse Caravan, where we offer you a full range of services to meet all your travel needs. Whether you're looking for a relaxing getaway, an exciting adventure, or a hassle-free business trip, we've got you covered.

Our services include airport transfers, a diverse selection of accommodation from luxury hotels to wilderness eco-lodges, exciting guided tours to explore the treasures of each destination, and personalized packages for unique experiences. We focus on safety, comfort and authenticity, ensuring memorable trips at every stage of your adventure.

Whether you dream of white sand beaches, wilderness explorations, cultural discoveries or gastronomic delights, our services are designed to provide you with exceptional experiences, whatever your destination. Let us guide you to the adventure of your choice, and get ready to experience unforgettable moments with Travel Pulse Caravan.
        </p>
      </div>
      <div class="section-title">
        <h2>Our car fleet</h2>
        <p>
            Explore Madagascar at your own pace with our diverse fleet, including passenger vehicles, coaches, luxury minibuses and spacious minibuses.
        </p>
      </div>

      <div class="row">

        @foreach ($category as $categories)
            <div class="col-md-3" data-aos="zoom-in" data-aos-delay="100" style="margin-bottom: 5px">
                <div class="icon-box iconbox-@if($categories->id == 1)dark @elseif($categories->id == 2)blue @elseif ($categories->id == 3)orange @elseif ($categories->id == 4)red @elseif($categories->id == 5)yellow @endif">
                    <div class="icon">
                        <i class="bi bi-bus-front-fill"></i>
                    </div>
                   <a href="#"> <h4>{{$categories->flotte}}</h4></a>

                </div>
          </div>
        @endforeach



      </div>

    </div>
  </section><!-- End Services Section -->

  <!-- ======= Contact Section ======= -->
  <section id="contact" class="contact">
    <div class="container">

      <div class="section-title">
        <h2>Contact us</h2>
        <p>
            If you need to know us a little more, do not hesitate to contact us.
        </p>
      </div>

      <div class="row">

        <div class="col-lg-6">

          <div class="row">
            <div class="col-md-12">
              <div class="info-box">
                <i class="bx bx-map"></i>
                <h3>Our address</h3>
                <p>Madagascar,Antananarivo,Mahamasina</p>
              </div>
            </div>
            <div class="col-md-6">
              <div class="info-box mt-4">
                <i class="bx bx-envelope"></i>
                <h3>Our email address</h3>
                <p>travelpulsecaravan@gmail.mg</p>
              </div>
            </div>
            <div class="col-md-6">
              <div class="info-box mt-4">
                <i class="bx bx-phone-call"></i>
                <h3>Call us</h3>
                <p>+261 00 00 000 00</p>
              </div>
            </div>
          </div>

        </div>

        <div class="col-lg-6">
          <form action="{{route('Public.store')}}" method="post"  class="php-email-form">
            @csrf
            <div class="row">
              <div class="col-md-6 form-group">
                <input type="text" name="name" class="form-control" id="name" placeholder="Your name" required value="{{@old('name')}}">
              </div>

              <div class="col-md-6 form-group mt-3 mt-md-0">
                <input type="text" name="last_name" class="form-control" id="last_name" placeholder="Your lastname" required value="{{@old('name')}}">
              </div>
            </div>
            <div class="form-group mt-3">
                <input type="email" class="form-control" name="email" id="email" placeholder="email@gmail.com" required value="{{@old('email')}}">
            </div>
            <div class="form-group mt-3">
              <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject of conversation" required value="{{@old('subject')}}">
            </div>
            <div class="form-group mt-3">
              <textarea class="form-control" name="content" rows="5" placeholder="content" required></textarea>
            </div>
            @if (session('error'))
                <div style="color: red">{{session('error')}}</div>
            @endif
            @if (session('success'))
                <div style="color: green">{{session('success')}}</div>
              @endif
            <div class="text-center" style="margin-top: 10px"><button type="submit">Send</button></div>
          </form>
        </div>

      </div>

    </div>
  </section><!-- End Contact Section -->


@endsection
