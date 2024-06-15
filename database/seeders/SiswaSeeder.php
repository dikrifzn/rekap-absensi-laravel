<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $siswas = [
            ['nis' => 12301, 'nama' => 'ACIL', 'jk' => 'L', 'id_kelas' => 1, 'status' => 'Aktif'],
            ['nis' => 12302, 'nama' => 'AFRILA NAIFA R', 'jk' => 'P', 'id_kelas' => 1, 'status' => 'Aktif'],
            ['nis' => 12303, 'nama' => 'ALIP RIZKI', 'jk' => 'L', 'id_kelas' => 1, 'status' => 'Aktif'],
            ['nis' => 12304, 'nama' => 'ANGGA', 'jk' => 'L', 'id_kelas' => 1, 'status' => 'Aktif'],
            ['nis' => 12305, 'nama' => 'ARFAN', 'jk' => 'L', 'id_kelas' => 1, 'status' => 'Aktif'],
            ['nis' => 12306, 'nama' => 'AZRIL', 'jk' => 'L', 'id_kelas' => 1, 'status' => 'Aktif'],
            ['nis' => 12307, 'nama' => 'BAGAS', 'jk' => 'L', 'id_kelas' => 1, 'status' => 'Aktif'],
            ['nis' => 12308, 'nama' => 'DEVIKA', 'jk' => 'P', 'id_kelas' => 1, 'status' => 'Aktif'],
            ['nis' => 12309, 'nama' => 'DIVA', 'jk' => 'P', 'id_kelas' => 1, 'status' => 'Aktif'],
            ['nis' => 12310, 'nama' => 'EVANO FARZAN F', 'jk' => 'L', 'id_kelas' => 1, 'status' => 'Aktif'],

            ['nis' => 12327, 'nama' => 'ADAM NURWAHID', 'jk' => 'L', 'id_kelas' => 2, 'status' => 'Aktif'],
            ['nis' => 12328, 'nama' => 'ARFAN ABDUL H', 'jk' => 'L', 'id_kelas' => 2, 'status' => 'Aktif'],
            ['nis' => 12329, 'nama' => 'BABONG PADLI', 'jk' => 'L', 'id_kelas' => 2, 'status' => 'Aktif'],
            ['nis' => 12330, 'nama' => 'CHERUL', 'jk' => 'L', 'id_kelas' => 2, 'status' => 'Aktif'],
            ['nis' => 12331, 'nama' => 'DIAH S F', 'jk' => 'P', 'id_kelas' => 2, 'status' => 'Aktif'],
            ['nis' => 12332, 'nama' => 'ELVIRA', 'jk' => 'P', 'id_kelas' => 2, 'status' => 'Aktif'],
            ['nis' => 12333, 'nama' => 'FATIMAH (IFAZ)', 'jk' => 'P', 'id_kelas' => 2, 'status' => 'Aktif'],
            ['nis' => 12334, 'nama' => 'FINA', 'jk' => 'P', 'id_kelas' => 2, 'status' => 'Aktif'],
            ['nis' => 12335, 'nama' => 'HISYAM', 'jk' => 'L', 'id_kelas' => 2, 'status' => 'Aktif'],
            ['nis' => 12336, 'nama' => 'KANZA', 'jk' => 'P', 'id_kelas' => 2, 'status' => 'Aktif'],
            
            ['nis' => 12350, 'nama' => 'AGAM', 'jk' => 'L', 'id_kelas' => 3, 'status' => 'Aktif'],
            ['nis' => 12351, 'nama' => 'AINANYYA', 'jk' => 'P', 'id_kelas' => 3, 'status' => 'Aktif'],
            ['nis' => 12352, 'nama' => 'ALFIKRI', 'jk' => 'L', 'id_kelas' => 3, 'status' => 'Aktif'],
            ['nis' => 12353, 'nama' => 'DARA', 'jk' => 'P', 'id_kelas' => 3, 'status' => 'Aktif'],
            ['nis' => 12354, 'nama' => 'HANI KHAIRUNNISA', 'jk' => 'P', 'id_kelas' => 3, 'status' => 'Aktif'],
            ['nis' => 12355, 'nama' => 'KHOIRUL ANAM', 'jk' => 'L', 'id_kelas' => 3, 'status' => 'Aktif'],
            ['nis' => 12356, 'nama' => 'KILAU', 'jk' => 'L', 'id_kelas' => 3, 'status' => 'Aktif'],
            ['nis' => 12357, 'nama' => 'M. NUR RIZKY', 'jk' => 'L', 'id_kelas' => 3, 'status' => 'Aktif'],
            ['nis' => 12358, 'nama' => 'RAFIKA SITI', 'jk' => 'P', 'id_kelas' => 3, 'status' => 'Aktif'],
            ['nis' => 12359, 'nama' => 'RAQILA', 'jk' => 'P', 'id_kelas' => 3, 'status' => 'Aktif'],
            
            ['nis' => 12367, 'nama' => 'ALYA', 'jk' => 'P', 'id_kelas' => 4, 'status' => 'Aktif'],
            ['nis' => 12368, 'nama' => 'ARFI', 'jk' => 'L', 'id_kelas' => 4, 'status' => 'Aktif'],
            ['nis' => 12369, 'nama' => 'ARYA', 'jk' => 'L', 'id_kelas' => 4, 'status' => 'Aktif'],
            ['nis' => 12370, 'nama' => 'HAFIZ', 'jk' => 'L', 'id_kelas' => 4, 'status' => 'Aktif'],
            ['nis' => 12371, 'nama' => 'HANA', 'jk' => 'P', 'id_kelas' => 4, 'status' => 'Aktif'],
            ['nis' => 12372, 'nama' => 'IRWANSYAH', 'jk' => 'L', 'id_kelas' => 4, 'status' => 'Aktif'],
            ['nis' => 12373, 'nama' => 'RAIHAN', 'jk' => 'L', 'id_kelas' => 4, 'status' => 'Aktif'],
            ['nis' => 12374, 'nama' => 'RASYA', 'jk' => 'L', 'id_kelas' => 4, 'status' => 'Aktif'],
            ['nis' => 12375, 'nama' => 'REFINA', 'jk' => 'P', 'id_kelas' => 4, 'status' => 'Aktif'],
            ['nis' => 12376, 'nama' => 'REVAN', 'jk' => 'L', 'id_kelas' => 4, 'status' => 'Aktif'],
            
            ['nis' => 12380, 'nama' => 'AFIKA', 'jk' => 'P', 'id_kelas' => 5, 'status' => 'Aktif'],
            ['nis' => 12381, 'nama' => 'AQILA', 'jk' => 'P', 'id_kelas' => 5, 'status' => 'Aktif'],
            ['nis' => 12382, 'nama' => 'DANIS', 'jk' => 'L', 'id_kelas' => 5, 'status' => 'Aktif'],
            ['nis' => 12383, 'nama' => 'DONA', 'jk' => 'P', 'id_kelas' => 5, 'status' => 'Aktif'],
            ['nis' => 12384, 'nama' => 'EDGAR', 'jk' => 'L', 'id_kelas' => 5, 'status' => 'Aktif'],
            ['nis' => 12385, 'nama' => 'FASYA', 'jk' => 'P', 'id_kelas' => 5, 'status' => 'Aktif'],
            ['nis' => 12386, 'nama' => 'HABAWI', 'jk' => 'L', 'id_kelas' => 5, 'status' => 'Aktif'],
            ['nis' => 12387, 'nama' => 'HABIBI', 'jk' => 'L', 'id_kelas' => 5, 'status' => 'Aktif'],
            ['nis' => 12388, 'nama' => 'HALWA', 'jk' => 'P', 'id_kelas' => 5, 'status' => 'Aktif'],
            ['nis' => 12389, 'nama' => 'KEYLA', 'jk' => 'P', 'id_kelas' => 5, 'status' => 'Aktif'],
            
            ['nis' => 12401, 'nama' => 'ALEISYA', 'jk' => 'P', 'id_kelas' => 6, 'status' => 'Aktif'],
            ['nis' => 12402, 'nama' => 'ALIP AHMAD S', 'jk' => 'L', 'id_kelas' => 6, 'status' => 'Aktif'],
            ['nis' => 12403, 'nama' => 'BISMA', 'jk' => 'L', 'id_kelas' => 6, 'status' => 'Aktif'],
            ['nis' => 12404, 'nama' => 'DEA', 'jk' => 'P', 'id_kelas' => 6, 'status' => 'Aktif'],
            ['nis' => 12405, 'nama' => 'DILA', 'jk' => 'P', 'id_kelas' => 6, 'status' => 'Aktif'],
            ['nis' => 12406, 'nama' => 'FAQIH', 'jk' => 'L', 'id_kelas' => 6, 'status' => 'Aktif'],
            ['nis' => 12407, 'nama' => 'FITRA', 'jk' => 'P', 'id_kelas' => 6, 'status' => 'Aktif'],
            ['nis' => 12408, 'nama' => 'HAFIZ', 'jk' => 'L', 'id_kelas' => 6, 'status' => 'Aktif'],
            ['nis' => 12409, 'nama' => 'HAVRA', 'jk' => 'P', 'id_kelas' => 6, 'status' => 'Aktif'],
            ['nis' => 12410, 'nama' => 'KEVIN', 'jk' => 'L', 'id_kelas' => 6, 'status' => 'Aktif'],
            
            ['nis' => 12423, 'nama' => 'AINIYYAH', 'jk' => 'P', 'id_kelas' => 7, 'status' => 'Aktif'],
            ['nis' => 12424, 'nama' => 'AKIRA', 'jk' => 'L', 'id_kelas' => 7, 'status' => 'Aktif'],
            ['nis' => 12425, 'nama' => 'ALENA', 'jk' => 'P', 'id_kelas' => 7, 'status' => 'Aktif'],
            ['nis' => 12426, 'nama' => 'ALIP R', 'jk' => 'L', 'id_kelas' => 7, 'status' => 'Aktif'],
            ['nis' => 12427, 'nama' => 'ALYA AURA PUTRI', 'jk' => 'P', 'id_kelas' => 7, 'status' => 'Aktif'],
            ['nis' => 12428, 'nama' => 'ASYA', 'jk' => 'P', 'id_kelas' => 7, 'status' => 'Aktif'],
            ['nis' => 12429, 'nama' => 'AULIA AGUSTIN', 'jk' => 'P', 'id_kelas' => 7, 'status' => 'Aktif'],
            ['nis' => 12430, 'nama' => 'BIANCA', 'jk' => 'P', 'id_kelas' => 7, 'status' => 'Aktif'],
            ['nis' => 12431, 'nama' => 'CAROLINE', 'jk' => 'P', 'id_kelas' => 7, 'status' => 'Aktif'],
            ['nis' => 12432, 'nama' => 'CLARA', 'jk' => 'P', 'id_kelas' => 7, 'status' => 'Aktif'],
            
        ];
        DB::table('siswa')->insert($siswas);
    }
}
