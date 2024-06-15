<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PelajaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pelajarans = [
            [
                'nama_pelajaran' => 'Fiqih',
            ],
            [
                'nama_pelajaran' => "Al-Qur'an",
            ],
            [
                'nama_pelajaran' => 'Akhlaq',
            ],
            [
                'nama_pelajaran' => 'Sholat',
            ]
        ];

        DB::table('pelajaran')->insert($pelajarans);
    }
}
