<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\User::class, function (Faker $faker) {
    return [
        'first_name'          => $faker->firstName,
        'last_name'           => $faker->lastName,
        'email'               => $faker->safeEmail,
        'verification_status' => $faker->randomElement(\App\Enums\VerificationStatus::toArray()),
        'referral_code'       => Str::random(7),
        'password'            => bcrypt('pass'),
        'remember_token'      => Str::random(10),
    ];
});
