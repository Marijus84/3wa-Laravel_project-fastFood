@extends('layouts.app')

@section('content')

<main class="secondary">



<div class="container">


    <h1 class="text-center py-5"><strong>Your information:</strong></h1>
    <div class="row justify-content-center">


          <div class="col-md-4 mb-2 card">

            <div class="card-body">
              <h5 class="card-title">{{$user->name}}</h5>
              <h5 class="card-title">{{$user->surname}}</h5>
              <p class="card-text">{{$user->email}}</p>
            </div>

            <a href="{{route('users.edit', $user->id)}}"><button type="submit"class="btn btn-info col-md-8 ">Edit your info</button>
              </a>
              <form  action="{{route('users.destroy',$user->id)}}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit"class="btn btn-danger col-md-8 my-2">Delete Your account</button>
              </form>




          </div>



    </div>

    <div class="row justify-content-center">
      <a href="{{route('home')}}" class="btn btn-lg btn-info btn-block col-md-6  my-1">Go to the main page</a>
    </div>
</div>



@endsection
