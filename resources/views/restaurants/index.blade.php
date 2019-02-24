@extends('layouts.app')

@section('content')

@if(!(Auth::check() && Auth::user()->role == 'admin'))
<main class="secondary">

@endif

<div class="container">
  <h1 class="py-4">Restaurants:</h1>


      <table class="table">
        <thead>
          <tr>
            @if((Auth::check() && Auth::user()->role == 'admin'))
            <th scope="col">ID</th>
            @endif
            <th scope="col">Network</th>
            <th scope="col">City</th>
            <th scope="col">Phone</th>
            <th scope="col">Overall value</th>
            <th scope="col">Image</th>
            @if(Auth::check() && Auth::user()->role == 'admin')
            <th scope="col">Edit Info</th>
            <th scope="col">Delete</th>
            @else
            <th scope="col">Show</th>
            @endif

          </tr>
        </thead>
        <tbody>




          @foreach($restaurants as $restaurant)
        <tr>
          @if((Auth::check() && Auth::user()->role == 'admin'))
          <th scope="row" class="align-middle">    <a href="{{route('restaurants.show',$restaurant->id)}}">{{$restaurant->id}}</a></th>
          @endif
          <td class="align-middle">{{$restaurant->network}}</td>
          <td class="align-middle">{{$restaurant->city}}</td>
          <td class="align-middle">{{$restaurant->phone}}</td>
          <th class="align-middle">{{$restaurant->avg_overall}}</th>
          <td scope="row"><img class="listImg" src="{{$restaurant->image_url}}" alt="Card image cap"></td>



          @if(Auth::check() && Auth::user()->role == 'admin')
          <td>  <a href="{{route('restaurants.edit', $restaurant->id)}}" class="btn btn-info btn-block">
            Edit Restaurant info</a>
          </td>
          <td>
            <form  action="{{route('restaurants.destroy',$restaurant->id)}}" method="POST">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-danger col-md-12">Delete Restaurant</button>
            </form>
          </td>
          @else
          <td >  <a href="{{route('restaurants.show', $restaurant->id)}}" class="btn btn-info btn-block">
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
