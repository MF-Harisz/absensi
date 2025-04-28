<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;
    protected $table = 'absensi';

    protected $fillable = [
        'id_users',
        'id_jadwal',
        'id_makul',
        'jam',
        'tanggal',
        'lokasi',
        'foto',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'id_users');
    }

    public function jadwal()
    {
        return $this->belongsTo(Jadwal::class, 'id_jadwal');
    }
    public function makul()
    {
        return $this->belongsTo(Makul::class, 'id_makul');
    }
    
    public $timestamps = false;
}
