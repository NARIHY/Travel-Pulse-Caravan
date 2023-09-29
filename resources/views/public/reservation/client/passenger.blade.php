@extends('public')
@section('title', 'Reservation')

@section('content')
<section id="contact" class="contact" style="margin-top: 40px">
    <div class="container">
        <form action="{{route('Public.Reservation.Auth.passenger_add',['tripId' => $tripId, 'carId' => $carId])}}" method="post"  class="php-email-form">
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
            <div class="row" style="margin-top: 10px">
                <div class="col-md-6 form-group">
                    <input type="text" class="form-control" name="phone_number" id="phone_number" placeholder="Votre numéro de téléphone" required value="{{@old('phone_number')}}">
                </div>

                <div class="col-md-6 form-group mt-3 mt-md-0">
                    <input type="text" class="form-control" name="emergency_contact" id="emergency_contact" placeholder="Contact en cas d'urgence" required value="{{@old('emergency_contact')}}">
                </div>
              </div>


            <div class="form-group mt-3">
              <input type="text" class="form-control" name="address" id="address" placeholder="Lieu de résidence" required value="{{@old('address')}}">
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
</section>
@endsection
