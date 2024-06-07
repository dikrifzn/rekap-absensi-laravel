<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'waktu', 'deskripsi', 'id_kelas'];
    protected $table = 'jadwal_mengajar';
}
