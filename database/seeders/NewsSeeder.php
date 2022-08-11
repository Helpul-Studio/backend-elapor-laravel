<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('news')->insert(
            [
                [
                    'news_title' => 'Dansatbrimob Anugerahi Bintang Kepada Polda Sulteng',
                    'news_field' => 'Dansatbrimob Polda Sulteng Komisaris Besar Polisi Mokhamad Alfian Hidayat menerima anugerah tanda kehormatan Bintang Bhayangkara Nararya dari Presiden Joko Widodo, dalam upacara peringatan Hari Bhayangkara ke-76 di Akademi Kepolisian',
                    'news_image' => 'news_image/r3wfhsfhfsf.jpg',
                    'sector_id' => 6,
                    'principal' => 2
                ], 
                [
                    'news_title' => 'Polda Kaltim Bongkar Jaringan Sabu di Ibu Kota Kaltim, Bekuk 9 Warga Samarinda',
                    'news_field' => 'Jajaran Direktorat Reserse Narkoba Polda Kaltim kembali membongkar jaringan narkoba di Kaltim',
                    'news_image' => 'news_image/3terjgdhsfioghsrdio.jpg',
                    'sector_id' => 5,
                    'principal' => 2
                ],   
            ]
        );
    }
}
