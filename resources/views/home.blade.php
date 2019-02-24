@extends('layouts.app')

@section('content')



  <div id="sectionIntro" >

  <div class="content text-center">

      <div class="row mb-4 justify-content-center">
        <div class="col-md-6">
        <form action="{{route('restaurants.view')}}" class = "mt-5" method="GET">
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
      <div class="row justify-content-center" >
        <div class="col-md-6 " >

        <h1 id = "logo" >fastFood Guru</h1>
        <h2 class = "underLogo">Rate fastFood places<br>It's important where you eat!</h2>
        </div>
      </div>
      <div class="row justify-content-center">
        <div class="col-md-4">

          <div class="results">
          </div>

          </div>

      </div>


  </div>
</div>

  </header>


  <div id="map"></div>
  <main>

  <div class="container" > <a name = "contStart"></a>
    <div id = "promptdiv" class= "alert-success text-center sticky-top" role = "alert">

    </div>
    <div id = "promptAlert" class= "alert-danger text-center sticky-top" role = "alert">

    </div>


  <div class="row justify-content-center">


    <div class="col-md-4 mb-2  mx-1 text-center justify-content-center">
      <h4 class="my-3">Add Live Comment</h4>

      <form onload = "getFeed();" action="{{route('lives.store')}}" id = "liveForm" method="GET">
        @csrf
        <div class="form-group">
          <input type="text" name= "title" id = "title" class="form-control " placeholder="Title">
        </div>
        <div class="form-group">
          <input type="text" name= "name"  id = "name" class="form-control" placeholder="Your name">
        </div>
        <div class="form-group">
          <textarea rows="2" class="form-control" id="description" name="comment" placeholder="Your Comment"></textarea>
        </div>
        <button class="btn btn-success btn-lg btn-block mb-2" id="livePost" type="submit">Post</button>
      </form>

      <form action="#" id="loadReviews" method="GET">
        @csrf
      </form>


    </div>


  </div>

  <div class="row justify-content-center">

    <div class="card-columns" id= "liveStream">

    </div>

    </div>

    <div class="row justify-content-center">
      <div class="col-md-3">
        <button class="btn btn-info btn-lg btn-block mt-4" id="loadMoreFeed" type="submit">Load more</button>
      </div>
      <div class="col-md-3">
        <button class="btn btn-info btn-lg btn-block mt-4" id="loadLessFeed" type="submit">Show less</button>
      </div>
    </div>
    <hr>

<div class="row justify-content-center">
    <div class="card-columns" id="reviewsCards">

      <div class="card">
        <img class="card-img-top" src="/storage/review_img/5e80d34bcf0160d4da79e3fca785e9db.jpg" alt="Card image cap">
        <div class="card-body">
          <h5 class="card-title">restaurant title</h5>
          <h5 class="card-title">adress line1 + city</h5>
          <p class="card-text">Staff</p>
          <p class="card-text">Delivery speed</p>
          <p class="card-text">Cleanliness</p>
          <p class="card-text">Bathroom quality</p>
          <p class="card-text">Drive through</p>
          <p class="card-text">Review</p>
        </div>
        <div class="card-footer">

          <p class="card-text"><small class="text-muted">name + diff for humans</small></p>
        </div>
      </div>


    </div>
</div>


        <div class="row justify-content-center">
          <div class="col-md-3">
            <button class="btn btn-info btn-lg btn-block mt-4" id="loadMoreReviews" type="submit">Load more</button>
          </div>
          <div class="col-md-3">
            <button class="btn btn-info btn-lg btn-block mt-4 mb-50" id="loadLessReviews" type="submit">Show less</button>
          </div>
        </div>
        <hr>

      </div>

  </div>
</div>

</div>


<script>

var loadLives = 6;
var loadReviews = 6;

//$("body").css("overflow", "hidden");






function getFeed(info){

  if (!info) {
   info = "_token="+ $('[name="_token"]').val()+'&loadLives='+loadLives;
  }

   $.ajax ({
           type:"POST",
           url: "lives",
           dataType: "json",
           data: info,//paima formos inputu reiksmes ir sudeda i viena eilute
           success: function(data){
             // if (data.length < loadLives) {
             //   let alert = $('#prompt');
             //   alert.text("You can see all messages");
             //   alert.addClass("py-4");
             //   $('#promptdiv').animate({
             //     opacity: 0,
             //   }, 6000);
             // }
             if ((data.length) < loadLives) {

             let alert = $('#prompt');
             $("#loadMoreFeed").hide();
             alert.empty();

             let alertError = $('#promptAlert');

             alertError.empty();
             headInAlertError = $('<h2 id = "promptError" ></h2>');
             headInAlertError.text("There are no more messages");
             headInAlertError.addClass("py-4");
             alertError.append(headInAlertError);
             $('#promptAlert').animate({
               opacity: 0,
             }, 5000);

             }

            $("#liveStream").empty();
            let diva = $("#liveStream")



            for (let i = 0; i < data.length; i++) {
              let start = $('<div class="card text-center">')
              let img = $( '<img class="card-img-top mt-4 live-img" style="max-height:40px; width:auto; margin:0 auto" src="" alt="Card image cap">');
              img.attr('src','/storage/img/live.png');
              let title = $('<div class="card-body x2"><h5 class="card-title"></h5>');
              title.text(data[i].title);
              let comment = $('<p class="card-text"></p></div>');
              comment.text(data[i].comment);
              let name = $('<div class="card-footer x2"><p class="card-text"></p>');
              name.text(data[i].name);
              let posted = $('<p class="card-text timeColor"></p></div></div>');
              posted.text("Posted " +data[i].posted);
              start.append(img);
              start.append(title);
              start.append(comment);
              start.append(name);
              start.append(posted);

              diva.append(start);
              // $(window).scrollTop(pix);

               }

              $("#liveStream").append(diva);
              $('.live-img, #nextSection').animate({
              opacity: 0.3,
            }, 1000);
              $('.live-img, #nextSection').animate({
              opacity: 1,
            },1000);

           },
           error: function(data){

           }
         })
 }


function getReviews(){

   $.ajax ({
           type:"POST",
           url: "reviews/load",
           dataType: "json",
           data: "_token="+ $('[name="_token"]').val()+'&loadReviews='+loadReviews,
           success: function(data){




             $("#reviewsCards").empty();
             let divb = $("#reviewsCards");
             for (let i = 0; i < data.length; i++){
               let start = $('<div class="card text-center">')
               let img = $( '<img class="card-img-top rest-img" src="" alt="Card image cap"><div class="card-body">');
               img.attr('src',data[i].image_url);
               let title = $('<a href = '+data[i].href+' class="card-title name"></a>');

               title.text(data[i].restaurant.network);
               let adress = $('<p class="card-text"></p>');
               adress.text(data[i].restaurant.adress_line_1 + data[i].restaurant.city);
               let staff = $('<p class="card-text x2"></p>');
               staff.text("Staff: " +data[i].staff);
               let deliverySpeed = $('<p class="card-text x2"></p>');
               deliverySpeed.text("Delivery Speed: " + data[i].delivery_speed);
               let bathroomQuality = $('<p class="card-text x2"></p>');
               bathroomQuality.text("Bathroom Quality: " + data[i].bathroom_quality);
               let cleanliness = $('<p class="card-text x2"></p>');
               cleanliness.text("Cleanliness: " + data[i].cleanliness);
               let driveThrough = $('<p class="card-text x2"></p>');
               driveThrough.text("Drive Through: " + data[i].drive_through);
               let review = $('<p class="card-text"></p></div>');
               review.text(data[i].review);
               let name = $('<div class="card-footer x2"><p class="card-text"></p>');
               name.text(data[i].user.name+' '+data[i].user.surname);
               let posted = $('<p class="card-text timeColor"></p></div></div>');
               posted.text("Posted " +data[i].posted);

               start.append(img);
               start.append(title);
               start.append(adress);
               start.append(staff);
               start.append(deliverySpeed);
               start.append(bathroomQuality);
               start.append(cleanliness);
               start.append(driveThrough);
               start.append(review);
               start.append(name);
               start.append(posted);
               divb.append(start);

             }
             $(".card-columns").append(divb);




           },
           error: function(data){

           }
         })
 }


// var pix;
//
//
//  $("#loadMoreFeed").on('click', function(e){
//    e.preventDefault();
//    pix = ($(document).height() - $(window).scrollTop());
//    console.log($(document).height());
//  }
// );



$(document).ready(function(){





  $("#nextSection").on('click', function(e){
    $("body").css("overflow", "auto");
    }
  );


  setInterval(getFeed,5000);

  $("#livePost").on('click', function(e){
    e.preventDefault();
    let data = $("#liveForm").serialize()+'&loadLives='+loadLives;
    getFeed(data)}
  );

  $("#loadMoreFeed").on('click', function(e){
    e.preventDefault();
    loadLives += 4;



                   let alert = $('#promptdiv');
                   alert.css('opacity',1);
                   alert.empty();
                   headInAlert = $('<h2 id = "prompt" ></h2>');
                   headInAlert.text("You have loaded more live messages");
                   headInAlert.addClass("py-4");
                   alert.append(headInAlert);
                   $('#promptdiv').animate({
                     opacity: 0,
                   }, 5000);


    getFeed()}
  );

  $("#loadLessFeed").on('click', function(e){
    e.preventDefault();
    loadLives -= 4;
    if (loadLives < 2) {
      loadLives = 2;
      alert('Minimum aloud amount of messages is 2')
    }
    getFeed()}
      );

  $("#loadMoreReviews").on('click', function(e){
    e.preventDefault();

    loadReviews += 4;
    getReviews()}
  );

  $("#loadLessReviews").on('click', function(e){
    e.preventDefault();

    loadReviews -= 4;
    if (loadReviews < 2) {
      loadReviews = 2;
      alert('Minimum aloud amount of reviews is 2')
    }
    getReviews()}
 );


     $("#search").keyup(function(){
       let search = $(this).val();
       if (search.length < 2) {
         $(".results").empty();
           $("#logo, .underLogo").show();
         return;
       }
       setTimeout(function(){
         $.ajax ({
           type:"GET",
           url:"restaurants/search",
           dataType: "json",
           data: {name : search},
           success: function(data){

             $(".results").empty();
             let diva = $("<div class = 'suggestions' >")
             for (let i = 0; i < data.length; i++) {
               let para = $("<p>");
               let line = $("<a style = 'color:black;' id= 'results' href = "+data[i].href+" class = 'test'></a>");
               para.append(line);
               line.text(`${data[i].network}, ${data[i].adress_line_1}, ${data[i].city}`);
               diva.append(para);
                }
               $(".results").append(diva);

              if ($(".results").text() !== "") {
                $("#logo,.underLogo").hide();
              }

           },
           error: function(data){
           }
         })
       },
     1000);
     });
   });
</script>

<script type="text/javascript">

function initMap() {

var restaurant = [];


  $.ajax ({
          type:"POST",
          url: "restaurants/map",
          dataType: "json",
          data: "_token="+ $('[name="_token"]').val(),
          success: function(data){


            for (let i = 0; i < data.length; i++) {

              restaurant[i] ={lat: data[i].latitude,
                              lng: data[i].longitude}
                            };




            var map = new google.maps.Map(document.getElementById('map'), {
              zoom: 5,
              center: restaurant[0]
            });

            var marker = [];
            for (let i = 0; i < restaurant.length; i++) {
               marker[i] = new google.maps.Marker({
                position: restaurant[i],
                url: data[i].href,
                map: map
              })

              google.maps.event.addListener(marker[i], 'click', function() {
                window.location.href = this.url;
              });
            }





            //
            // let divb = $("#reviewsCards");
            // for (let i = 0; i < data.length; i++){
            //   let start = $('<div class="card text-center">')
            //   let img = $( '<img class="card-img-top" src="" alt="Card image cap">');
            //   img.attr('src',data[i].image_url);
            //   let title = $('<div class="card-body"><h5 class="card-title">Test title</h5>');
            //
            //  title.text(data[i].restaurant.network);
            //   let adress = $('<h5 class="card-title"></h5>');
            //   adress.text(data[i].restaurant.adress_line_1 + data[i].restaurant.city);
            //   let staff = $('<p class="card-text"></p>');
            //   staff.text(data[i].staff);
            //   let deliverySpeed = $('<p class="card-text"></p>');
            //   deliverySpeed.text(data[i].delivery_speed);
            //   let bathroomQuality = $('<p class="card-text"></p>');
            //   bathroomQuality.text(data[i].bathroom_quality);
            //   let cleanliness = $('<p class="card-text"></p>');
            //   cleanliness.text(data[i].cleanliness);
            //   let driveThrough = $('<p class="card-text"></p>');
            //   driveThrough.text(data[i].drive_through);
            //   let review = $('<p class="card-text"></p></div>');
            //   review.text(data[i].review);
            //   let name = $('<div class="card-footer"><p class="card-text"></p>');
            //   name.text(data[i].user.name+' '+data[i].user.surname);
            //   let posted = $('<p class="card-text"></p></div></div>');
            //   posted.text("Posted " +data[i].posted);
            //
            //   start.append(img);
            //   start.append(title);
            //   start.append(adress);
            //   start.append(staff);
            //   start.append(deliverySpeed);
            //   start.append(bathroomQuality);
            //   start.append(cleanliness);
            //   start.append(driveThrough);
            //   start.append(review);
            //   start.append(name);
            //   start.append(posted);
            //   divb.append(start);
            //
            // }
            // $(".card-columns").append(divb);




          },
          error: function(data){

          }
        })


         // var uluru = {lat: -25.363, lng: 131.044};
         // console.log(uluru);
         // console.log(typeof(uluru));
        // var uluru2 = {lat: 25.363, lng: 131.044};


        // var marker = new google.maps.Marker({
        //   position: ,
        //   map: map
        // })
        // var marker2 = new google.maps.Marker({
        //   position: uluru2,
        //   map: map
        // });



  }




</script>
<script async defer
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyArpRkOLMUvoMfYqVRC_DEoeG6w4mPvwKU&callback=initMap">
</script>
@endsection
