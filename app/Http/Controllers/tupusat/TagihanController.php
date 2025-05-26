<?php

namespace App\Http\Controllers\tupusat;

use App\Http\Controllers\Controller;
use App\Models\UnitPendidikan;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Tagihan;
use App\Models\TahunAjaran;
use App\Models\JenisPembayaran;
use Illuminate\Http\Request;

class TagihanController extends Controller
{
    public function index(Request $request)
{
    $units = UnitPendidikan::where('kategori', 'formal')->get();

    $kelas = Kelas::when($request->unit, function ($query) use ($request) {
        return $query->whereHas('unitPendidikan', function ($q) use ($request) {
            $q->where('id', $request->unit);
        });
    })->get();

    $siswa = Siswa::when($request->kelas, fn($q) => $q->where('kelas_id', $request->kelas))->get();

    $tagihan = Tagihan::with(['siswa', 'jenisPembayaran'])
        ->when($request->siswa, fn($q) => $q->where('siswa_id', $request->siswa))
        ->get();

    return view('tupusat.tagihan-siswa', compact('units', 'kelas', 'siswa', 'tagihan'));
}

public function getKelasByUnit($unit_id)
{
    $kelas = Kelas::where('unitpendidikan_id', $unit_id)->get();
    return response()->json($kelas);
}

public function getSiswaByKelas($kelas_id)
{
    $siswa = Siswa::where('kelas_id', $kelas_id)->get();
    return response()->json($siswa);
}

public function show(Siswa $siswa)
{
    $tagihan = Tagihan::where('siswa_id', $siswa->id)->with('jenisPembayaran')->get();
    $bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    $jenisPembayaran = JenisPembayaran::all();
    $tahunAjaranAktif = TahunAjaran::where('status', 'Aktif')->first();

    return view('tupusat.detail-tagihan-siswa', compact('siswa', 'tagihan', 'jenisPembayaran', 'tahunAjaranAktif'));
}

}
