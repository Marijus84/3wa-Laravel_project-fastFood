@extends('layouts.app')

@section('content')


<div class="container">
  <h1>Restaurants:</h1>


      <table class="table">
        <thead>
          <tr>
            <th scope="col">Network</th>
            <th scope="col">City</th>
            <th scope="col">Phone</th>
            <th scope="col">Staff</th>
            <th scope="col">Delivery speed</th>
            <th scope="col">Cleanliness</th>
            <th scope="col">Bathroom quality</th>
            <th scope="col">Drive through</th>
            <th scope="col">Image</th>
          </tr>
        </thead>
        <tbody>




          @foreach($restaurants as $restaurant)
        <tr>
          <th scope="row">    <a href="{{route('restaurants.show',$restaurant->id)}}">{{$restaurant->id}}</a></th>
          <td>{{$restaurant->network}}</td>
          <td>{{$restaurant->city}}</td>
          <td>{{$restaurant->phone}}</td>
          <td>{{$restaurant->avg_staff}}</td>
          <td>{{$restaurant->avg_delivery_speed}}</td>
          <td>{{$restaurant->avg_cleanliness}}</td>
          <td>{{$restaurant->avg_bathroom_quality}}</td>
          <td>{{$restaurant->avg_drive_through}}</td>
          <td>{{$restaurant->image}}</td>


          @if(Auth::check() && Auth::user()->role == 'admin')
          <td>
            <form  action="{{route('restaurants.destroy',$restaurant->id)}}" method="POST">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-danger col-md-12">Delete Restaurant</button>
            </form>
          </td>
          <td>  <a href="{{route('restaurants.edit', $restaurant->id)}}" class="btn btn-info btn-block">
              Edit Restaurant info</a>
          </td>
          @else
          <td>  <a href="{{route('restaurants.show', $restaurant->id)}}" class="btn btn-info btn-block">
              Show restaurant</a>
          </td>
          @endif
        </tr>

        @endforeach



  </tbody>
</table>

  @if(Auth::check() && Auth::user()->role == 'admin')

  <div class="row justify-content-center">
    <a href="{{route('restaurants.create')}}" class="btn btn-lg btn-success btn-block col-md-6  my-1">Add new restaurant</a>
  </div>

  <div class="row justify-content-center">
    <a href="{{route('home')}}" class="btn btn-lg btn-info btn-block col-md-6  my-1">Go to the start page</a>
  </div>

  @endif

  <hr>

</div>



@endsection
