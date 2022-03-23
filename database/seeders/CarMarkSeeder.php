<?php

namespace Database\Seeders;

use App\Models\CarMark;
use App\Models\CarModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CarMarkSeeder extends DatabaseSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    private $carModels = ["BMW", "Mercedes", "Audi", "Mazda", "Toyota", "Lamborghini", "Volkswagen"];

    public function run()
    {
        foreach ($this->carModels as $car) {
            CarMark::create([
               'mark' => $car
            ]);
        }
    }
}
