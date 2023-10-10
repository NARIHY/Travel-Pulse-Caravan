@extends('admin')

@section('title', 'Message received')

@section('content')
<div class="pagetitle">
    <h1>Message received</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item"><a href="{{route('Admin.Contact.listing')}}">Message received</a></li>
        <li class="breadcrumb-item active">{{$contact->subject}}</li>

      </ol>
    </nav>
  </div>
  <div class="container">
        <div class="card" style="padding: 10px">
            <h1 style="text-align: center; font-family:Verdana, Geneva, Tahoma, sans-serif">Message received</h1>
            <div style="text-align: left; margin-left:15px">
                <p>{{$contact->last_name}} {{$contact->name}}</p>
                <p style="color: blue">{{$contact->email}}</p>
                @php
                $date = Carbon\Carbon::parse($contact->created_at);
                $dateFormated = $date->format('D d M Y');
                @endphp
                <p>{{$dateFormated}}</p>
            </div>
            <div style="text-align: right; margin-right:15px">
                <p>Madame/Monsieur le responsable</p>
                <p style="color: blue">Travel Pulse Caravan</p>
                <p style="color: red">contact@travelPulseCaravan.mg</p>
            </div>
            <div>
                <h6 style="margin-left: 80px"><b style="text-decoration: underline; color:black">Objet:</b> {{$contact->subject}} </h6 style="margin-left: 80px">
            </div>
            <div>
                <p style="margin-left: 30px">Madame, Monsieur,</p>

                <div class="container" style="padding: 15px">
                    <p style="text-align: justify; margin-bottom:5px">Je vous écris pour exprimer mon intérêt à établir un contact et à discuter d'opportunités de collaboration ou d'autres sujets d'intérêt mutuel. J'ai récemment eu l'occasion de découvrir votre entreprise de transport terrestre et j'ai été impressionné par vos services de qualité/votre engagement envers la sécurité/votre réputation dans le secteur du transport, et bien d'autres encore.</p>
                    <p style="text-align: justify; margin-bottom:5px">En tant que passionné(e) du monde de voyage, je crois que nos chemins pourraient se croiser de manière bénéfique. Je suis enthousiaste à l'idée de toutes vos offres et services, et je serais ravi(e) de discuter de la manière dont nous pourrions collaborer ou partager des idées pour améliorer davantage cette compagnie.</p>
                    <p style="text-align: justify; margin-bottom:5px">{{$contact->content}}</p>
                    <p style="text-align: justify; margin-bottom:5px">En attendant, je vous remercie de prendre le temps de lire ma lettre et j'espère que nous pourrons échanger plus en détail dans un proche avenir. Si vous avez des questions ou si vous souhaitez discuter de cette opportunité, vous pouvez me joindre  par e-mail à <b style="text-decoration: underline; color:blue;">{{$contact->email}}</b>.</p>
                    <p style="text-align: justify">Je vous adresse, Cher(e) Madame/Monsieur le responsable de Travel Pulse Caravan, l'expression de mes salutations distinguées. <br> Cordialement,</p>
                    <h4 style="color: rgb(0, 0, 0); text-align:left; margin-left:15px">{{$contact->last_name}} {{$contact->name}}</h4>
                </div>


            </div>

        </div>

  </div>
  @endsection
