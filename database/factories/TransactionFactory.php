<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\Transaction::class, function (Faker $faker) {
    return [
        'user_id' => function () {
            return factory(App\Models\User::class)->create()->id;
        },
        'purpose' => $faker->word,
        'source_of_funds' => $faker->word,
        'from_currency' => substr($faker->word, 0, 3),
        'from_amount' => $faker->randomNumber(6),
        'to_currency' => substr($faker->word, 0, 3),
        'to_amount' => $faker->randomNumber(6),
        'beneficiary_id' => function () {
            return factory(App\Models\Beneficiary::class)->create()->id;
        },
    ];
});
