<?php

namespace App\Http\Controllers\tupusat;

use App\Http\Controllers\Controller;
use App\Models\Tabungan;
use App\Models\Siswa;
use App\Models\UnitPendidikan;
use App\Models\TransaksiTabungan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Jumlah siswa aktif di seluruh unit pendidikan
        $siswaAktif = Siswa::where('status', 'Aktif')->count();
        
        // Total saldo awal tabungan di seluruh unit pendidikan
        $totalSaldoAwal = Tabungan::where('status', 'Aktif')->sum('saldo_awal');
        
        // Total saldo akhir tabungan (hitung saldo akhir untuk setiap tabungan)
        $totalSaldoAkhir = Tabungan::where('status', 'Aktif')->get()->sum(function ($tabungan) {
            return $tabungan->saldo_akhir;  // Mengambil saldo akhir per tabungan
        });
        
        // Jumlah unit pendidikan yang aktif
        $totalUnit = UnitPendidikan::where('status', 'Aktif')->count();
        
        // Jumlah siswa aktif per unit pendidikan
        $siswaPerUnit = Siswa::select('unitpendidikan_id', \DB::raw('count(*) as total_siswa'))
            ->where('status', 'Aktif')
            ->groupBy('unitpendidikan_id')
            ->get();
    
        // Data untuk grafik setoran vs penarikan per bulan
        $setoranData = TransaksiTabungan::where('jenis_transaksi', 'Setoran')
            ->selectRaw('MONTH(tanggal) as month, SUM(jumlah) as total')
            ->groupBy(\DB::raw('MONTH(tanggal)'))
            ->pluck('total', 'month');
            
        $penarikanData = TransaksiTabungan::where('jenis_transaksi', 'Penarikan')
            ->selectRaw('MONTH(tanggal) as month, SUM(jumlah) as total')
            ->groupBy(\DB::raw('MONTH(tanggal)'))
            ->pluck('total', 'month');
    
        // Format data untuk chart (misal, bulan 1-12)
        $labels = range(1, 12);
        $setoranDataFormatted = [];
        $penarikanDataFormatted = [];
    
        foreach ($labels as $month) {
            $setoranDataFormatted[] = $setoranData->get($month, 0);
            $penarikanDataFormatted[] = $penarikanData->get($month, 0);
        }
    
        return view('tupusat.dashboard.index', compact(
            'siswaAktif',
            'totalSaldoAwal',
            'totalSaldoAkhir',
            'totalUnit',
            'siswaPerUnit',
            'labels', 
            'setoranDataFormatted',  // Menggunakan setoranDataFormatted
            'penarikanDataFormatted' // Menggunakan penarikanDataFormatted
        ));
    }
}