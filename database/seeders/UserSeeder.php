<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends DatabaseSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */


    public function run()
    {
        DB::table('users')->insert([
            ["first_name" => "Nenad",
                "last_name" => "Lazic",
                "email" => "nenadlazic@gmail.com",
                "password" => md5("nenad123"),
                "location_id" => 1,
                "role_id" => 1,
                "phone" => "0653683833"],
            ["first_name" => "Ivan",
                "last_name" => "Ivanovic",
                "email" => "ivan@gmail.com",
                "password" => md5("sifra123"),
                "location_id" => 2,
                "role_id" => 2,
                "phone" => "0623223654"],
        ]);
    }
}
