<?php

namespace App\Users;

use App\Enums\VerificationStatus;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CustomerFactory
{
    public static function make(array $data)
    {
        $notUnique = true;

        while ($notUnique) {
            $code      = Str::upper(Str::random(8));
            $notUnique = User::where('referral_code', $code)->exists();
        }

        $user = User::create([
            'first_name'          => $data['first_name'],
            'last_name'           => $data['last_name'],
            'email'               => $data['email'],
            'password'            => Hash::make($data['password']),
            'referral_code'       => $code,
            'verification_status' => (string)VerificationStatus::UNVERIFIED(),
        ]);

        $user->profile(new Profile())->create();

        return $user;
    }
}