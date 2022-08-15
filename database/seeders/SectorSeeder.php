<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SectorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sectors')->insert(
        [
            ['sector_name' => 'Sosial Budaya'],
            ['sector_name' => 'Politik'],
            ['sector_name' => 'Ekonomi'],
            ['sector_name' => 'Keamanan'],
            ['sector_name' => 'Kriminal'],
            ['sector_name' => 'Polri'],
            ['sector_name' => 'Masyarakat'],
            ['sector_name' => 'Laka Lantas']
        ]
    );
    }
}
