<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class JenisPembayaran extends Model
{
    use HasFactory;
    protected $table = "jenispembayaran";
    protected $fillable = ['nama_pembayaran','type','nominal_jenispembayaran','status','idunitpendidikan','id_tahunajaran'];
    public function unitPendidikan()
    {
        return $this->belongsTo(UnitPendidikan::class, 'idunitpendidikan ', 'id ');
    }
    public function tahunAjaran()
    {
        return $this->belongsTo(TahunAjaran::class, 'id_tahunajaran', 'id');
    }
}
