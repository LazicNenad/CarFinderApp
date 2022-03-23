<?php

namespace Database\Seeders;

use App\Models\Car;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    private $cars = [
        [2,"Mercedes GLS63 AMG", 16, 2, 1, 2, 3, "Mercedes nov GLS63, za vise informacija pozvati!", 2022, "New", "Automatic", "0", "125000"],
        [1,"BMW M5 Competition", 3, 1, 1, 2, 3, "BMW M5 Competition. Pozvati za vise informacija", 2022, "New", "Automatic", "0", "145000"],
        [1,"BMW 320D", 2, 1, 2, 1, 2, "Bmw 320 dobro stanje. Uradjeni servisi", 2013, "Used", "Manual", "244233", "11252"],
        [3,"Audi a4", 19, 1, 2, 1, 1, "Audi a4 odlicno stanje.... Audi a4 odlicno stanje....", 2012, "Used", "Manual", "175000", "12000"],
    ];

    public function run()
    {

        for($i = 0; $i < count($this->cars); $i++){
            Car::create([
                "car_mark_id" => $this->cars[$i][0],
                "title" => $this->cars[$i][1],
                "car_model_id" => $this->cars[$i][2],
                "car_type_id" => $this->cars[$i][3],
                "gas_id" => $this->cars[$i][4],
                "user_id" => $this->cars[$i][5],
                "drivetrain_id" => $this->cars[$i][6],
                "description" => $this->cars[$i][7],
                "year" => $this->cars[$i][8],
                "new" => $this->cars[$i][9],
                "transmission" => $this->cars[$i][10],
                "mileage" => $this->cars[$i][11],
                "price" => $this->cars[$i][12]
            ]);
        }


    }
}
