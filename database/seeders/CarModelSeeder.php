<?php

namespace Database\Seeders;

use App\Models\CarMark;
use App\Models\CarModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CarModelSeeder extends DatabaseSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */


    protected $cars = [
        ['Serie 1', 1],
        ['Serie 3', 1],
        ['Serie 5', 1],
        ['Serie 6', 1],
        ['Serie 7', 1],
        ['X1', 1],
        ['X3', 1],
        ['X5', 1],
        ['X6', 1],
        ['X7', 1],
        ['A Class', 2],
        ['B Class', 2],
        ['C Class', 2],
        ['E Class', 2],
        ['S Class', 2],
        ['G Class', 2],
        ['A1', 3],
        ['A3', 3],
        ['A4', 3],
        ['A5', 3],
        ['A6', 3],
        ['A7', 3],
        ['A8', 3],
        ['Q3', 3],
        ['Q5', 3],
        ['Q7', 3],
        ['2', 4],
        ['3', 4],
        ['5', 4],
        ['6', 4],
        ['CX-3', 4],
        ['CX-5', 4],
        ['CX-7', 4],
        ['Yaris', 5],
        ['Avensis', 5],
        ['Corolla', 5],
        ['Auris', 5],
        ['Rav 4', 5],
        ['Camry', 5],
        ['Land Cruiser', 5],
        ['Aventador', 6],
        ['Urus', 6],
        ['Hurracan', 6],
        ['Golf 2', 7],
        ['Golf 3', 7],
        ['Golf 4', 7],
        ['Golf 5', 7],
        ['Golf 6', 7],
        ['Golf 7', 7],
        ['Golf 8', 7],
        ['Passat B6', 7],
        ['Passat B7', 7],
        ['Passat B8', 7],
        ['Arteon', 7],
        ['Tiguan', 7],
        ['Touareg', 7],
    ];

    public function run()
    {
        for ($i = 0; $i < count($this->cars); $i++) {
            DB::table('car_models')->insert([
                "model" => $this->cars[$i][0],
                "car_mark_id" => $this->cars[$i][1]
            ]);
        }
    }
}
