<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\UserModel;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //$age = $faker->randomElement([10,20,30,40,50,60,70,80,90,100]);
        $faker = Faker::create();
        
        for($i=1; $i<=50; $i++){
        	$user = new UserModel;
	        $user->firstName = $faker->firstName;
	        $user->lastName = $faker->lastName;
	        $user->email = $faker->unique()->safeEmail;
	        $user->password = $faker->password;
	        $user->age = $faker->numberBetween($min = 18, $max = 90);
	        $user->dob = now();
	        $user->phoneNumber = $faker->phoneNumber;
	        $user->bio = Str::random(50);
	        $user->save();
        }
    }
}
