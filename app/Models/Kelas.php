<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;
    protected $table = 'kelas';
    protected $primaryKey = 'id';
    protected $fillable = ['id','unitpendidikan_id', 'nama_kelas','grade', 'keterangan', 'status'];

    public function siswas()
    {
        return $this->hasMany(Siswa::class);
    }

    public function unitpendidikan()
    {
        return $this->belongsTo(UnitPendidikan::class);
    }

}
