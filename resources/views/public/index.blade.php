@extends('public')

@section('title', 'Acceuil')

@section('content')
 <!-- ======= Hero Section ======= -->
 <section id="hero" class="d-flex align-items-center justify-content-center">
    <div class="container position-relative">
      <h1>Bienvenue chez Travel Pulse Caravan</h1>
      <h2>Votre partenaire de confiance pour des voyages inoubliables.</h2>

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
        <h2>Nos services</h2>
        <p>
            Chez Travel Pulse Caravan, où nous vous proposons une gamme complète de services pour répondre à tous vos besoins en matière de voyage. Que vous recherchiez une escapade relaxante, une aventure passionnante ou un voyage d'affaires sans tracas, nous avons tout ce qu'il vous faut.

Nos services comprennent des transferts aéroport, une sélection variée d'hébergements allant des hôtels de luxe aux éco-lodges en pleine nature, des visites guidées passionnantes pour explorer les trésors de chaque destination, et des forfaits personnalisés pour des expériences uniques. Nous mettons l'accent sur la sécurité, le confort et l'authenticité, garantissant ainsi des voyages mémorables à chaque étape de votre aventure.

Que vous rêviez de plages de sable blanc, d'explorations en pleine nature, de découvertes culturelles ou de délices gastronomiques, nos services sont conçus pour vous offrir des expériences exceptionnelles, quelle que soit votre destination. Laissez-nous vous guider vers l'aventure de votre choix, et préparez-vous à vivre des moments inoubliables avec Travel Pulse Caravan.
        </p>
      </div>
      <div class="section-title">
        <h2>Nos flotte de voiture</h2>
        <p>
            Explorez Madagascar à votre rythme grâce à notre flotte diversifiée, comprenant des véhicules de tourisme,des car, des minibus luxueux et des minibus spacieux.
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
        <h2>Nous contacter</h2>
        <p>
            Besoin de nous connaître un peu plus, n'hésitez pas à nous contacter.
        </p>
      </div>

      <div class="row">

        <div class="col-lg-6">

          <div class="row">
            <div class="col-md-12">
              <div class="info-box">
                <i class="bx bx-map"></i>
                <h3>Notre addresse</h3>
                <p>Madagascar,Antananarivo,Mahamasina</p>
              </div>
            </div>
            <div class="col-md-6">
              <div class="info-box mt-4">
                <i class="bx bx-envelope"></i>
                <h3>Notre addresse email</h3>
                <p>info@example.mg<br>contact@example.mg</p>
              </div>
            </div>
            <div class="col-md-6">
              <div class="info-box mt-4">
                <i class="bx bx-phone-call"></i>
                <h3>Appeler nous</h3>
                <p>+261 00 000 00<br>+261 00 000 00</p>
              </div>
            </div>
          </div>

        </div>

        <div class="col-lg-6">
          <form action="{{route('Public.store')}}" method="post"  class="php-email-form">
            @csrf
            <div class="row">
              <div class="col-md-6 form-group">
                <input type="text" name="name" class="form-control" id="name" placeholder="Votre nom" required value="{{@old('name')}}">
              </div>

              <div class="col-md-6 form-group mt-3 mt-md-0">
                <input type="text" name="last_name" class="form-control" id="last_name" placeholder="Votre prénon" required value="{{@old('name')}}">
              </div>
            </div>
            <div class="form-group mt-3">
                <input type="email" class="form-control" name="email" id="email" placeholder="email@gmail.com" required value="{{@old('email')}}">
            </div>
            <div class="form-group mt-3">
              <input type="text" class="form-control" name="subject" id="subject" placeholder="Sujet de conversation" required value="{{@old('subject')}}">
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
            <div class="text-center" style="margin-top: 10px"><button type="submit">Envoyer</button></div>
          </form>
        </div>

      </div>

    </div>
  </section><!-- End Contact Section -->


@endsection
