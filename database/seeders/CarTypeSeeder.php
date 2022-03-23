<?php

namespace Database\Seeders;

use App\Models\CarType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CarTypeSeeder extends DatabaseSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    private $types = ["Sedan", "SUV", "Wagon", "Coupe", "Hatchback"];

    public function run()
    {
        foreach ($this->types as $type)
        {
            CarType::create([
                "type" => $type
            ]);
        }
    }
}
