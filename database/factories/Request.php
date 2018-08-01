<?php

use Faker\Generator as Faker;

$factory->define(App\ClientRequest::class, function (Faker $faker) {
    return [
        'client_id' => $faker->numberBetween($min = 1, $max = 8),
        'cm' => $faker->numberBetween($min = 1, $max = 2),
        'service_id' => $faker->numberBetween($min = 1, $max = 2),
        'service_id' => 0,
        'service_id' => 0,
    ];
});
