<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PrioritiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('priorities')->insert([
            'name' => 'Alta'
        ]);

        DB::table('priorities')->insert([
            'name' => 'Media'
        ]);

        DB::table('priorities')->insert([
            'name' => 'Baja'
        ]);
    }
}
