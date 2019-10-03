<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class SuperAdminsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'first_name'          => 'xenon',
                'last_name'           => 'thong',
                'email'               => 'xenonthong@gmail.com',
                'password'            => bcrypt('pass'),
                'verification_status' => 'verified',
            ],
        ];

        foreach ($users as $user) {
            $user = User::forceCreate($user);

            $user->assignRole('super admin');
        }
    }
}
