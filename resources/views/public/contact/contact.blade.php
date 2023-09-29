@extends('public')
@section('title', 'Nous contacter')

@section('content')
<!-- ======= Contact Section ======= -->
<section id="contact" class="contact" style="margin-top: 40px">
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
                <p>travelpulsecaravan@gmail.com</p>
              </div>
            </div>
            <div class="col-md-6">
              <div class="info-box mt-4">
                <i class="bx bx-phone-call"></i>
                <h3>Appeler nous</h3>
                <p>+261 00 00 000 00</p>
              </div>
            </div>
          </div>

        </div>

        <div class="col-lg-6">
          <form action="{{route('Public.contacts.store')}}" method="post"  class="php-email-form">
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
