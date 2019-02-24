<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $this->call(LivesSeeder::class);
      $this->call(UsersSeeder::class);
      $this->call(RestaurantsSeeder::class);
      $this->call(ReviewsSeeder::class);
    }
}
