<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class TransaksiKas extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'transaksi_kas'; // Jika nama tabel berbeda dengan nama model

    protected $fillable = ['kas_id', 'nominal', 'unitpendidikan_id', 'keterangan', 'created_by', 'deleted_by'];

    // Define relationship with Kas
    public function kas()
    {
        return $this->belongsTo(Kas::class); // TransaksiKas memiliki satu Kas
    }

    public static function boot()
    {
        parent::boot();

        static::deleting(function ($transaksi_kas) {
            $transaksi_kas->deleted_by = Auth::user()->username;
            $transaksi_kas->save();
        });

        static::updated(function ($model) {
            $original = $model->getOriginal();
            $changes = [];

            // Nominal
            if ($model->nominal != $original['nominal']) {
                $changes[] = "Nominal dari Rp " . number_format($original['nominal'], 0, ',', '.') . " menjadi Rp " . number_format($model->nominal, 0, ',', '.');
            }

            // Unit Pendidikan
            if ($model->unitpendidikan_id !== $original['unitpendidikan_id']) {
                $from = $original['unitpendidikan_id'] ?: '-';
                $to = $model->unitpendidikan_id ?: '-';
                $changes[] = "Unitpendidikan dari \"$from\" menjadi \"$to\"";
            }

            // Keterangan
            if ($model->keterangan !== $original['keterangan']) {
                $from = $original['keterangan'] ?: '-';
                $to = $model->keterangan ?: '-';
                $changes[] = "Keterangan dari \"$from\" menjadi \"$to\"";
            }

            // Jika ada perubahan
            if (!empty($changes)) {
                $model->information = [
                    'perubahan' => $changes,
                    'oleh' => Auth::user()->username,
                    'waktu' => now()->toDateTimeString(),
                ];

                // Simpan kembali perubahan informasi (karena event updated dipicu setelah update awal)
                $model->saveQuietly(); // gunakan saveQuietly agar tidak trigger event rekursif
            }
        });
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
