<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Ayu Utami',
            'email' => 'ayuutami@gmail.com',
            'nrp' => 95040358,
            'password' => Hash::make('admin1234'),
            'occupation' => 'Aipda',
            'user_photo' => 'user_photo/admin.jpeg',
            'user_role' => 'admin'
        ]);
    }
}
