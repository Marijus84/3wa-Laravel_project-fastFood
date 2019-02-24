@extends('layouts.app')

@section('content')

<main class="secondary">

<div class="container">



  <div class="row justify-content-center">
    <div class="col-md-4 offset-md-6">



      <div class="right card my-4 text-center">
        <img class="card-img-top rest-img mx-0"  src="{{$review->image_url}}" alt="Card image cap">

        <div class="card-body">

          <h2 class="card-title">{{$review->restaurant->network}}</h2>
          <h3 class="card-text">Staff: {{$review->staff}}</h3>
          <h3 class="card-text">Delivery speed: {{$review->delivery_speed}}</h3>
          <h3 class="card-text">Bathroom Quality: {{$review->bathroom_quality}}</h3>
          <h3 class="card-text">Cleanliness: {{$review->cleanliness}}</h3>
          <h3 class="card-text">Drive Through: {{$review->drive_through}}</h3>
          <p class="card-text">{{$review->review}}</p>
        </div>
        <div class="card-footer">
          <div class="card-text"><h4>{{$review->user->name}} {{$review->user->surname}}</h4></div>
            <p class="card-text timeColor">Posted: {{$review->posted}}</p>
        </div>



        <div class="col-md-10 offset-md-1 mb-2 mt-3 text-center">
          @if ((Auth::check() && Auth::user()->id == $review->user_id)||(Auth::check() && Auth::user()->role == 'admin'))
          <a href="{{route('reviews.edit', $review->id)}}" class="mb-2 btn btn-info btn-block">
            Edit Review</a>
          <form  action="{{route('reviews.destroy',$review->id)}}" method="POST">
            @csrf
            @method('DELETE')
            <input type="hidden" name="restaurant_id" value="{{$review->restaurant->id}}">
            <button type="submit"class="btn btn-danger col-md-12 ">Delete Review</button>
          </form>
            <hr>
          @endif
        </div>


      </div>

      </div>



</div>





</div>



@endsection
