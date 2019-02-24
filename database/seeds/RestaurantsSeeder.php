<?php

use Illuminate\Database\Seeder;
use App\Restaurant;
use App\Review;
use Faker\Factory as Faker;

class RestaurantsSeeder extends Seeder
{

    public function run()
    {
      $faker = Faker::create();

      foreach (range(1,10) as $x) {
      $url=$faker->image('/home/vagrant/Code/fastFood/storage/app/public/restaurant_img', 800, 600, 'abstract');
      $url = str_replace('/home/vagrant/Code/fastFood/storage/app/public','',$url);
      $url = '/storage' . $url;

      $restaurant = new Restaurant();

      $restaurant->network = $faker->company;
      $restaurant->adress_line_1 = $faker->streetAddress;
      $restaurant->city = $faker->City;
      $restaurant->post_code = $faker->postCode;
      $restaurant->phone = $faker->phoneNumber;
      $restaurant->image_url = $url;
      $restaurant->latitude = $faker->latitude($min = 50, $max = 60);
      $restaurant->longitude = $faker->longitude($min = 20, $max = 30);     // 77.147489
      $restaurant->save();
    }
  }
}
