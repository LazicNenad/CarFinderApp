<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends DatabaseSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    protected $role = [
      "Admin", "User"
    ];

    public function run()
    {
        for($i = 0; $i < count($this->role); $i++)
        {
            DB::table('roles')->insert([
               "role" => $this->role[$i]
            ]);
        }
    }
}
