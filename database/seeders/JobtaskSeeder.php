<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JobtaskSeeder extends Seeder
{
    /**s
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('jobtasks')->insert(
        [
            [
                'principal' => 2,
                'sector_id' => 2,
                'job_task_name' => 'Mengawal Rombongan Gubernur',
                'job_task_date' => Carbon::create(2022, 8, 17),
                'job_task_place' => 'Ibu Kota Negara Kalimantan',
                'job_task_status' => 'Ditugaskan',
                'job_task_note' => null,
                'job_task_rating' => null
            ],
            [
                'principal' => 2,
                'sector_id' => 4,
                'job_task_name' => 'Menjaga Demo',
                'job_task_date' => Carbon::create(2022, 8, 17),
                'job_task_place' => 'Kantor DPRD Balikpapan',
                'job_task_status' => 'Ditugaskan',
                'job_task_note' => null,
                'job_task_rating' => null
            ],
        ]
    );
    }
}
