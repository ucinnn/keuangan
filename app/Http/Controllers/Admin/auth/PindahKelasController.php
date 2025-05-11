<?php

namespace App\Http\Controllers\Admin\auth;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\PindahKelas;
use Illuminate\Http\Request;

class PindahKelasController extends Controller
{
    public function index()
    {
        $siswas = Siswa::with(['kelas'])->get(); // relasi kelas di model Siswa harus ada
        $kelas = Kelas::where('status', 'AKTIF')->get();

        return view('admin.perpindahan-kelas', compact('siswas', 'kelas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'siswa_ids' => 'required|array',
            'kelas_tujuan_id' => 'required|exists:kelas,id',
            'alasan' => 'nullable|string|max:500',
        ]);

        foreach ($request->siswa_ids as $siswa_id) {
            $siswa = Siswa::findOrFail($siswa_id);

            PindahKelas::create([
                'siswa_id' => $siswa->id,
                'kelas_asal_id' => $siswa->kelas_id,
                'kelas_tujuan_id' => $request->kelas_tujuan_id,
                'alasan' => $request->alasan,
                'status' => 'pending',
            ]);
        }

        return redirect()->back()->with('success', 'Permohonan perpindahan berhasil dikirim.');
    }

    public function updateStatus($id, Request $request)
    {
        $request->validate([
            'status' => 'required|in:pending,disetujui,ditolak',
        ]);

        $perpindahan = PindahKelas::with('siswa')->findOrFail($id);
        $perpindahan->status = $request->status;
        $perpindahan->save();

        // Pastikan relasi siswa dan kelas_id benar-benar ter-update
        if ($request->status === 'disetujui') {
            $siswa = $perpindahan->siswa;

            // Debugging sementara
            if ($siswa) {
                $siswa->kelas_id = $perpindahan->kelas_tujuan_id;
                $siswa->save();
            }
        }

        return redirect()->route('admin.pindah-kelas.index')->with('success', 'Status perpindahan diperbarui.');
    }
}
