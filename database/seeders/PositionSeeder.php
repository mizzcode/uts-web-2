<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('positions')->insert([
            ['name' => 'Manager', 'description' => 'Manages teams', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Staff', 'description' => 'Operational staff', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
