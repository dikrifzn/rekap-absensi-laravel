<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kehadiran extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'tanggal', 'nis', 'id_pelajaran', 'status_presensi'];
    protected $table = 'kehadiran';
}
