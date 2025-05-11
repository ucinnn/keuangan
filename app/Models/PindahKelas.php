<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PindahKelas extends Model
{
    use HasFactory;

    protected $table = "pindahkelas";

    protected $fillable = [
        'siswa_id',
        'kelas_asal_id',
        'kelas_tujuan_id',
        'alasan',
        'status',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }

    public function kelasAsal()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }

    public function kelasTujuan()
    {
        return $this->belongsTo(Kelas::class, 'kelas_tujuan_id');
    }
}