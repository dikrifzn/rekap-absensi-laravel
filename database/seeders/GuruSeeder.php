<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GuruSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $gurus = [
            [
                'nuptk' => '0111',
                'nama_guru' => 'Ustad H. Dikri Fauzan Amrulloh, S.Kom'
            ]
        ];

        DB::table('guru')->insert($gurus);
    }
}
