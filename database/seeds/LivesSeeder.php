<?php

use Illuminate\Database\Seeder;
use App\Live;
use Faker\Factory as Faker;

class LivesSeeder extends Seeder
{

    public function run()
    {
      $faker = Faker::create();

      foreach (range(1,10) as $x) {
      $live = new Live();
      $live->name = $faker->firstname;
      $live->title = $faker->sentence($nbWords = 4, $variableNbWords = true) ;
      $live->comment = $faker->realText($maxNbChars = 200);
      $live->save();
      }
    }
}
