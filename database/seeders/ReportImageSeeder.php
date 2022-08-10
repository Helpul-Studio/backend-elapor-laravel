<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReportImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('report_images')->insert(
            [
                [
                    'report_id' => 1,
                    'report_documentation' => 'report_documentation/3458trwesuifsu.jpg',
                ],
                [
                    'report_id' => 1,
                    'report_documentation' => 'report_documentation/wrfsfvhsuf89278924.jpg',
                ],
                [
                    'report_id' => 2,
                    'report_documentation' => 'report_documentation/werut89wer7wer89.jpg',
                ],
            ]);
    }
}
