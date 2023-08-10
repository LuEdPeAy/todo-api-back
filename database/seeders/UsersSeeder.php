<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Luis Eduardo',
            'last_name' => 'Pérez Ayala',
            'username' => 'admin',
            'password' => Hash::make('password'),
            'created_at' => Carbon::now(),
        ]);
    }
}
