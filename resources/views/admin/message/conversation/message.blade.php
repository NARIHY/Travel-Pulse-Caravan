@extends('admin')

@section('title', 'Messagerie')

@section('content')
<div class="pagetitle">
    <h1>Messagerie</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('Admin.index')}}">Dashboard</a></li>
        <li class="breadcrumb-item">Message from you and {{$diffUser->name}}</li>
      </ol>
    </nav>
</div>

<iframe src="{{route('Admin.Message.discutionOneOne', ['participant' => $participant])}}" frameborder="0"  width="100%" height="600px" style="padding: 20px"></iframe>

        <form action="" method="post">
            @csrf
            <div class="row mb-3">
                <div class="col-md-10">
                    <input type="text" name="content" id="content" class="form-control" value="{{@old('content')}}" placeholder="Votre message...">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary">Send <i class="bi bi-send"></i></button>

                </div>
            </div>


        </form>


@endsection
