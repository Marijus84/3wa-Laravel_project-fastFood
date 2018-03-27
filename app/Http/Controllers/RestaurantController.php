<?php

namespace App\Http\Controllers;

use App\Restaurant;
use App\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;

class RestaurantController extends Controller
{

    public function __construct()
    {
      $this->middleware('admin')->only('index', 'create', 'destroy', 'edit', 'store');
      //$this->middleware('auth')->only('index');
    }

    public function index()
    {

      $restaurants = Restaurant::get();

      return view('restaurants.index', ['restaurants' => $restaurants]);

    }


    public function map(Request $request)
    {
      $restaurants = Restaurant::get();
      foreach ($restaurants as $restaurant) {
        $restaurant->href = route('restaurants.show', $restaurant->id);
      }

    echo json_encode($restaurants);

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('restaurants/create');
    }


    public function view(Request $request)
    {

      $search = $request->find;
      $restaurants = Restaurant::
      where('network','LIKE', '%'.$search.'%')->
      orWhere('adress_line_1','LIKE', '%'.$search.'%')->
      orWhere('city','LIKE', '%'.$search.'%')->get();

      return view('restaurants/index', ['restaurants'=> $restaurants]);
    }

    public function search(Request $request)
    {
        $search = $request->name;
        $titles = Restaurant::select('network', 'adress_line_1', 'city', 'id')->
        where('network','LIKE', '%'.$search.'%')->
        orWhere('adress_line_1','LIKE', '%'.$search.'%')->
        orWhere('city','LIKE', '%'.$search.'%')->get();
          foreach ($titles as $title) {

            $title->href = route("restaurants.show", $title->id);
          }

        echo json_encode($titles);

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
        $path = $request->file('image_url')->store('public/restaurant_img');
        $path = str_replace('public', 'storage', $path);
      }
      else {
        $path = '/storage/img/logo.jpg';
      }

      $restaurant = new Restaurant();
      $restaurant->network = $request->network;
      $restaurant->adress_line_1 = $request->adress_line_1;
      $restaurant->city = $request->city;
      $restaurant->post_code = $request->post_code;
      $restaurant->phone = $request->phone;
      $restaurant->longitude = $request->longitude;
      $restaurant->latitude = $request->latitude;
      $restaurant->image_url = $path;

      $restaurant->save();


      return redirect()->route('restaurants.index');
    }


    public function show(Restaurant $restaurant)
    {
      foreach ($restaurant->review as $review) {

        $review->posted = $review->updated_at->diffForHumans();


      }
      $restaurant->review = $restaurant->review->sortByDesc('updated_at');
      return view('restaurants/show', ['restaurant'=> $restaurant]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function edit(restaurant $restaurant)
    {
      return view('restaurants/edit', ['restaurant'=>$restaurant]);
    }


    public function update(Request $request, restaurant $restaurant)
    {
      $this->validation($request);


      if($request->file('image_url')) { // Patikriname ar buvo pridėta nuotrauka

         // Apsirašome nuotraukos
        // validacijos taisyklę
        // ir pridedame į taisyklių masyvą
        if ($restaurant->image_url!=='/storage/img/logo.jpg') {

          $this->imgDelete($restaurant->image_url);
        }

        $path = $request->file('image_url')->store('public/restaurant_img');
        $path = str_replace('public', '/storage', $path);

        }
        else { // Jei nebuvo pridėta nuotrauka validuojame standartinėm taisyklėm
        $path = $restaurant->image_url; // $path prilyginam seno produkto nuotraukos URL'ui
        }


      $restaurant->network = $request->network;
      $restaurant->adress_line_1 = $request->adress_line_1;
      $restaurant->city = $request->city;
      $restaurant->post_code = $request->post_code;
      $restaurant->phone = $request->phone;
      $restaurant->longitude = $request->longitude;
      $restaurant->latitude = $request->latitude;
      $restaurant->image_url = $path;

      $restaurant->update();


      //  $request->session()->flash('positive', 'You have edited dish info!');

        return redirect()->route('restaurants.index');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function destroy(restaurant $restaurant)
    {

      if ($restaurant->image_url!=='/storage/img/logo.jpg') {

        $this->imgDelete($restaurant->image_url);

      }
      $restaurant->delete();
      return redirect()->route('restaurants.index');
    }

    private function validation(Request $request){

      $request->validate([ // reikia derint su migracijom
      'network' => 'required|max:300',//iki 300 simboliu
      'adress_line_1' => 'required|max:300',
      'city' => 'required|max:300',
      'post_code' => 'required|numeric',
      'longitude' => 'required|numeric',
      'latitude' => 'required|numeric',
      'phone' => 'required|max:300',
      'image_url' => 'mimes:jpeg,png|max:3000'
      ]);
    }

    public function imgDelete($url)
    {
      $oldPath = str_replace('storage', '/public', $url);//reikia nurodyt realu kelia
      Storage::delete($oldPath);// pakeiciam is
    }

}
