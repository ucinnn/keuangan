<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class TransaksiKas extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'transaksi_kas'; // Jika nama tabel berbeda dengan nama model

    protected $fillable = ['kas_id', 'nominal', 'unitpendidikan_id', 'keterangan'];

    // Define relationship with Kas
    public function kas()
    {
        return $this->belongsTo(Kas::class); // TransaksiKas memiliki satu Kas
    }

    // Define relationship with UnitPendidikan
    public function unitpendidikan()
    {
        return $this->belongsTo(UnitPendidikan::class);
    }

    // Accessor untuk ambil kategori dari relasi Kas
    public function getTipeAttribute()
    {
        return $this->kas?->kategori; // Safe navigation (null-safe)
    }
}