@extends('layouts.app')

@section('content')



@endif

<div class="container">
  <h1>Live feed:</h1>


      <table class="table">
        <thead>
          <tr>
            <th scope="col">Id</th>
            <th scope="col">Name</th>
            <th scope="col">Title</th>
            <th scope="col">Comment</th>
          </tr>
        </thead>
        <tbody>




          @foreach($lives as $live)
        <tr>
          <th scope="row">{{$live->id}}</th>
          <td>{{$live->name}}</td>
          <td>{{$live->title}}</td>
          <td>{{$live->comment}}</td>
          <td>
            <form  action="{{route('lives.destroy', $live->id)}}" method="POST">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-danger col-md-12">Delete Live Comment</button>
            </form>
          </td>
        </tr>

        @endforeach



  </tbody>
</table>


  <div class="row justify-content-center">
    <a href="{{route('home')}}" class="btn btn-lg btn-info btn-block col-md-6  my-1">Go to the start page</a>
  </div>


  <hr>

</div>



@endsection
