@extends('admin')

@section('title', 'Liste de tous les messages')

@section('content')
<div class="pagetitle">
    <h1>Messagerie</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('Admin.index')}}">Tableau de bord</a></li>
        <li class="breadcrumb-item">Liste de tous les messages reçu</li>
      </ol>
    </nav>
  </div>


    <!-- Liste pour afficher les messages -->
    <ul class="list-group">





    @forelse ($participantId as $participant)
                        @php
                            $message = App\Models\Message::where('participant', $participant->id)
                                                            ->orderBy('created_at', 'desc')
                                                            ->value('content');


                            $d = App\Models\Message::where('participant', $participant->id)
                                                            ->orderBy('created_at', 'desc')
                                                            ->limit(1)
                                                            ->get();



                            //
                            $differentUser = "";
                            if ($participant->expediteur != $user->id) {
                                $differentUser = $participant->expediteur;
                            }

                            if ($participant->destinataire != $user->id) {
                                $differentUser = $participant->destinataire;
                            }
                            //recuperation de l'user different de l'user actuel
                            $diffUser = App\Models\User::findOrFail($differentUser);

                        @endphp

                @if (!empty($message))
                    <!-- Messages (exemple) -->

                    <a href="{{route('Admin.Message.discution', ['participant' => $participant->id])}}">
                        <li class="list-group-item">
                            <div class="d-flex align-items-center">
                                <div style="margin-right: 20px">
                                    @if (empty($diffUser->picture))
                                        <img src="{{asset('admin/users-default/default.png')}}" alt="Profile" class="rounded-circle" width="50px">
                                    @else
                                        <img src="/storage/{{$diffUser->picture}}" alt="{{$diffUser->name}}" class="rounded-circle" width="50px">
                                    @endif
                                </div>
                                <div class="col-md-11">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h5 class="mb-1" style="color: blue">{{$diffUser->name}}</h5>
                                    </div>
                                    <p class="mb-0">{{$message}}</p>
                                    @foreach ($d as $date)
                                        @php
                                            $formattedDate = Carbon\Carbon::parse($date->created_at)->diffForHumans();
                                        @endphp
                                        <small>{{$formattedDate}}</small>
                                    @endforeach
                                </div>
                            </div>
                        </li>
                    </a>

                @endif
            @empty
                Aucun message pour le moments
            @endforelse
        </ul>
        {{$participantId->links()}}
@endsection
