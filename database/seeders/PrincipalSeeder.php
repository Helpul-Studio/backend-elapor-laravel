<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PrincipalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Dadi Nugroho',
            'nrp' => 95040345,
            'password' => Hash::make('principal1234'),
            'occupation' => 'AKBP',
            'user_photo' => 'user_photo/principal.jpg',
            'user_role' => 'principal'
        ]);
    }
}
