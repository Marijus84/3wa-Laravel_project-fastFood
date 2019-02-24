@extends('layouts.app')

@section('content')

<main>



<div class="container">


  <div class="row justify-content-center">
    <div class="col-md-5">



      <div class="right card my-5 text-center">
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

      <div class="col-md-7">


  @auth

    <form action="{{route('reviews.update', $review->id)}}" method="POST" id="hiddenForm" class="needs-validation" enctype="multipart/form-data" >
      @csrf
      @method('PUT')
      <input type="hidden" name="restaurant_id" value="{{$review->restaurant->id}}">
          <div class="row justify-content-center">
              <div class="col-md-6 mb-3">
                  <label for="Speed">Delivery Speed</label>
                  <select id="Delivery Speed" name="delivery_speed" class="form-control">
                    <option disabled selected>{{old('delivery_speed',$review->delivery_speed)}}</option>
                    <?php for ($i=0; $i <= 10 ; $i++) { ?>
                      <option value="<?=$i?>"><?= $i?></option>
                    <?php } ?>
                  </select>
                  @if($errors->has('delivery_speed'))
                  <div class="invalid-feedback">
                    {{$errors->first('delivery_speed')}}
                  </div>
                  @endif
              </div>
            </div>

            <div class="row justify-content-center">
              <div class="col-md-6 mb-3">
                  <label for="Speed">Cleanliness</label>
                  <select id="Cleanliness" name="cleanliness" class="form-control">
                    <option disabled selected>{{old('cleanliness',$review->cleanliness)}}</option>
                    <?php for ($i=0; $i <= 10 ; $i++) { ?>
                      <option value="<?=$i?>"><?= $i?></option>
                    <?php } ?>
                  </select>
                  @if($errors->has('cleanliness'))
                  <div class="invalid-feedback">
                    {{$errors->first('cleanliness')}}
                  </div>
                  @endif
              </div>
            </div>

            <div class="row justify-content-center">
              <div class="col-md-6 mb-3">
                  <label for="Staff">Staff</label>
                  <select id="Staff" name="staff" class="form-control">
                    <option disabled selected>{{old('staff',$review->staff)}}</option>
                    <?php for ($i=0; $i <= 10 ; $i++) { ?>
                      <option value="<?=$i?>"><?= $i?></option>
                    <?php } ?>
                  </select>
                  @if($errors->has('staff'))
                  <div class="invalid-feedback">
                    {{$errors->first('staff')}}
                  </div>
                  @endif
              </div>
            </div>

            <div class="row justify-content-center">
              <div class="col-md-6 mb-3">
                  <label for="Bathroom quality">Bathroom quality</label>
                  <select id="bathroom_quality" name="bathroom_quality" class="form-control">
                    <option disabled selected>{{old('bathroom_quality',$review->bathroom_quality)}}</option>
                    <?php for ($i=0; $i <= 10 ; $i++) { ?>
                      <option value="<?=$i?>"><?= $i?></option>
                    <?php } ?>
                  </select>
                  @if($errors->has('bathroom_quality'))
                  <div class="invalid-feedback">
                    {{$errors->first('bathroom_quality')}}
                  </div>
                  @endif
              </div>
            </div>

            <div class="row justify-content-center">
              <div class="col-md-6 mb-3">
                  <label for="Drive through">Drive through</label>
                  <select id="drive_through" name="drive_through" class="form-control">
                    <option disabled selected>{{old('drive_through',$review->drive_through)}}</option>
                    <?php for ($i=0; $i <= 10 ; $i++) { ?>
                      <option value="<?=$i?>"><?= $i?></option>
                    <?php } ?>
                  </select>
                  @if($errors->has('drive_through'))
                  <div class="invalid-feedback">
                    {{$errors->first('drive_through')}}
                  </div>
                  @endif
              </div>
            </div>


            <div class="row justify-content-center">
              <div class="col-md-6 mb-1">
                <label for="title">Image url</label>
                <input type="file" class="form-control @if($errors->has('image_url')) is-invalid @endif" id="image_url" name="image_url" value = "{{old('image_url',$review->image_url)}}">
                @if($errors->has('image_url'))
                <div class="invalid-feedback">
                  {{$errors->first('image_url')}}
                </div>
                @endif
              </div>
            </div>

            <div class="row justify-content-center">
              <div class="col-md-12 mb-1">

              <label for="review">Review</label>
              <textarea rows="6" class="form-control @if($errors->has('review')) is-invalid @endif" id="review" name="review">
                {{old('review',$review->review)}}</textarea>
              @if($errors->has('review'))
              <div class="invalid-feedback">
                {{$errors->first('review')}}
              </div>
              @endif
          </div>
        </div>


          <hr class="mb-1">
          <div class="row justify-content-center">
          <div class="col-md-6 justify-content-center">
          <button class="btn btn-primary btn-lg btn-block mb-5  " type="submit">Submit changes</button>
          </div>
        </div>
      </form>






    @endif

  </div>

</div>




</div>


@endsection
