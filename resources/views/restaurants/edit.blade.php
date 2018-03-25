@extends('layouts.app')

@section('content')


<div class="container">



  <div class="row justify-content-center">
    <div class="col-md-8 order-md-1">
      <h4 class="mb-3">Edit restaurant</h4>

      <form action="{{route('restaurants.update', $restaurant->id)}}" method="POST" class="needs-validation" enctype="multipart/form-data" >
        @csrf
        @method('PUT')
            <div class="row">
                <div class="col-md-12 mb-3">
                    <label for="title">Network</label>
                    <input type="text" class="form-control @if($errors->has('network')) is-invalid @endif" id="network" name="network" value = "{{old('network',$restaurant->network)}}">
                    @if($errors->has('network'))
                    <div class="invalid-feedback">
                      {{$errors->first('network')}}
                    </div>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mb-3">
                    <label for="title">Adress Line 1</label>
                    <input type="text" class="form-control @if($errors->has('adress_line_1')) is-invalid @endif" id="adress_line_1" name="adress_line_1" value = "{{old('adress_line_1',$restaurant->adress_line_1)}}">
                    @if($errors->has('adress_line_1'))
                    <div class="invalid-feedback">
                      {{$errors->first('adress_line_1')}}
                    </div>
                    @endif
                </div>
            </div>
            <div class="row">
              <div class="col-md-12 mb-3">
                <label for="price">City</label>
                <input type="text" class="form-control @if($errors->has('city')) is-invalid @endif" id="city" name="city" value = "{{old('city',$restaurant->city)}}">
                @if($errors->has('city'))
                <div class="invalid-feedback">
                  {{$errors->first('city')}}
                </div>
                @endif
              </div>
            </div>
            <div class="row">
              <div class="col-md-12 mb-3">
                <label for="price">Post Code</label>
                <input type="text" class="form-control @if($errors->has('post_code')) is-invalid @endif" id="post_code" name="post_code" value = "{{old('post_code',$restaurant->post_code)}}">
                @if($errors->has('post_code'))
                <div class="invalid-feedback">
                  {{$errors->first('post_code')}}
                </div>
                @endif
              </div>
            </div>
            <div class="row">
              <div class="col-md-12 mb-3">
                <label for="price">Phone</label>
                <input type="text" class="form-control @if($errors->has('phone')) is-invalid @endif" id="phone" name="phone" value = "{{old('phone',$restaurant->phone)}}">
                @if($errors->has('phone'))
                <div class="invalid-feedback">
                  {{$errors->first('phone')}}
                </div>
                @endif
              </div>
            </div>

            <div class="row">
                <div class="col-md-8 mb-3">
                    <label for="title">Image url</label>
                    <input type="file" class="form-control @if($errors->has('image_url')) is-invalid @endif" id="image_url" name="image_url" value = "{{old('image_url',$restaurant->image_url)}}">
                    @if($errors->has('image_url'))
                    <div class="invalid-feedback">
                      {{$errors->first('image_url')}}
                    </div>
                    @endif
                </div>
            </div>

            <hr class="mb-4">
            <button class="btn btn-primary btn-lg btn-block" type="submit">Submit changes</button>
        </form>


        <div class="row justify-content-center">
          <div class="col-md-12">
            <a href="{{route('home')}}" class="btn btn-lg btn-block btn-info my-2"> Return </a>
            <hr>
          </div>
        </div>
</div>


@endsection
