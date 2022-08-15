<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JobtaskSubordinateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('jobtask_subordinate')->insert(
            [
                ['job_task_id' => 1, 'subordinate' => 3],
                ['job_task_id' => 1, 'subordinate' => 4],

                ['job_task_id' => 2, 'subordinate' => 3],
                ['job_task_id' => 2, 'subordinate' => 4],

                ['job_task_id' => 3, 'subordinate' => 3],

                ['job_task_id' => 4, 'subordinate' => 3],
                ['job_task_id' => 4, 'subordinate' => 4],
                ['job_task_id' => 4, 'subordinate' => 5],
            ]
        );
    }
}
