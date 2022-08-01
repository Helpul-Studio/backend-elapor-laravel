<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SubordinateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'subordinate',
            'email' => 'subordinate@gmail.com',
            'password' => Hash::make('subordinate1234'),
            'occupation' => 'Subordinate',
            'user_photo' => 'https://cdn-icons-png.flaticon.com/512/892/892781.png?w=360',
            'user_role' => 'subordinate'
        ]);
    }
}
