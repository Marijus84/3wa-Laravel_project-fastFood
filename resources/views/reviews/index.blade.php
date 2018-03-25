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
          </div>





        </div>

    @endforeach

  </div>





</div>



@endsection
