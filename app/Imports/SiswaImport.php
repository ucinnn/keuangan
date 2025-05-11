<?php

namespace App\Imports;

use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\UnitPendidikan;
use Maatwebsite\Excel\Concerns\ToModel;

class SiswaImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {

        // Cari ID kelas berdasarkan nama kelas
        $kelas = Kelas::where('nama_kelas', $row[5])->first();

        // Mapping unit pendidikan
        $unitpendidikanMap = [
            'TK' => 2, 'SD' => 3, 'SMP' => 4, 'SMA' => 5,
            'MADIN' => 6, 'TPQ' => 7,
            'YA PONDOK' => 8, 'TIDAK PONDOK' => 9
        ];

        return new Siswa([
            'nis' => $row[1],
            'nisn' => $row[2],
            'nama' => $row[3],
            'jenis_kelamin' => $row[4],
            'kelas_id' => $kelas ? $kelas->id : null, // Set null jika kelas tidak ditemukan
            'agama' => $row[6],
            'namaOrtu' => $row[7],
            'alamatOrtu' => $row[8],
            'noTelp' => $row[9],
            'email' => $row[10],
            'unitpendidikan_id' => $unitpendidikanMap[$row[11]] ?? null, // Unit Pendidikan Formal
            'unitpendidikan_idInformal' => $unitpendidikanMap[$row[12]] ?? null, // Unit Pendidikan Informal
            'unitpendidikan_idPondok' => $unitpendidikanMap[$row[13]] ?? null, // Status Pondok
            'status' => $row[14]
        ]);
    }
}