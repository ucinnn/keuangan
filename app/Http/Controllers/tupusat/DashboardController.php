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
        $siswaAktif = Siswa::where('status', 'Aktif')->count();

        $totalSaldoAwal = Tabungan::where('status', 'Aktif')->sum('saldo_awal');

        $totalSaldoAkhir = Tabungan::where('status', 'Aktif')->get()->sum(function ($tabungan) {
            return $tabungan->saldo_akhir;
        });

        $totalUnit = UnitPendidikan::where('status', 'Aktif')->count();

        $siswaPerUnit = Siswa::select('unitpendidikan_id', \DB::raw('count(*) as total_siswa'))
            ->where('status', 'Aktif')
            ->groupBy('unitpendidikan_id')
            ->get();

        // Ambil setoran per bulan dari transaksi
        $setoranTransaksi = TransaksiTabungan::where('jenis_transaksi', 'Setoran')
            ->selectRaw('MONTH(created_at) as month, SUM(jumlah) as total')
            ->groupBy(\DB::raw('MONTH(created_at)'))
            ->pluck('total', 'month');

        // Ambil saldo_awal tabungan dan kelompokkan berdasarkan bulan
        $setoranAwal = Tabungan::selectRaw('MONTH(created_at) as month, SUM(saldo_awal) as total')
            ->groupBy(\DB::raw('MONTH(created_at)'))
            ->pluck('total', 'month');

        // Gabungkan keduanya: setoran transaksi + saldo awal
        $setoranGabungan = [];
        for ($i = 1; $i <= 12; $i++) {
            $transaksi = $setoranTransaksi->get($i, 0);
            $awal = $setoranAwal->get($i, 0);
            $setoranGabungan[] = $transaksi + $awal;
        }

        // Penarikan tetap sama
        $penarikanData = TransaksiTabungan::where('jenis_transaksi', 'Penarikan')
            ->selectRaw('MONTH(created_at) as month, SUM(jumlah) as total')
            ->groupBy(\DB::raw('MONTH(created_at)'))
            ->pluck('total', 'month');

        $penarikanDataFormatted = [];
        for ($i = 1; $i <= 12; $i++) {
            $penarikanDataFormatted[] = $penarikanData->get($i, 0);
        }

        $labels = range(1, 12);

        return view('tupusat.dashboard.index', compact(
            'siswaAktif',
            'totalSaldoAwal',
            'totalSaldoAkhir',
            'totalUnit',
            'siswaPerUnit',
            'labels',
            'setoranGabungan',
            'penarikanDataFormatted'
        ));
    }
}
