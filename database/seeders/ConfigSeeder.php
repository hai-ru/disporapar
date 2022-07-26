<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $c = \App\Models\config::query();
        if(!empty($c->first())) return null;
        $input = [
            "video_url" => '/theme/porto_video/video/disporapar',
            "social_media" => [
                'fb'=>'',
                'ig'=>'',
                'wa'=>'',
                'email'=>'',
                'address'=>'Jl. Letnan Jendral Sutoyo Parit Tokaya, Pontianak Selatan. Kota Pontianak Kalimantan Barat 78113',
            ],
            "seo_title" => 'Visit West Borneo - Dinas Kepemudaan, Olah Raga dan Pariwisata Provinsi Kalimantan Barat',
            "seo_description" => 'Dinas Kepemudaan, Olahraga dan Pariwisata bertugas melaksanakan urusan Pemerintah Provinsi di Bidang Pemuda, Olahraga, Pariwisata melaksanakan tugas dekonsentrasi dan tugas lainnya yang diserahkan oleh Gubernur sesuai dengan Perundang-undangan yang berlaku.',
            "summary" => 'Dinas Kepemudaan, Olahraga dan Pariwisata bertugas melaksanakan urusan Pemerintah Provinsi di Bidang Pemuda, Olahraga, Pariwisata melaksanakan tugas dekonsentrasi dan tugas lainnya yang diserahkan oleh Gubernur sesuai dengan Perundang-undangan yang berlaku.',
            "menus" => [
                [
                    'link'=>'/',
                    'name'=>'Beranda'
                ]
            ]
        ];
        $c->create($input);
    }
}
