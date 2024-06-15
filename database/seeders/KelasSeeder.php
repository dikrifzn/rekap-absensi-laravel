<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $kelases = [
            [
                'nama_kelas' => '1A',
                'id_guru' => '0111'
            ],

            [
                'nama_kelas' => '1B',
                'id_guru' => '0111'
            ],

            [
                'nama_kelas' => '2A',
                'id_guru' => '0111'
            ],

            [
                'nama_kelas' => '2B',
                'id_guru' => '0111'
            ],

            [
                'nama_kelas' => '3A',
                'id_guru' => '0111'
            ],

            [
                'nama_kelas' => '3B',
                'id_guru' => '0111'
            ],

            [
                'nama_kelas' => '4',
                'id_guru' => '0111'
            ],
        ];

        DB::table('kelas')->insert($kelases);
    }
}
