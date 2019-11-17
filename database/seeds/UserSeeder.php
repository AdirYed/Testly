<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'first_name' => 'מתן',
            'last_name' => 'ידייב',
            'email' => 'matan.yed@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('secret'),
            'role' => 'user',
        ]);
    }
}
