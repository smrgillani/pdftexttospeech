<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PackageTableSeeder::class);
        $this->call(VoicesTableSeeder::class);
        $this->call(MembershipsTableSeeder::class);
        $this->call(LanguagesTableSeeder::class);
        // $this->call(LanguageVoicesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
    }
}
