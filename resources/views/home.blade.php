@extends('layouts.app')

@section('content')
<div class="container">
  <div class="content">
      <div class="title m-b-md">
          Fast Food Guru! </br>
          Coming Soon!
      </div>

      <div class="row mb-4 justify-content-center">
        <div class="col-md-6">
        <form  action="#" method="GET">
          @csrf
          <div class="input-group">
            <input type="text" id = "search" name= "find" class="form-control find" placeholder="Search for restaurants">
            <span class="input-group-btn">
              <button class="btn btn-secondary go"  type="submit">View matches!</button>
            </span>
          </div>
      </form>

      </div>
      </div>

      <div class="row justify-content-center">
        <div class="col-md-4">

          <div class="results">
          </div>

          </div>

      </div>

  </div>


<div class="row justify-content-center">
  <div class="col-md-5 order-md-1">
    <h4 class="mb-3">Add Live</h4>

      <form  action="{{route('lives.store')}}" id = "liveForm" method="GET">
        @csrf
        <div class="form-group">
          <input type="text" name= "title" id = "title" class="form-control " placeholder="Title">
        </div>
        <div class="form-group">
          <input type="text" name= "name"  id = "name" class="form-control " placeholder="Your name">
        </div>
        <div class="form-group">
            <textarea rows="2" class="form-control" id="description" name="comment" >Comment</textarea>
        </div>
        <button class="btn btn-success btn-lg btn-block" id="livePost" type="submit">Post</button>
      </form>
    </div>

    <div class="col-md-5 order-md-1">
      <h4 class="mb-3">Live feed</h4>

      <div class="row justify-content-center">


            <div class="col-md-12 mb-2 card mx-1 text-center">
              <div class="card-body">
                <div class="liveFeed">
                <h5 class="card-title" id="title"></h5>
                <p class="card-text" id="comment"></p>
              </div>
              <div class="card-footer">
                <div class="text-muted" id="name"><h4></h4></div>
              </div>
            </div>



            </div>


      </div>



    </div>

  </div>
</div>

<script>
$(document).ready(function(){

  $("#liveForm").on('submit', function(e){
    e.preventDefault();

     $.ajax ({
             type:"POST",
             url: $(this).attr('action'),
             dataType: "json",
             data: $(this).serialize(),//paima formos inputu reiksmes ir sudeda i viena eilute
             success: function(data){
               console.log(data);
            //  let  info = $.parseJSON(data); - taip klasej dare su Ziviles backu slacke
            //  console.log(info);
              // let cartSize = parseInt($('#cart-size').text());
              // cartSize = cartSize +1;
              // $('#cart-size').text(cartSize);
              // let cartTotal = parseFloat($('#cart-total').text());
              // cartTotal = cartTotal + data;
              // cartTotal = cartTotal.toFixed(2);
              // $('#cart-total').text(cartTotal);


              // let alert = $('<div class="text-center alert alert-success sticky-top" role="alert">');
              //
              //     alert.html('<strong>Succesfully added item to the basket</strong>');
              //     alert.hide();
              //
              //   $('body .alert').fadeOut();
              //   $('body').prepend(alert.fadeIn());
              $(".liveFeed").empty();
              let diva = $("<div class = 'feed' >")
              for (let i = 0; i < data.length; i++) {
                let para = $("<p>");
                let line = $("<a style = 'color:black;'href = "+data[i].href+" class = 'test'></a>");
                para.append(line);
                line.text(`${data[i].name}, ${data[i].title}, ${data[i].comment}`);
                diva.append(para);
                 }
                $(".liveFeed").append(diva);


             },
             error: function(data){
               console.log("eroor");
               console.log(data);
             }
           })
   });






     $("#search").keyup(function(){
       let search = $(this).val();
       if (search.length < 2) {
         $(".results").empty();
         return;
       }
       setTimeout(function(){
         $.ajax ({
           type:"GET",
           url:"restaurants/search",
           dataType: "json",
           data: {name : search},
           success: function(data){
             console.log(data);
             $(".results").empty();
             let diva = $("<div class = 'suggestions' >")
             for (let i = 0; i < data.length; i++) {
               let para = $("<p>");
               let line = $("<a style = 'color:black;' href = "+data[i].href+" class = 'test'></a>");
               para.append(line);
               line.text(`${data[i].network}, ${data[i].adress_line_1}, ${data[i].city}`);
               diva.append(para);
                }
               $(".results").append(diva);
           },
           error: function(data){
           }
         })
       },
     1000);
     });
   });
</script>

@endsection
