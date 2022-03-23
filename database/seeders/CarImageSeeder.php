<?php

namespace Database\Seeders;

use App\Models\CarImage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CarImageSeeder extends DatabaseSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    private $data = [
        [4, "audia4-1.jpg"],
        [4, "audia4-2.jpg"],
        [4, "audia4-3.jpg"],
        [3, "bmw3-1.jpg"],
        [3, "bmw3-2.jpg"],
        [3, "bmw3-3.jpg"],
        [1, "mercedesg-1.jpg"],
        [1, "mercedesg-2.jpg"],
        [1, "mercedesg-3.jpg"],
        [1, "mercedesg-4.jpg"],
        [2, "bmwm5-1.jpg"],
        [2, "bmwm5-2.jpg"],
        [2, "bmwm5-3.jpg"],
        [2, "bmwm5-4.jpg"],
    ];

    public function run()
    {
        for($i = 0; $i < count($this->data); $i++)
        {
            CarImage::create([
               "car_id" => $this->data[$i][0],
               "image" => $this->data[$i][1]
            ]);
        }
    }
}
