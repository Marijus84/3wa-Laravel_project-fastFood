@extends('layouts.app')

@section('content')

<div class="container">


    <h1 class="text-center">Your information:</h1>
    <div class="row justify-content-center">


          <div class="col-md-4 mb-2 card">

            <div class="card-body">
              <h5 class="card-title">{{$user->name}}</h5>
              <h5 class="card-title">{{$user->surname}}</h5>
              <p class="card-text">{{$user->email}}</p>
            </div>

            <a href="{{route('users.edit', $user->id)}}" class="btn btn-info btn-block">
              Edit your information</a>
              <form  action="{{route('users.destroy',$user->id)}}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit"class="btn btn-danger col-md-12 ">Delete Your account</button>
              </form>




          </div>



    </div>

    <div class="row justify-content-center">
      <a href="{{route('home')}}" class="btn btn-lg btn-info btn-block col-md-6  my-1">Go to the main page</a>
    </div>
</div>



@endsection
