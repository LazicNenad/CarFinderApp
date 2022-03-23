<?php

namespace Database\Seeders;

use App\Models\CarMark;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            CarMarkSeeder::class,
            LocationSeeder::class,
            DrivetrainSeeder::class,
            CarTypeSeeder::class,
            GasSeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
            CarModelSeeder::class,
            CarSeeder::class,
            CarImageSeeder::class,
        ]);
    }
}
