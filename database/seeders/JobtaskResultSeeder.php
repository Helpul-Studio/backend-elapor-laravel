<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JobtaskResultSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('jobtask_results')->insert(
        [
            [
                'job_task_id' => 1,
                'subordinate' => 3,
                'location_latitude' =>  -1.2598389,
                'location_longitude' => 116.8697653,
                'jobtask_documentation' => 'jobtask_documentation/085524400zvcsU79jU6.jpg',
            ],
            [
                'job_task_id' => 1,
                'subordinate' => 4,
                'location_latitude' =>  -1.2598389,
                'location_longitude' => 116.8697653,
                'jobtask_documentation' => 'jobtask_documentation/4235228928442mXtUmEvkgB.jpg',
            ],


            [
                'job_task_id' => 2,
                'subordinate' => 3,
                'location_latitude' =>  -1.2767308,
                'location_longitude' => 116.8276976,
                'jobtask_documentation' => 'jobtask_documentation/rjothewrghf598.jpg',
            ],
            [
                'job_task_id' => 2,
                'subordinate' => 4,
                'location_latitude' =>  -1.2767308,
                'location_longitude' => 116.8276976,
                'jobtask_documentation' => 'jobtask_documentation/fgushw28924j2hrjk2f.jpg',
            ],
            [
                'job_task_id' => 2,
                'subordinate' => 4,
                'location_latitude' =>  -1.2767308,
                'location_longitude' => 116.8276976,
                'jobtask_documentation' => 'jobtask_documentation/3489ryuwefsgfsdjk.jpg',
            ],
            [
                'job_task_id' => 3,
                'subordinate' => 3,
                'location_latitude' =>  -1.2767308,
                'location_longitude' => 116.8276976,
                'jobtask_documentation' => 'jobtask_documentation/43t8wrfg49tfda.jpg',
            ],
        ]);
    }
}
