@extends('layouts.app')

@section('content')

<div class="container">

  <div class="row justify-content-center">

    @foreach($reviews as $review)

        <div class="col-md-5 mb-2 card">

          <img class="card-img-top" src="{{$review->image_url}}" alt="Card image cap">

          <div class="card-body">
            <h3 class="card-title">{{$review->restaurant->network}} </h3>
            <h5 class="card-title">{{$review->restaurant->adress_line_1}} </h5>
            <h5 class="card-title">{{$review->restaurant->city}} </h5>
            <p class="card-text">{{$review->review}}</p>
          </div>
          <div class="card-footer">
            <div class="text-muted"><h4>Delivery speed: {{$review->delivery_speed}}</h4></div>
            <div class="text-muted"><h4>Cleanliness: {{$review->cleanliness}}</h4></div>
            <div class="text-muted"><h4>Staff: {{$review->staff}}</h4></div>
            <div class="text-muted"><h4>Bathroom Quality: {{$review->bathroom_quality}}</h4></div>
            <div class="text-muted"><h4>Drive through: {{$review->drive_through}}</h4></div>

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

    @endforeach

  </div>





</div>



@endsection
