<?php

namespace App\Http\Controllers\tupusat;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use App\Models\Tabungan;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\TabunganExport;
use App\Exports\AllTabunganExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class TabunganController extends Controller
{
    // Menampilkan semua tabungan (bisa difilter berdasarkan unit)
    public function index(Request $request)
    {
        $query = Tabungan::with(['siswa.kelas.unitpendidikan']); // Eager load relasi siswa -> kelas -> unit

        if ($request->has('trashed') && $request->trashed == true) {
            $query->onlyTrashed();
        }
        
        // Filter berdasarkan nama siswa
        if ($request->has('search') && $request->search != '') {
            $query->whereHas('siswa', function ($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->search . '%');
            });
        }

        // Filter berdasarkan status
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        if ($request->has('unit') && $request->unit != '') {
            $query->whereHas('siswa.kelas.unitpendidikan', function ($q) use ($request) {
                $q->where('id', $request->unit);
            });
        }
        
        if ($request->has('kelas') && $request->kelas != '') {
            $query->whereHas('siswa.kelas', function ($q) use ($request) {
                $q->where('id', $request->kelas);
            });
        }
        

        // Ambil data dan paginate
        $tabungans = $query->paginate(20);

        // Ambil data untuk dropdown filter
        $units = \App\Models\UnitPendidikan::all();
        $kelasList = \App\Models\Kelas::all();

        return view('tupusat.tabungan.index', compact('tabungans', 'units', 'kelasList'));
    }

    // Detail tabungan per siswa
    public function show($id, Request $request)
    {
    $tabungan = Tabungan::with('siswa')->findOrFail($id);

    $transaksiQuery = $tabungan->transaksi()->orderBy('tanggal', 'asc');

    if ($request->filled('start') && $request->filled('end')) {
        $transaksiQuery->whereBetween('tanggal', [$request->start, $request->end]);
    }

    $transaksi = $transaksiQuery->get();

    // Grafik: Group transaksi per bulan
    $chartData = $tabungan->transaksi()
        ->selectRaw("DATE_FORMAT(tanggal, '%Y-%m') as bulan, 
                     SUM(CASE WHEN jenis_transaksi = 'Setoran' THEN jumlah ELSE 0 END) as total_setoran,
                     SUM(CASE WHEN jenis_transaksi = 'Penarikan' THEN jumlah ELSE 0 END) as total_penarikan")
        ->groupBy('bulan')
        ->orderBy('bulan')
        ->get();

    return view('tupusat.tabungan.show', compact('tabungan', 'transaksi', 'chartData'));
    }

    // Membuat tabungan baru untuk siswa (jika belum punya)
    public function create()
    {
        $siswas = Siswa::doesntHave('tabungan')->get();
        return view('tupusat.tabungan.create', compact('siswas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'siswa_id' => 'required|exists:siswas,id',
            'saldo_awal' => 'required|numeric|min:0'
        ]);

        Tabungan::create([
            'siswa_id' => $request->siswa_id,
            'saldo_awal' => $request->saldo_awal,
            'status' => 'Aktif'
        ]);

        return redirect()->route('tupusat.tabungan.index')->with('success', 'Tabungan berhasil dibuat.');
    }

    public function exportPdf($id)
    {
    $tabungan = Tabungan::with(['siswa', 'transaksi'])->findOrFail($id);
    $pdf = Pdf::loadView('tupusat.tabungan.export_pdf', compact('tabungan'));
    return $pdf->download('Laporan_Tabungan_' . $tabungan->siswa->nama . '.pdf');
    }

    public function exportAll()
    {
    return Excel::download(new AllTabunganExport, 'rekap_semua_tabungan.xlsx');
    }

    public function destroy($id)
    {
    $tabungan = Tabungan::findOrFail($id);
    $tabungan->delete(); // <- ini akan soft delete
    return back()->with('success', 'Tabungan berhasil dihapus (soft delete).');
    }

    public function restore($id)
    {
    $tabungan = Tabungan::onlyTrashed()->findOrFail($id);
    $tabungan->restore();

    return back()->with('success', 'Data tabungan berhasil dipulihkan.');
    }

}