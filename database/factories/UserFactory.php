<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
//for client
    // return [
    //     'first_name' => $faker->firstName($gender = 'male'|'female'),
    //     'last_name' => $faker->lastName ,
    //     'email' => $faker->unique()->safeEmail,
    //     'gender' => 'male',
    //     'role_id' => 1,
    //     'Avatar' =>  $faker->imageUrl($width = 640, $height = 480),
    //     'phone' =>  $faker->phoneNumber,
    //     'address'=> $faker->address,
    //    'city'=> $faker->city,
    //    'state'=> $faker->state,
    //    'zip'=> $faker->postcode,
    //    'country'=> $faker->country,
    //    'joining_date'=> $faker->dateTimeThisYear->format('Y-m-d'),
    //    'is_deleted'=> 0,
    //    'is_approved'=> 0,
    //    'exp_level'=> 0,
    //    'bio'=> $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
    //    'created_at'=> $faker->dateTimeThisYear->format('Y-m-d'),
    //    'updated_at'=> $faker->dateTimeThisYear->format('Y-m-d'),
    //     'password' => bcrypt('12345678'),
    //     'remember_token' => str_random(10),
    // ];
    //for client manager
      return [
        'first_name' => $faker->firstName($gender = 'male'|'female'),
        'last_name' => $faker->lastName ,
        'email' => $faker->unique()->safeEmail,
        'gender' => 'male',
        'role_id' => 2,
        'Avatar' =>  $faker->imageUrl($width = 58, $height = 58),
        'phone' =>  $faker->phoneNumber,
        'address'=> $faker->address,
       'city'=> $faker->city,
       'state'=> $faker->state,
       'zip'=> $faker->postcode,
       'country'=> $faker->country,
       'joining_date'=> $faker->dateTimeThisCentury->format('Y-m-d'),
       'is_deleted'=> 0,
       'is_approved'=> 1,
       'exp_level'=> 0,
       'bio'=> $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
       'created_at'=> $faker->dateTimeThisCentury->format('Y-m-d'),
       'updated_at'=> $faker->dateTimeThisCentury->format('Y-m-d'),
        'password' => bcrypt('12345678'),
        'remember_token' => str_random(10),
    ];
    //for hr
    //   return [
    //     'first_name' => $faker->firstName($gender = 'male'|'female'),
    //     'last_name' => $faker->lastName ,
    //     'email' => $faker->unique()->safeEmail,
    //     'gender' => 'male',
    //     'role_id' => 3,
    //     'Avatar' =>  $faker->imageUrl($width = 640, $height = 480),
    //     'phone' =>  $faker->phoneNumber,
    //     'address'=> $faker->address,
    //    'city'=> $faker->city,
    //    'state'=> $faker->state,
    //    'zip'=> $faker->postcode,
    //    'country'=> $faker->country,
    //    'joining_date'=> $faker->dateTimeThisCentury->format('Y-m-d'),
    //    'is_deleted'=> 0,
    //    'is_approved'=> 1,
    //    'exp_level'=> 0,
    //    'bio'=> $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
    //    'created_at'=> $faker->dateTimeThisCentury->format('Y-m-d'),
    //    'updated_at'=> $faker->dateTimeThisCentury->format('Y-m-d'),
    //     'password' => bcrypt('12345678'),
    //     'remember_token' => str_random(10),
    // ];
});
