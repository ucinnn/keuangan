<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tagihan extends Model
{
    use HasFactory;

    protected $table = 'tagihan';
    protected $fillable = [
        'siswa_id',
        'idjenispembayaran',
        'id_tahunajaran',
        'bulan',
        'nominal',
        'status',
        'tanggal_bayar',
    ];

    /* ─── Relasi Eloquent ────────────────────────────────────────── */

    // satu tagihan milik satu siswa
    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    // jenis pembayaran
    public function jenisPembayaran()
    {
        return $this->belongsTo(JenisPembayaran::class, 'idjenispembayaran', 'idjenispembayaran');
    }


    // tahun ajaran
    public function tahunAjaran()
    {
        return $this->belongsTo(TahunAjaran::class, 'id_tahunajaran', 'id');
    }
}
