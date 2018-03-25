@extends('layouts.app')

@section('content')

<div class="container">


  <div class="row justify-content-center">



        <div class="col-md-5 mb-2 card">

          <img class="card-img-top" src="{{$restaurant->image_url}}" alt="Card image cap">

          <div class="card-body">
            <h2 class="card-title">{{$restaurant->network}} </h2>
            <h2 class="card-title">Staff: {{$restaurant->avg_staff}} </h2>
            <h2 class="card-title">Delivery speed: {{$restaurant->avg_delivery_speed}} </h2>
            <h2 class="card-title">Cleanliness: {{$restaurant->avg_cleanliness}} </h2>
            <h2 class="card-title">Bathroom quality: {{$restaurant->avg_bathroom_quality}} </h2>
            <h2 class="card-title">Drive through: {{$restaurant->avg_drive_through}} </h2>
            <h5 class="card-title">{{$restaurant->adress_line_1}} </h5>
            <h5 class="card-title">{{$restaurant->city}} </h5>
          </div>
          <div class="card-footer">
            @foreach($restaurant->review as $review)
            <div class="text-muted"><h4>Delivery speed: {{$review->delivery_speed}}</h4></div>
            <div class="text-muted"><h4>Cleanliness: {{$review->cleanliness}}</h4></div>
            <div class="text-muted"><h4>Staff: {{$review->staff}}</h4></div>
            <div class="text-muted"><h4>Bathroom Quality: {{$review->bathroom_quality}}</h4></div>
            <div class="text-muted"><h4>Drive through: {{$review->drive_through}}</h4></div>
            <a href="{{route('reviews.edit', $review->id)}}" class="mb-2 btn btn-info btn-block">
              Edit Review</a>
            <form  action="{{route('reviews.destroy',$review->id)}}" method="POST">
              @csrf
              @method('DELETE')
              <input type="hidden" name="restaurant_id" value="{{$restaurant->id}}">
              <button type="submit"class="btn btn-danger col-md-12 ">Delete Review</button>
            </form>
              <hr>
            @endforeach
          </div>




        </div>




  </div>



  @auth
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





</div>

  <script type="text/javascript">
  $( "#reviewBtn" ).click(function() {
    $("#hiddenForm").toggle();
    if ($( "#reviewBtn" ).text()=="Write review") {
      $( "#reviewBtn" ).text("Hide review form");
      }
    else {
      $( "#reviewBtn" ).text("Write review");
    }
  });
  </script>

@endsection
