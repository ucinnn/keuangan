<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tabungan extends Model
{
    use HasFactory, SoftDeletes; // Menambahkan SoftDeletes

    protected $fillable = [
        'siswa_id',
        'saldo_awal',
        'saldo_akhir',  // Jika kamu ingin menghitung saldo akhir secara otomatis
        'status',
        'username',
    ];

    // Relasi ke siswa
    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'username', 'username');
    }

    // Relasi ke transaksi tabungan
    public function transaksi()
    {
        return $this->hasMany(TransaksiTabungan::class);
    }

    // Optional: hitung saldo terakhir (dari saldo awal + transaksi)
    public function getSaldoAkhirAttribute()
    {
        $totalSetoran = $this->transaksi()->where('jenis_transaksi', 'Setoran')->sum('jumlah');
        $totalPenarikan = $this->transaksi()->where('jenis_transaksi', 'Penarikan')->sum('jumlah');

        return $this->saldo_awal + $totalSetoran - $totalPenarikan;
    }
}
