<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Kas extends Model
{
    use HasFactory;

    // Spesifikasikan nama tabel karena tidak sesuai default Laravel
    protected $table = 'kas';

    // Field yang bisa diisi
    protected $fillable = ['nama_kas', 'kategori', 'status'];

    // Define relationship with TransaksiKas
    public function transaksiKas()
    {
        return $this->hasMany(TransaksiKas::class, 'kas_id');
    }

    protected static function booted()
    {
        static::updating(function (Kas $kas) {
            if ($kas->isDirty('status')) {
                $newStatus = $kas->status;
                $userId = Auth::check() ? Auth::user()->username : 'system';

                // Saat status diubah menjadi nonaktif
                if ($newStatus === 'Non Aktif') {
                    foreach ($kas->transaksiKas as $transaksi) {
                        $transaksi->deleted_by = $userId;
                        $transaksi->save();
                        $transaksi->delete(); // soft delete
                    }
                }

                // Saat status diubah menjadi aktif
                if ($newStatus === 'Aktif') {
                    TransaksiKas::onlyTrashed()
                        ->where('kas_id', $kas->id)
                        ->restore();
                }
            }
        });
    }
}