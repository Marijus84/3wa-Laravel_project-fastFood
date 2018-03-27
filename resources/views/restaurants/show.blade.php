@extends('layouts.app')

@section('content')
<main>

@if ($errors->all())

<script>
  $(document).ready(function(){
  $("#hiddenForm").toggle();
  $( "#reviewBtn" ).text("Hide review form");})
</script>

  @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach


@endif
<div class="container">



<div class="row justify-content-center ">
  <div class="col-md-6 my-5">
    <img class="restImg"src="{{$restaurant->image_url}}" alt="Card image cap">
  </div>


        <div class="col-md-6 my-5 card restaurantInfo text-center">

          <div class="card-body">
            <h2 class="card-text color"><strong>{{$restaurant->network}}</strong> </h2>
            <h5 class="card-text color">{{$restaurant->adress_line_1}}{{$restaurant->city}} </h5>


            <h2 class="card-text color">Staff: {{$restaurant->avg_staff}} </h2>
            <h2 class="card-text color">Delivery speed: {{$restaurant->avg_delivery_speed}} </h2>
            <h2 class="card-text color">Cleanliness: {{$restaurant->avg_cleanliness}} </h2>
            <h2 class="card-text color">Bathroom quality: {{$restaurant->avg_bathroom_quality}} </h2>
            <h2 class="card-text color">Drive through: {{$restaurant->avg_drive_through}} </h2>
            <h2 class="card-text color "><strong>Average value: {{$restaurant->avg_overall}} </strong></h2>
          </div>


        </div>
      </div>


      @Auth
      <div class="row justify-content-center">
        <div class="col-md-3 justify-center">
          <button type="button" class="btn btn-success btn-lg btn-block" id="reviewBtn">Write review</button>
          <hr>
        </div>
      </div>


      <form action="{{route('reviews.store')}}" method="POST" id="hiddenForm" class="needs-validation hidden" enctype="multipart/form-data" >
        @csrf
        <input type="hidden" name="restaurant_id" value="{{$restaurant->id}}">
        <div class="row justify-content-center">
          <div class="col-md-4 mb-3">
            <label for="Speed">Delivery Speed</label>
            <select id="Delivery Speed" name="delivery_speed" class="form-control">
              <option disabled selected>Delivery Speed</option>
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

          <div class="col-md-4 mb-3">
            <label for="Speed">Cleanliness</label>
            <select id="Cleanliness" name="cleanliness" class="form-control">
              <option disabled selected>Cleanliness</option>
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

          <div class="col-md-4 mb-3">
            <label for="Staff">Staff</label>
            <select id="Staff" name="staff" class="form-control">
              <option disabled selected>Staff</option>
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

          <div class="col-md-4 mb-3">
            <label for="Bathroom quality">Bathroom quality</label>
            <select id="bathroom_quality" name="bathroom_quality" class="form-control">
              <option disabled selected>Bathroom Quality</option>
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

          <div class="col-md-4 mb-3">
            <label for="Drive through">Drive through</label>
            <select id="drive_through" name="drive_through" class="form-control">
              <option disabled selected>Drive through</option>
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
        <div class="mb-3">
          <label for="review">Review</label>
          <textarea rows="2" class="form-control @if($errors->has('review')) is-invalid @endif" id="review" name="review">
            {{$value = old('review')}}</textarea>
            @if($errors->has('review'))
            <div class="invalid-feedback">
              {{$errors->first('review')}}
            </div>
            @endif
          </div>

          <div class="row">
            <div class="col-md-12 mb-3">
              <label for="title">Choose an image</label>
              <input type="file" class="form-control @if($errors->has('image_url')) is-invalid @endif" id="image_url" name="image_url" value = "{{$value = old('image_url')}}">
              @if($errors->has('image_url'))
              <div class="invalid-feedback">
                {{$errors->first('image_url')}}
              </div>
              @endif
            </div>
          </div>

          <hr class="mb-4">
          <div class="row justify-content-center">
            <div class="col-md-6 justify-content-center">
              <button class="btn btn-primary btn-lg btn-block" type="submit">Submit review</button>
            </div>
          </div>
        </form>
        @endif
        <hr class="largerHr">

        <div class="row text-center">
          <div class="col">
            <h2 class="mt-5"><strong>Restaurant reviews:</strong></h2>
          </div>
        </div>





          <div class="row justify-content-center">
            <div class="card-columns">

              @foreach($restaurant->review as $review)


              <div class=" card text-center">
                <img class="card-img-top rest-img mx-0"  src="{{$review->image_url}}" alt="Card image cap">
                <div class="card-body">
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
                    <input type="hidden" name="restaurant_id" value="{{$restaurant->id}}">
                    <button type="submit"class="btn btn-danger col-md-12 ">Delete Review</button>
                  </form>
                    <hr>
                  @endif
                </div>



              </div>

            @endforeach
          </div>
        </div>












  </div>








</div>

  <script type="text/javascript">
//  function toggle() {

    $( "#reviewBtn" ).click(function() {
      $("#hiddenForm").toggle();
      if ($( "#reviewBtn" ).text()=="Write review") {
        $( "#reviewBtn" ).text("Hide review form");
      }
      else {
        $( "#reviewBtn" ).text("Write review");
      }
    });
//  }
  </script>

@endsection
