<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        if(config('app.env') === 'local') {
            $this->call(UserSeeder::class);
        }

        $this->call(DrivingLicenseTypeSeeder::class);
    }
}
