<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Makul extends Model
{
    use HasFactory;
    protected $table = 'makul';

    protected $fillable = ['nama', 'kode', 'jurusan','semester', 'id_dosen']; 

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'id_dosen');
    }

    public $timestamps = false;
}
