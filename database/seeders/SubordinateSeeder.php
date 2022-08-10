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
        [
            'name' => 'Pardi Mandala',
            'nrp' => 35040356,
            'password' => Hash::make('subordinate1234'),
            'occupation' => 'Brigpol',
            'user_photo' => 'user_photo/subordinate.jpg',
            'user_role' => 'subordinate'
        ],
        [
            'name' => 'Prayoga Ramadhan',
            'nrp' => 35040116,
            'password' => Hash::make('subordinate1234'),
            'occupation' => 'Brigadir',
            'user_photo' => 'user_photo/subordinate.jpg',
            'user_role' => 'subordinate'
        ],
        [
            'name' => 'Kurniawan Radika',
            'nrp' => 353970356,
            'password' => Hash::make('subordinate1234'),
            'occupation' => 'Bripda',
            'user_photo' => 'user_photo/subordinate.jpg',
            'user_role' => 'subordinate'
        ],
        ]);
    }
}
