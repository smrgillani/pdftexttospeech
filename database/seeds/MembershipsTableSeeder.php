<?php

use App\Membership;
use Illuminate\Database\Seeder;

class MembershipsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        Membership::create([
            'name'              => 'Admin Membership',
            'price'             => 0,
            'voice_type'        => 'Both',
            'characters_length' => 1000000000000000000000000,
            'created_at'        => date('Y-m-d H:i:s'),
            'package_id'        => 1,
        ]);
    }
}
