<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tags')->insert([
            'name' => 'Compras',
            'user_id' => 1,
        ]);

        DB::table('tags')->insert([
            'name' => 'Tareas',
            'user_id' => 1,
        ]);

        DB::table('tags')->insert([
            'name' => 'Por hacer',
            'user_id' => 1,
        ]);
    }
}
