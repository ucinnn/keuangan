<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class JenisPengeluaran extends Model
{
    use HasFactory;
    protected $table = "jenispengeluaran";
    protected $fillable = ['nama_pengeluaran','type','nominal_jenispengeluaran','status','idunitpendidikan','id_tahunajaran'];
    public function unitPendidikan()
    {
        return $this->belongsTo(UnitPendidikan::class, 'idunitpendidikan ', 'id ');
    }
    public function tahunAjaran()
    {
        return $this->belongsTo(TahunAjaran::class, 'id_tahunajaran', 'id');
    }
}
