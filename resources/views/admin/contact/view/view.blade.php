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
                <p>Madam/Mr. Manager</p>
                <p style="color: blue">Travel Pulse Caravan</p>
                <p style="color: red">contact@travelPulseCaravan.mg</p>
            </div>
            <div>
                <h6 style="margin-left: 80px"><b style="text-decoration: underline; color:black">Subject:</b> {{$contact->subject}} </h6 style="margin-left: 80px">
            </div>
            <div>
                <p style="margin-left: 30px">Dear,</p>

                <div class="container" style="padding: 15px">
                    <p style="text-align: justify; margin-bottom:5px">I am writing to express my interest in establishing contact and discussing collaboration opportunities or other topics of mutual interest. I recently had the opportunity to experience your ground transportation company and was impressed by your quality services/commitment to safety/reputation in the transportation industry, and much more.</p>
                    <p style="text-align: justify; margin-bottom:5px">As a travel enthusiast, I believe our paths could cross in a beneficial way. I'm excited about all of your offerings and services, and would be happy to discuss how we could collaborate or share ideas to further improve this company.</p>
                    <p style="text-align: justify; margin-bottom:5px">{{$contact->content}}</p>
                    <p style="text-align: justify; margin-bottom:5px">In the meantime, I thank you for taking the time to read my letter and I hope that we can communicate in more detail in the near future. If you have any questions or would like to discuss this opportunity, you can reach me by email at <b style="text-decoration: underline; color:blue;">{{$contact->email}}</b>.</p>
                    <p style="text-align: justify">I send you, Dear Madam/Mr. Manager of Travel Pulse Caravan, the expression of my distinguished greetings.<br> Sincerely,</p>
                    <h4 style="color: rgb(0, 0, 0); text-align:left; margin-left:15px">{{$contact->last_name}} {{$contact->name}}</h4>
                </div>


            </div>

        </div>

  </div>
  @endsection
