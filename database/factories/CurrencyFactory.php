<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\Currency::class, function (Faker $faker) {
    return [
        'name' => "{$faker->countryCode} dollars",
        'code' => $faker->currencyCode,
    ];
});
