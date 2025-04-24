<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kas extends Model
{
    // Spesifikasikan nama tabel karena tidak sesuai default Laravel
    protected $table = 'kas';

    // Field yang bisa diisi
    protected $fillable = ['namaKas', 'kategori', 'status'];
}
