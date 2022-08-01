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
            'name' => 'principal',
            'email' => 'principal@gmail.com',
            'password' => Hash::make('principal1234'),
            'occupation' => 'Principal',
            'user_photo' => 'https://cdn-icons-png.flaticon.com/512/892/892781.png?w=360',
            'user_role' => 'principal'
        ]);
    }
}
