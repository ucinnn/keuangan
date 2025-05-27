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
        'created_at',
        'username',
        'saldo_berjalan',
    ];

    public function getSaldoBerjalanAttribute()
    {
        // Ambil semua transaksi dari tabungan yang sama, urutkan berdasarkan created_at dan ID (untuk menghindari urutan duplikat)
        $transaksiSebelumnya = self::where('tabungan_id', $this->tabungan_id)
            ->where(function ($query) {
                $query->where('created_at', '<', $this->created_at)
                    ->orWhere(function ($query) {
                        $query->where('created_at', $this->created_at)
                            ->where('id', '<=', $this->id);
                    });
            })
            ->orderBy('created_at')
            ->orderBy('id')
            ->get();

        $saldo = $this->tabungan->saldo_awal;

        foreach ($transaksiSebelumnya as $trx) {
            if ($trx->jenis_transaksi === 'Setoran') {
                $saldo += $trx->jumlah;
            } elseif ($trx->jenis_transaksi === 'Penarikan') {
                $saldo -= $trx->jumlah;
            }
        }

        return $saldo;
    }


    public function tabungan()
    {
        return $this->belongsTo(Tabungan::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'username', 'username');
    }
}
