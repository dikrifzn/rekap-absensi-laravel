<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JadwalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jadwals = [
            [
                'waktu' => '16:00',
                'deskripsi' => 'Mengajar',
                'id_kelas' => '1'
            ]
        ];

        DB::table('jadwal_mengajar')->insert($jadwals);
    }
}
