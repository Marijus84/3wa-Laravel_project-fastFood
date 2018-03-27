<?php

namespace App\Http\Controllers;

use App\Review;
use App\Restaurant;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ReviewController extends Controller
{

    public function __construct()
    {

      $this->middleware('auth')->except('load');
    }

    public function index()
    {

      if(Auth::check() && Auth::user()->role == 'admin'){
        $reviews = Review::all();
        foreach ($reviews as $review) {
          $review->posted = $review->updated_at->diffForHumans();
        }
      }

      else {

      $id = Auth::user()->id;
      $reviews = Review::where('user_id',$id)->get();
      foreach ($reviews as $review) {
        $review->posted = $review->updated_at->diffForHumans();
      }
      }

      return view('reviews/index', ['reviews'=> $reviews]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function load(Request $request)
    {
      $reviews = Review::orderBy('created_at', 'desc')->take($request->loadReviews)->get();
      foreach ($reviews as $review) {
        $review->restaurant = Restaurant::select('network','adress_line_1','city','id')->where('id', $review->restaurant_id)->first();
        $review->user = User::select('name','surname')->where('id', $review->user_id)->first();
        $review->posted = $review->updated_at->diffForHumans();

        $review->href = route('restaurants.show', $review->restaurant->id);


      }
    echo json_encode($reviews);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


      $this->validation($request);

      if ($request->file('image_url')) {
        $path = $request->file('image_url')->store('public/review_img');
        $path = str_replace('public', 'storage', $path);
      }
      else {
        $path = '/storage/img/logo.jpg';
      }


      $review = new Review();
      $review->restaurant_id = $request->restaurant_id;
      $review->image_url = $path;
      $review->user_id = Auth::user()->id;
      $review->delivery_speed = $request->delivery_speed;
      $review->cleanliness = $request->cleanliness;
      $review->staff = $request->staff;
      $review->bathroom_quality = $request->bathroom_quality;
      $review->drive_through = $request->drive_through;
      $review->review = $request->review;
      $review->save();

      $this->updateFields($request);

      return redirect()->route('restaurants.show', $request->restaurant_id);




    }

    /**
     * Display the specified resource.
     *
     * @param  \App\review  $review
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Review $review)
    {

      return view('reviews/show', ['review'=> $review]);
    }


    public function edit(review $review)
    {
        return view('reviews/edit', ['review'=>$review]);
    }


    public function update(Request $request, review $review)
    {

      $this->validation($request);

      if($request->file('image_url')) { // Patikriname ar buvo pridėta nuotrauka

           // Apsirašome nuotraukos
                                                          // validacijos taisyklę
                                                          // ir pridedame į taisyklių masyvą

            if ($review->image_url!=='/storage/img/logo.jpg') {

              $this->imgDelete($review->image_url);
            }

            $path = $request->file('image_url')->store('public/review_img');
            $path = str_replace('public', '/storage', $path);

      }
      else { // Jei nebuvo pridėta nuotrauka validuojame standartinėm taisyklėm
          $path = $review->image_url; // $path prilyginam seno produkto nuotraukos URL'ui
      }

      $review->restaurant_id = $request->restaurant_id;
      $review->image_url = $path;
      $review->user_id = Auth::user()->id;
      $review->delivery_speed = $request->delivery_speed;
      $review->cleanliness = $request->cleanliness;
      $review->staff = $request->staff;
      $review->bathroom_quality = $request->bathroom_quality;
      $review->drive_through = $request->drive_through;
      $review->review = $request->review;
      $review->save();

      $this->updateFields($request);

      return redirect()->route('restaurants.show', $request->restaurant_id);

    }


    public function destroy(review $review, Request $request)
    {



      if ($review->image_url!=='/storage/img/logo.jpg') {

        $this->imgDelete($review->image_url);

      }
      $review->delete();


      $this->updateFields($request);
      return redirect()->route('restaurants.show', $request->restaurant_id);

    }

    private function updateFields($request){
      $restaurant = Restaurant::where('id', $request->restaurant_id)->first();
      $restaurant->avg_staff = Review::where('restaurant_id', $request->restaurant_id)->avg('staff');
      $restaurant->avg_delivery_speed = Review::where('restaurant_id', $request->restaurant_id)->avg('delivery_speed');
      $restaurant->avg_cleanliness = Review::where('restaurant_id', $request->restaurant_id)->avg('cleanliness');
      $restaurant->avg_bathroom_quality = Review::where('restaurant_id', $request->restaurant_id)->avg('bathroom_quality');
      $restaurant->avg_drive_through = Review::where('restaurant_id', $request->restaurant_id)->avg('drive_through');
      $restaurant->avg_overall =  collect([$restaurant->avg_staff,$restaurant->avg_delivery_speed,$restaurant->avg_cleanliness,$restaurant->avg_bathroom_quality,   $restaurant->avg_drive_through ])->avg();
      $restaurant->update();
    }

    private function validation($request){

            $request->validate([
            'review' => 'required',
            'delivery_speed' => 'numeric',
            'cleanliness' => 'numeric',
            'staff' => 'numeric',
            'bathroom_quality' => 'numeric',
            'drive_through' => 'numeric',
            'image_url' => 'mimes:jpeg,png|max:3000'
            ]);

    }

    public function imgDelete($url)
    {
      $oldPath = str_replace('storage', 'public', $url);//reikia nurodyt realu kelia
      //dd($oldPath);
      Storage::delete($oldPath);// pakeiciam is
    }

}
