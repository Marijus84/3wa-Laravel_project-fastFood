<?php

namespace App\Http\Controllers;

use App\Review;
use App\Restaurant;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ReviewController extends Controller
{

    public function __construct()
    {
      $this->middleware('auth');
    }

    public function index()
    {

      if(Auth::check() && Auth::user()->role == 'admin'){
        $reviews = Review::all();
      }

      else {

      $id = Auth::user()->id;
      $reviews = Review::where('user_id',$id)->get();
      }

      return view('reviews/index', ['reviews'=> $reviews]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $path = $request->file('image_url')->store('public/dishes');
      $path = str_replace('public', 'storage', $path);

      $this->validation($request);

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
    public function show(Request $request)
    {

    }


    public function edit(review $review)
    {
        return view('reviews/edit', ['review'=>$review]);
    }


    public function update(Request $request, review $review)
    {
      $rules = [
          'review' => 'required',
          'delivery_speed' => 'numeric',
          'cleanliness' => 'numeric',
          'staff' => 'numeric',
          'bathroom_quality' => 'numeric',
          'drive_through' => 'numeric'
      ];

      if($request->file('image_url')) { // Patikriname ar buvo pridėta nuotrauka

          $rules['image_url'] = 'mimes:jpeg,png|max:500'; // Apsirašome nuotraukos
                                                          // validacijos taisyklę
                                                          // ir pridedame į taisyklių masyvą

          $this->validate($request, $rules);
          $this->imgDelete($review->image_url);

          $path = $request->file('image_url')->store('public/dishes');
          $path = str_replace('public', '/storage', $path);

      }
      else { // Jei nebuvo pridėta nuotrauka validuojame standartinėm taisyklėm
          $this->validate($request, $rules);


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
      $this->imgDelete($review->image_url);
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
      $restaurant->update();
    }

    private function validation($request){

            $request->validate([
            'review' => 'required',
            'delivery_speed' => 'numeric',
            'cleanliness' => 'numeric',
            'staff' => 'numeric',
            'bathroom_quality' => 'numeric',
            'drive_through' => 'numeric'
            ]);

    }

    public function imgDelete($url)
    {
      $oldPath = str_replace('storage', '/public', $url);//reikia nurodyt realu kelia
      Storage::delete($oldPath);// pakeiciam is
    }

}
