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
                'report_task_id' => null,
                'sector_id' => null,
                'report_type' => 'Rutin',
                'job_task_id' => 1,
                'subordinate' => 3,
                'location_latitude' =>  -1.2598389,
                'location_longitude' => 116.8697653,
                'jobtask_documentation' => 'jobtask_documentation/085524400zvcsU79jU6.jpg',
                'report_about' => null,
                'report_source_information' => null,
                'report_date' => null,
                'report_place' => null,
                'report_activities' => null,
                'report_analysis' => null,
                'report_prediction' => null, 
                'report_steps_taken' => null,
                'report_recommendation' => null,
                'report_note' => null
            ],
            [
                'report_task_id' => null,
                'sector_id' => null,
                'report_type' => 'Rutin',
                'job_task_id' => 1,
                'subordinate' => 4,
                'location_latitude' =>  -1.2598389,
                'location_longitude' => 116.8697653,
                'jobtask_documentation' => 'jobtask_documentation/4235228928442mXtUmEvkgB.jpg',
                'report_about' => null,
                'report_source_information' => null,
                'report_date' => null,
                'report_place' => null,
                'report_activities' => null,
                'report_analysis' => null,
                'report_prediction' => null, 
                'report_steps_taken' => null,
                'report_recommendation' => null,
                'report_note' => null
            ],


            [
                'report_task_id' => null,
                'sector_id' => null,
                'report_type' => 'Rutin',
                'job_task_id' => 2,
                'subordinate' => 3,
                'location_latitude' =>  -1.2767308,
                'location_longitude' => 116.8276976,
                'jobtask_documentation' => 'jobtask_documentation/rjothewrghf598.jpg',
                'report_about' => null,
                'report_source_information' => null,
                'report_date' => null,
                'report_place' => null,
                'report_activities' => null,
                'report_analysis' => null,
                'report_prediction' => null, 
                'report_steps_taken' => null,
                'report_recommendation' => null,
                'report_note' => null
            ],
            [
                'report_task_id' => null,
                'sector_id' => null,
                'report_type' => 'Rutin',
                'job_task_id' => 2,
                'subordinate' => 4,
                'location_latitude' =>  -1.2767308,
                'location_longitude' => 116.8276976,
                'jobtask_documentation' => 'jobtask_documentation/fgushw28924j2hrjk2f.jpg',
                'report_about' => null,
                'report_source_information' => null,
                'report_date' => null,
                'report_place' => null,
                'report_activities' => null,
                'report_analysis' => null,
                'report_prediction' => null, 
                'report_steps_taken' => null,
                'report_recommendation' => null,
                'report_note' => null
            ],
            [
                'report_task_id' => null,
                'sector_id' => null,
                'report_type' => 'Rutin',
                'job_task_id' => 2,
                'subordinate' => 4,
                'location_latitude' =>  -1.2767308,
                'location_longitude' => 116.8276976,
                'jobtask_documentation' => 'jobtask_documentation/3489ryuwefsgfsdjk.jpg',
                'report_about' => null,
                'report_source_information' => null,
                'report_date' => null,
                'report_place' => null,
                'report_activities' => null,
                'report_analysis' => null,
                'report_prediction' => null, 
                'report_steps_taken' => null,
                'report_recommendation' => null,
                'report_note' => null
            ],
            [
                'report_task_id' => null,
                'sector_id' => null,
                'report_type' => 'Rutin',
                'job_task_id' => 3,
                'subordinate' => 3,
                'location_latitude' =>  -1.2767308,
                'location_longitude' => 116.8276976,
                'jobtask_documentation' => 'jobtask_documentation/43t8wrfg49tfda.jpg',
                'report_about' => null,
                'report_source_information' => null,
                'report_date' => null,
                'report_place' => null,
                'report_activities' => null,
                'report_analysis' => null,
                'report_prediction' => null, 
                'report_steps_taken' => null,
                'report_recommendation' => null,
                'report_note' => null
            ],

            [
                'report_task_id' => 1,
                'sector_id' => 5,
                'report_type' => 'Isidentil',
                'job_task_id' => null,
                'subordinate' => 3,
                'location_latitude' => -1.2658151,
                'location_longitude' => 116.8977258,
                'jobtask_documentation' => 'jobtask_documentation/aca43c6ec960c568965ad83dafb6350d.jpg',

                'report_about' => 'Penangkapan Oknum Petugas Bandara Kasus Bobol Koper Penumpang',
                'report_source_information' => 'Aduan Masyarakat',
                'report_date' => Carbon::create(2022, 7, 25),
                'report_place' => 'Bandara Sepinggan',
                'report_activities' => 'Pada jam 10:45 petugas mendatangi Bandara Sepinggan untuk melakukan penangkapan kemudian pada jam 11:30 petugas',
                'report_analysis' => 'Kurangnya pengawasan di bandara sehingga menimbulkan kesempatan oknum untuk melancarkan aksinya',
                'report_prediction' => 'Pelaku kekurangan uang', 
                'report_steps_taken' =>'Membawa Pelaku ke polres',
                'report_recommendation' => 'Menambah pengawasan di area Bandara Sepinggan',
                'report_note' => null
            ],

            [
                'report_task_id' => 1,
                'sector_id' => 5,
                'report_type' => 'Isidentil',
                'report_about' => 'Penangkapan Oknum Petugas Bandara Kasus Bobol Koper Penumpang',
                'report_source_information' => 'Aduan Masyarakat',
                'report_date' => Carbon::create(2022, 7, 25),
                'report_place' => 'Bandara Sepinggan',
                'report_activities' => 'Pada jam 10:45 petugas mendatangi Bandara Sepinggan untuk melakukan penangkapan kemudian pada jam 11:30 petugas membawa pelaku ke polres untuk dimintai keterangan lebih lanjut',
                'report_analysis' => 'Kurangnya pengawasan di bandara sehingga menimbulkan kesempatan oknum untuk melancarkan aksinya',
                'report_prediction' => 'Pelaku kekurangan uang', 
                'report_steps_taken' =>'Membawa Pelaku ke polres',
                'report_recommendation' => 'Menambah pengawasan di area Bandara Sepinggan',
                'job_task_id' => null,
                'subordinate' => 3,
                'location_latitude' => -1.2658151,
                'location_longitude' => 116.8977258,
                'jobtask_documentation' => 'jobtask_documentation/49rfiwdfjw90uj234.jpeg',
                'report_note' => null
            ],

            [
                'report_task_id' => 3,
                'sector_id' => 4,
                'report_type' => 'Isidentil',
                'report_about' => 'Tawuran STM di gunung pasir',
                'report_source_information' => 'Aduan Masyarakat',
                'report_date' => Carbon::create(2022, 7, 25),
                'report_place' => 'Gunung Pasir Balikpapan',
                'report_activities' => 'Pada jam 22:45 siswa berkumpul untuk tawuran, kemudia pada jam 23:10 petugas datang untuk membubarkan siswa tersebut',
                'report_analysis' => 'Terjadi kesalahpahaman antar kelompok',
                'report_prediction' => 'Terjadi kesalahpahaman antar kelompok sehingga antar kelompok tersebut menyelesaikan permasalahan dengan kekerasan', 
                'report_steps_taken' =>'Membubarkan dan menangkap pelaku yang terlibat tawuran',
                'report_recommendation' => 'melakukan patroli sesering mungkin agar tercipta suasana yang kondusif',
                'job_task_id' => null,
                'subordinate' => 3,
                'location_latitude' => -1.2658151,
                'location_longitude' => 116.8977258,
                'jobtask_documentation' => 'jobtask_documentation/2735485920.jpg',
                'report_note' => null
            ],

            [
                'report_task_id' => 2,
                'sector_id' => 8,
                'report_type' => 'Isidentil',
                'report_about' => 'Laka Lantas Tunggal',
                'report_source_information' => 'Aduan Masyarakat',
                'report_date' => Carbon::create(2022, 8, 17),
                'report_place' => 'Jalan Soekarno Hatta, KM 1',
                'report_activities' => 'Pada jam 14:30 pengendara terjatuh sehingga mengakibatkan lalu lintas macet, Pada Jam 14:45 personil datang membantu korban sekaligus mentertibkan kembali arus lalu lintas',
                'report_analysis' => 'Pengemudi mengantuk sehingga terjatuh',
                'report_prediction' => 'Pengemudi mengantuk, Kondisi Jalanan Licin', 
                'report_steps_taken' =>'Membawa Pengemudi Ke RSUD, Mentertibkan Lalu Lintas',
                'report_recommendation' => 'Membersihkan Jalanan dari debu agar tidak licin',
                'job_task_id' => null,
                'subordinate' => 4,
                'location_latitude' => -1.2658151,
                'location_longitude' => 116.8977258,
                'jobtask_documentation' => 'jobtask_documentation/werut89wer7wer89.jpg',
                'report_note' => null
            ],
        ]);
    }
}
