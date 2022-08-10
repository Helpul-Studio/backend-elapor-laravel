<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('reports')->insert(
            [
                [
                    'report_type' => 'Rutin',
                    'sector_id' => 4,
                    'subordinate' => 3,
                    'report_about' => 'Apel Pagi',
                    'report_source_information' => 'Anggota Polda Kaltim',
                    'report_date' => Carbon::create(2022, 8, 17),
                    'report_place' => 'Lapangan Polda Kaltim',

                    'report_activities' => 'Mendengarkan Dengan Seksama arahan dari Kapolda',
                    'report_analysis' => null,
                    'report_prediction' => null, 
                    'report_steps_taken' => null,
                    'report_recommendation' => null

                ],
                [
                    'report_type' => 'Isidentil',
                    'sector_id' => 4,
                    'subordinate' => 5,
                    'report_about' => 'Laka Lantas Tunggal',
                    'report_source_information' => 'Masyarakat',
                    'report_date' => Carbon::create(2022, 8, 17),
                    'report_place' => 'Jalan Soekarno Hatta, KM 1',

                    'report_activities' => 'Pada jam 14:30 pengendara terjatuh sehingga mengakibatkan lalu lintas macet, Pada Jam 14:45 personil datang membantu korban sekaligus mentertibkan kembali arus lalu lintas',
                    'report_analysis' => 'Pengemudi mengantuk sehingga terjatuh',
                    'report_prediction' => 'Pengemudi mengantuk, Kondisi Jalanan Licin', 
                    'report_steps_taken' =>'Membawa Pengemudi Ke RSUD, Mentertibkan Lalu Lintas',
                    'report_recommendation' => 'Membersihkan Jalanan dari debu agar tidak licin'

                ],
            ]
        );
    }
}
