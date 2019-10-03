<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\Beneficiary::class, function (Faker $faker) {
    return [
        'user_id' => function () {
            return factory(App\Models\User::class)->create()->id;
        },
        'name' => $faker->name,
        'bank_id' => function () {
            return factory(App\Models\Bank::class)->create()->id;
        },
        'account_number' => $faker->bankAccountNumber,
    ];
});
