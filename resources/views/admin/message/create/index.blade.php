@extends('admin')

@section('title', 'Messagerie')

@section('content')
@php
$user = Auth::user();
@endphp
    <form action="" method="post">
        @csrf
        <label for="expediteur">L'expéditeur du message</label>
        <select name="expediteur" id="expediteur" class="form-control">
            <option value="{{$user->id}}">{{$user->name}}</option>
        </select>
        <label for="destinataire">L'expéditeur du message</label>
        <select name="destinataire" id="destinataire" class="form-control">
            <option value="">Choisir un utilisateur</option>
            @foreach ($allUser as $k => $v)
                <option value="{{$v}}">{{$k}}</option>
            @endforeach
        </select>

        <div class="d-grid gap-2" style="margin-top: 10px">
            <button class="btn btn-primary" type="submit"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Créer</font></font></button>
        </div>
    </form>
@endsection
