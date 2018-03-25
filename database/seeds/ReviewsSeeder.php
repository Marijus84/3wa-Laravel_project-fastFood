<?php

use Illuminate\Database\Seeder;
use App\Review;
use Faker\Factory as Faker;


class ReviewsSeeder extends Seeder
{

    public function run()
    {
      $faker = Faker::create();

      foreach (range(1,10) as $x) {
        $url=$faker->image('/home/vagrant/Code/fastFood/storage/app/public/review_img', 800, 600, 'abstract');
        $url = str_replace('/home/vagrant/Code/fastFood/storage/app/public','',$url);
        $url = '/storage' . $url;

        $review = new Review();
        $review->restaurant_id = $x;
        $review->user_id = $x;
        $review->delivery_speed = rand(0,10);
        $review->cleanliness = rand(0,10);
        $review->staff = rand(0,10);
        $review->bathroom_quality = rand(0,10);
        $review->drive_through = rand(0,10);
        $review->image_url = $url;
        $review->review = $faker->realText($maxNbChars = 300);
        $review->save();

      }
    }
}
