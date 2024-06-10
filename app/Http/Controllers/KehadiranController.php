<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class KehadiranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = "
        SELECT siswa.nis, siswa.nama, kelas.nama_kelas, 
        COALESCE(SUM(CASE WHEN kehadiran.status_presensi = 'Hadir' THEN 1 ELSE 0 END), 0) as hadir,
        COALESCE(SUM(CASE WHEN kehadiran.status_presensi = 'Sakit' THEN 1 ELSE 0 END), 0) as sakit,
        COALESCE(SUM(CASE WHEN kehadiran.status_presensi = 'Izin' THEN 1 ELSE 0 END), 0) as izin,
        COALESCE(SUM(CASE WHEN kehadiran.status_presensi = 'Alpha' THEN 1 ELSE 0 END), 0) as alpha
        FROM siswa
        LEFT JOIN kehadiran ON siswa.nis = kehadiran.nis
        LEFT JOIN kelas ON siswa.id_kelas = kelas.id
        GROUP BY siswa.nis
        ";

        $kehadirans = DB::select($query);
        $kelases = DB::table('kelas')->get();
        $pelajarans = DB::table('pelajaran')->get();

        return view('rekap', compact('kehadirans', 'kelases', 'pelajarans'));
    }

    public function filter(Request $request)
    {
        // Retrieve form inputs
        $kelas = $request->input('kelas');
        $mata_pelajaran = $request->input('mata_pelajaran');
        $bulan = $request->input('bulan');
    
        // Use a parameterized query to prevent SQL injection
        $query = "
            SELECT siswa.nis, siswa.nama, kelas.nama_kelas, 
                COALESCE(SUM(CASE WHEN kehadiran.status_presensi = 'Hadir' THEN 1 ELSE 0 END), 0) as hadir,
                COALESCE(SUM(CASE WHEN kehadiran.status_presensi = 'Sakit' THEN 1 ELSE 0 END), 0) as sakit,
                COALESCE(SUM(CASE WHEN kehadiran.status_presensi = 'Izin' THEN 1 ELSE 0 END), 0) as izin,
                COALESCE(SUM(CASE WHEN kehadiran.status_presensi = 'Alpha' THEN 1 ELSE 0 END), 0) as alpha
            FROM siswa 
            LEFT JOIN kehadiran 
                ON siswa.nis = kehadiran.nis
                AND MONTH(kehadiran.tanggal) = :bulan
                AND kehadiran.id_pelajaran = :mata_pelajaran
            LEFT JOIN kelas 
                ON siswa.id_kelas = kelas.id
            WHERE kelas.id = :kelas
            GROUP BY siswa.nis;
        ";
    
        // Execute the query
        $kehadirans = DB::select($query, [
            'bulan' => $bulan,
            'mata_pelajaran' => $mata_pelajaran,
            'kelas' => $kelas,
        ]);
        $kelases = DB::table('kelas')->get();
        $pelajarans = DB::table('pelajaran')->get();
    
        // Return the results (you can pass them to a view)
        return view('rekap', compact('kehadirans', 'kelases', 'pelajarans'));
    }
    
    public function downloadRekap(Request $request)
    {
        // Ambil filter dari request
        $kelas = $request->input('kelas');
        $pelajaran = $request->input('pelajaran');
        $bulan = $request->input('bulan', date('n'));
    
        $spreadsheet = new Spreadsheet();
        $activeWorksheet = $spreadsheet->getActiveSheet();
    
        // Query untuk mengambil data siswa dan kehadiran dengan filter
        $query = "
            SELECT
                siswa.nis,
                siswa.nama,
                kelas.nama_kelas,
                SUM(CASE WHEN kehadiran.status_presensi = 'Hadir' THEN 1 ELSE 0 END) as hadir,
                SUM(CASE WHEN kehadiran.status_presensi = 'Sakit' THEN 1 ELSE 0 END) as sakit,
                SUM(CASE WHEN kehadiran.status_presensi = 'Izin' THEN 1 ELSE 0 END) as izin,
                SUM(CASE WHEN kehadiran.status_presensi = 'Alpha' THEN 1 ELSE 0 END) as alpha
            FROM siswa
            LEFT JOIN kehadiran ON siswa.nis = kehadiran.nis
            INNER JOIN kelas ON siswa.id_kelas = kelas.id
            WHERE 1=1 ";
    
        $params = [];
        
        if ($kelas) {
            $query .= " AND kelas.nama_kelas = ? ";
            $params[] = $kelas;
        }
    
        if ($pelajaran) {
            $query .= " AND kehadiran.id_pelajaran = (SELECT id FROM pelajaran WHERE nama = ?) ";
            $params[] = $pelajaran;
        }
    
        $query .= " AND MONTH(kehadiran.tanggal) = ? GROUP BY siswa.nis";
        $params[] = $bulan;
    
        $results = DB::select($query, $params);
    
        // Judul
        $activeWorksheet->setCellValue('A2', 'DAFTAR HADIR SISWA');
        $activeWorksheet->mergeCells('A2:AL2');
        $activeWorksheet->setCellValue('A3', 'MADRASAH AL-AWALIYAH');
        $activeWorksheet->mergeCells('A3:AL3');
    
        $styleTitle = [
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
        ];
        $activeWorksheet->getStyle('A2:AL3')->applyFromArray($styleTitle);
    
        // Header Tabel
        $activeWorksheet->setCellValue('A5', 'No');
        $activeWorksheet->mergeCells('A5:A6');
        
        $activeWorksheet->setCellValue('B5', 'Nis');
        $activeWorksheet->mergeCells('B5:B6');
        
        $activeWorksheet->setCellValue('C5', 'Nama');
        $activeWorksheet->mergeCells('C5:C6');
        
        $activeWorksheet->setCellValue('D5', 'Kelas');
        $activeWorksheet->mergeCells('D5:D6');
        
        $activeWorksheet->setCellValue('E5', 'Bulan : '. $bulan);
        $activeWorksheet->mergeCells('E5:AH5');
    
        for ($i = 1; $i <= 31; $i++) {
            $columnLetter = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($i + 4);
            $activeWorksheet->setCellValue($columnLetter . '6', $i);
        }    
    
        $activeWorksheet->setCellValue('AI5', 'Jumlah');
        $activeWorksheet->mergeCells('AI5:AL5');
    
        $activeWorksheet->setCellValue('AI6', 'Hadir');
        $activeWorksheet->setCellValue('AJ6', 'Sakit');
        $activeWorksheet->setCellValue('AK6', 'Izin');
        $activeWorksheet->setCellValue('AL6', 'Alpha');
    
        // Isi Data
        foreach ($results as $key => $row) {
            $activeWorksheet->setCellValue('A'.($key+7), $key+1);
            $activeWorksheet->setCellValue('B'.($key+7), $row->nis);
            $activeWorksheet->setCellValue('C'.($key+7), $row->nama);
            $activeWorksheet->setCellValue('D'.($key+7), $row->nama_kelas);
            $activeWorksheet->setCellValue('AI'.($key+7), $row->hadir);
            $activeWorksheet->setCellValue('AJ'.($key+7), $row->sakit);
            $activeWorksheet->setCellValue('AK'.($key+7), $row->izin);
            $activeWorksheet->setCellValue('AL'.($key+7), $row->alpha);
    
            // Mengambil data kehadiran per hari untuk siswa tersebut
            $kehadiranHarian = DB::select("
                SELECT 
                    DAY(tanggal) as hari,
                    status_presensi
                FROM kehadiran
                WHERE nis = ? AND MONTH(tanggal) = ?
            ", [$row->nis, $bulan]);
    
            // Isi kolom tanggal dengan status kehadiran
            foreach ($kehadiranHarian as $kehadiran) {
                $columnLetter = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($kehadiran->hari + 4);
                $activeWorksheet->setCellValue($columnLetter . ($key + 7), $kehadiran->status_presensi);
            }
        }
    
        // Menambahkan border ke seluruh data
        $lastRow = count($results) + 6; // Baris terakhir yang memiliki data
        $activeWorksheet->getStyle('A5:AL' . $lastRow)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
    
        $styleArray = [
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => [
                    'rgb' => 'FFFF00', // Warna kuning, sesuaikan dengan warna yang Anda inginkan
                ],
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
        ];
        $activeWorksheet->getStyle('A5:AL6')->applyFromArray($styleArray);
    
        // Memberikan gaya khusus pada kolom "Bulan:"
        $styleBulan = [
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
        ];
        $activeWorksheet->getStyle('E5')->applyFromArray($styleBulan);
    
        // Set headers to force file download
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="rekap-absensi.xlsx"');
        header('Cache-Control: max-age=0');
    
        // Save spreadsheet to output
        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
