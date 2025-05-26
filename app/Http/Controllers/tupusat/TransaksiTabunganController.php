<?php

namespace App\Http\Controllers\tupusat;

use App\Http\Controllers\Controller;
use App\Models\Tabungan;
use App\Models\TransaksiTabungan;
use Illuminate\Http\Request;

class TransaksiTabunganController extends Controller
{
    public function create($tabungan_id)
    {
        $tabungan = Tabungan::findOrFail($tabungan_id);
        return view('tupusat.transaksi.create', compact('tabungan'));
    }

    public function store(Request $request, $tabungan_id)
    {
        $request->validate([
            'jenis_transaksi' => 'required|in:Setoran,Penarikan',
            'jumlah' => 'required|numeric|min:100',
            'tanggal' => 'required|date',
            'keterangan' => 'nullable|string'
        ]);

        $tabungan = Tabungan::findOrFail($tabungan_id);

        // Validasi saldo jika penarikan
        if ($request->jenis_transaksi == 'Penarikan') {
            $saldo = $tabungan->saldo_akhir; // accessor dari model
            if ($request->jumlah > $saldo) {
                return back()->withErrors(['jumlah' => 'Saldo tidak mencukupi.']);
            }
        }

        TransaksiTabungan::create([
            'tabungan_id' => $tabungan->id,
            'jenis_transaksi' => $request->jenis_transaksi,
            'jumlah' => $request->jumlah,
            'tanggal' => $request->tanggal,
            'keterangan' => $request->keterangan,
            'username' => $request->username, // <- Pastikan ini disimpan
        ]);

        return redirect()->route('tabungan.show', $tabungan->id)->with('success', 'Transaksi berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $transaksi = TransaksiTabungan::with('tabungan.siswa')->findOrFail($id);
        return view('tupusat.transaksi.edit', compact('transaksi'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'jenis_transaksi' => 'required|in:Setoran,Penarikan',
            'jumlah' => 'required|numeric|min:100',
            'tanggal' => 'required|date',
            'keterangan' => 'nullable|string'
        ]);

        $transaksi = TransaksiTabungan::findOrFail($id);
        $transaksi->update($request->all());

        return redirect()->route('tabungan.show', $transaksi->tabungan_id)->with('success', 'Transaksi berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $transaksi = TransaksiTabungan::findOrFail($id);
        $tabunganId = $transaksi->tabungan_id;
        $transaksi->delete();

        return redirect()->route('tabungan.show', $tabunganId)->with('success', 'Transaksi berhasil dihapus.');
    }
}
