<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;
    protected $table = 'jadwal';

    protected $fillable = [
        'id_kelas',
        'id_makul',
        'id_dosen',
        'hari',
        'jam_in',
        'jam_out',
    ];

    public $timestamps = false;

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas');
    }

    public function makul()
    {
        return $this->belongsTo(Makul::class, 'id_makul');
    }

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'id_dosen');
    }
    public function absensi()
    {
        return $this->hasMany(Absensi::class, 'id_jadwal');
    }
}
