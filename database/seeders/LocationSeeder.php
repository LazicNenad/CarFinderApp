<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    private $locations = ["Belgrade", "Pancevo", "Subotica", "Nis", "Kragujevac", "Novi Sad"];

    public function run()
    {
        foreach ($this->locations as $location){
            Location::create([
                'location' => $location
            ]);
        }
    }
}
