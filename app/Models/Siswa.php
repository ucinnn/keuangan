<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;
    protected $table = 'siswas';
    protected $primaryKey = 'id';
    protected $fillable = ['id','nis', 'nisn', 'nama', 'jenis_kelamin','kelas_id', 'agama', 'namaOrtu', 'alamatOrtu', 'noTelp', 'email','unitpendidikan_id', 'unitpendidikan_idInformal', 'unitpendidikan_idPondok', 'status'];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function unitpendidikan()
    {
        return $this->belongsTo(Unitpendidikan::class);
    }
}
