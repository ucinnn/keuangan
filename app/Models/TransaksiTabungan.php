<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiTabungan extends Model
{
    use HasFactory;

    protected $fillable = [
        'tabungan_id',
        'jenis_transaksi',
        'jumlah',
        'keterangan',
        'tanggal',
        'username',
    ];

    public function tabungan()
    {
        return $this->belongsTo(Tabungan::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'username', 'username');
    }
}
