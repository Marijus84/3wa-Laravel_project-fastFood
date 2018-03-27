@extends('layouts.app')

@section('content')

<main>



<div class="container">


  <div class="row justify-content-center">



        <div class="col-md-8 mb-2 card">


          <div class="card-footer">

            <div class="text-muted"><h4>Delivery speed: {{$review->delivery_speed}}</h4></div>
            <div class="text-muted"><h4>Cleanliness: {{$review->cleanliness}}</h4></div>
            <div class="text-muted"><h4>Staff: {{$review->staff}}</h4></div>
            <div class="text-muted"><h4>Bathroom Quality: {{$review->bathroom_quality}}</h4></div>
            <div class="text-muted"><h4>Drive through: {{$review->drive_through}}</h4></div>
          <hr>

          </div>
        </div>
  </div>
  @auth

    <form action="{{route('reviews.update', $review->id)}}" method="POST" id="hiddenForm" class="needs-validation" enctype="multipart/form-data" >
      @csrf
      @method('PUT')
      <input type="hidden" name="restaurant_id" value="{{$review->restaurant->id}}">
          <div class="row justify-content-center">
              <div class="col-md-4 mb-3">
                  <label  class="white"for="Speed">Delivery Speed</label>
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

              <div class="col-md-4 mb-3">
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

              <div class="col-md-4 mb-3">
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

              <div class="col-md-4 mb-3">
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

              <div class="col-md-4 mb-3">
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
          <div class="mb-3">
              <label for="review">Review</label>
              <textarea rows="2" class="form-control @if($errors->has('review')) is-invalid @endif" id="review" name="review">
                {{old('review',$review->review)}}</textarea>
              @if($errors->has('review'))
              <div class="invalid-feedback">
                {{$errors->first('review')}}
              </div>
              @endif
          </div>

          <div class="row">
              <div class="col-md-8 mb-3">
                  <label for="title">Image url</label>
                  <input type="file" class="form-control @if($errors->has('image_url')) is-invalid @endif" id="image_url" name="image_url" value = "{{old('image_url',$review->image_url)}}">
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
          <button class="btn btn-primary btn-lg btn-block" type="submit">Submit changes</button>
          </div>
        </div>
      </form>






    @endif





</div>


@endsection
