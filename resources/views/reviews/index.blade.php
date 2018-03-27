@extends('layouts.app')

@section('content')
@if (!(Auth::check() && Auth::user()->role == 'admin'))
<main>

@endif
<div class="container">


  @if (Auth::check() && Auth::user()->role == 'admin')


  <table class="table">
    <thead>
      <tr>
        <th scope="col">Image</th>
        <th scope="col">Network</th>
        <th scope="col">Staff</th>
        <th scope="col">Delivery_speed</th>
        <th scope="col">Cleanliness</th>
        <th scope="col">Drive through</th>
        <th scope="col">Bathroom quality</th>
        <th scope="col">Author</th>
        <th scope="col">Post time</th>
        <th scope="col">View</th>
        <th scope="col">Update</th>
        <th scope="col">Delete</th>
      </tr>
    </thead>
    <tbody>

      @foreach($reviews as $review)
    <tr>
      <th scope="row"><img class="listImg" src="{{$review->image_url}}" alt="Card image cap"></th>
      <th><a href = "{{route('restaurants.show', $review->restaurant->id)}}">{{$review->restaurant->network}}</a></th>
      <td>{{$review->staff}}</td>
      <td>{{$review->delivery_speed}}</td>
      <td>{{$review->cleanliness}}</td>
      <td>{{$review->drive_through}}</td>
      <td>{{$review->bathroom_quality}}</td>

      <td>{{$review->user->name}} {{$review->user->surname}}</td>
      <td>{{$review->posted}}</td>



      <td>  <a href="{{route('reviews.show', $review->id)}}" class="btn btn-success btn-block">
        View full review</a>
      </td>
      <td>  <a href="{{route('reviews.edit', $review->id)}}" class="btn btn-info btn-block">
        Edit Review</a>
      </td>
      <td>
        <form  action="{{route('reviews.destroy',$review->id)}}" method="POST">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-danger col-md-12">Delete Review</button>
        </form>
      </td>

    </tr>

    @endforeach



</tbody>
</table>





  @else

<h1 class="text-center py-5"><strong>Your reviews:</strong></h1>

  <div class="row justify-content-center">
    <div class="card-columns">
      @foreach($reviews as $review)

      <div class=" card text-center">
        <a href = "{{route('reviews.show', $review->id)}}">  <img class="card-img-top rest-img mx-0"  src="{{$review->image_url}}" alt="Card image cap"></a>
        <div class="card-body">
          <h2 class="card-title"><a href = "{{route('restaurants.show', $review->restaurant->id)}}">{{$review->restaurant->network}}</a></h2>
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

        @endforeach
      </div>
    </div>
  @endif






</div>



@endsection
