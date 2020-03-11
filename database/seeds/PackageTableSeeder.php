<?php

use App\Package;
use Illuminate\Database\Seeder;

class PackageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $data = [
            "title"             => "Package 1",
            "description"       => "Test Description",
            "price"             => 150,
            "rebill_commission" => 5,
            "rebill_price"      => 160,
            "sku"               => 1,
        ];
        Package::insert($data);
    }
}
