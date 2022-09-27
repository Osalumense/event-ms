<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use App\Models\User;

class CreateAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $user = [
            [
                'first_name' => 'Super Admin',
                'last_name' => '',
                'gender' => '10',
                'email' => 'admin@ems.com',
                'password' => Hash::make('password'),
                'remember_token' => null,
                'type' => '20',
                'mobile_number' => null,
            ],

            [
                'first_name' => 'Event organizer 1',
                'last_name' => '',
                'gender' => '10',
                'email' => 'user@ems.com',
                'password' => Hash::make('password'),
                'remember_token' => null,
                'type' => '10',
                'mobile_number' => null,
            ],
        ];

        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}
