<?php

namespace Database\Seeders;

use App\Models\Drivetrain;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DrivetrainSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    private $drivetrains = ["Front wheel Drive", "Rear wheel Drive", "AWD / 4x4"];

    public function run()
    {
        foreach ($this->drivetrains as $drivetrain){
            Drivetrain::create([
               "drivetrain" => $drivetrain
            ]);
        }
    }
}
