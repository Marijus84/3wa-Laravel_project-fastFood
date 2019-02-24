@extends('layouts.app')

@section('content')


<div class="container" style = "max-width:1400px">
  <h1>Users:</h1>
      <table class="table">
        <thead>
          <tr>
            <th scope="col">Id</th>
            <th scope="col">User name</th>
            <th scope="col">Surname</th>
            <th scope="col">Email</th>
            <th scope="col">Role</th>
          </tr>
        </thead>
        <tbody>

          @foreach($users as $user)
        <tr>
          <th scope="row">{{$user->id}}</th>
          <td>{{$user->name}}</td>
          <td>{{$user->surname}}</td>
          <td>{{$user->email}}</td>
          <td>{{$user->role}}</td>
        </td>
        <td><a href="{{route('users.edit', $user->id)}}" class="btn btn-info btn-block">
          Edit User's information</a>
        </td>
          <td>
            <form  action="{{route('users.destroy',$user->id)}}" method="POST">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-danger col-md-12">Delete User</button>
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
