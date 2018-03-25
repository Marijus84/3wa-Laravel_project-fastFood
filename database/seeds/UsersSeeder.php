<?php

use Illuminate\Database\Seeder;
use App\User;
use Faker\Factory as Faker;


class UsersSeeder extends Seeder
{

    public function run()
    {
        $faker = Faker::create();

        $user = new User();
        $user->name =$faker->firstname;
        $user->surname =$faker->lastName;
        $user->email ='admin@admin.lt';
        $user->password =\Hash::make('admin');
        $user->role ='admin';
        $user->save();

        foreach (range(1,10) as $i) {
          $user = new User();
          $user->name =$faker->firstname;
          $user->surname =$faker->lastName;
          $user->email =$faker->email;
          $user->password =\Hash::make('guest');
          $user->role ='guest';
          $user->save();
        }

    }
}
