<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\Profile::class, function (Faker $faker) {
    return [
        'user_id' => function () {
            return factory(App\Models\User::class)->create()->id;
        },
        'dob' => $faker->date(),
        'nationality' => $faker->word,
        'contact_number' => $faker->word,
    ];
});
