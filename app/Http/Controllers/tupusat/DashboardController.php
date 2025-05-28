<?php

namespace App\Http\Controllers\tupusat;

use App\Http\Controllers\Controller;
use App\Models\Tabungan;
use App\Models\Siswa;
use App\Models\UnitPendidikan;
use App\Models\TransaksiTabungan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        // Ambil setoran per bulan dari transaksi (hanya tabungan yang statusnya aktif)
        $setoranTransaksi = TransaksiTabungan::join('tabungans', 'transaksi_tabungans.tabungan_id', '=', 'tabungans.id')
            ->where('transaksi_tabungans.jenis_transaksi', 'Setoran')
            ->where('tabungans.status', 'Aktif')
            ->selectRaw('MONTH(transaksi_tabungans.created_at) as month, SUM(transaksi_tabungans.jumlah) as total')
            ->groupBy(\DB::raw('MONTH(transaksi_tabungans.created_at)'))
            ->pluck('total', 'month');

        // Ambil saldo_awal tabungan dan kelompokkan berdasarkan bulan (hanya tabungan yang statusnya aktif)
        $setoranAwal = Tabungan::where('status', 'Aktif')
            ->selectRaw('MONTH(created_at) as month, SUM(saldo_awal) as total')
            ->groupBy(\DB::raw('MONTH(created_at)'))
            ->pluck('total', 'month');

        // Gabungkan keduanya: setoran transaksi + saldo awal
        $setoranGabungan = [];
        for ($i = 1; $i <= 12; $i++) {
            $transaksi = $setoranTransaksi->get($i, 0);
            $awal = $setoranAwal->get($i, 0);
            $setoranGabungan[] = $transaksi + $awal;
        }

        // Penarikan hanya dari tabungan yang statusnya aktif
        $penarikanData = TransaksiTabungan::join('tabungans', 'transaksi_tabungans.tabungan_id', '=', 'tabungans.id')
            ->where('transaksi_tabungans.jenis_transaksi', 'Penarikan')
            ->where('tabungans.status', 'Aktif')
            ->selectRaw('MONTH(transaksi_tabungans.created_at) as month, SUM(transaksi_tabungans.jumlah) as total')
            ->groupBy(\DB::raw('MONTH(transaksi_tabungans.created_at)'))
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
