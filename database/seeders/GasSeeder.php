<?php

namespace Database\Seeders;

use App\Models\Gas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GasSeeder extends DatabaseSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    private $gas = ["Petrol", "Diesel", "Electric", "Hybrid"];

    public function run()
    {
        foreach ($this->gas as $gas){
            Gas::create([
               'gas' => $gas
            ]);
        }
    }
}
