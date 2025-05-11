<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use App\Models\JenisPengeluaran; // Pastikan model diimpor
use App\Models\TahunAjaran;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class JenisPengeluaranController extends Controller{
    public function showDatas()
    {
        $all_data = DB::table('jenispengeluaran')
            ->join('unitpendidikan', 'jenispengeluaran.idunitpendidikan', '=', 'unitpendidikan.id')
            ->join('tahunajaran', 'jenispengeluaran.id_tahunajaran', '=', 'tahunajaran.id')
            ->select(
                'jenispengeluaran.nama_pengeluaran',
                'jenispengeluaran.type',
                'tahunajaran.tahun_ajaran',
                'jenispengeluaran.nominal_jenispengeluaran',
                'jenispengeluaran.status',
                'unitpendidikan.namaUnit' // Tambahkan namaUnit dari unitpendidikan
            )
            ->get(); // Mengambil semua data
            $filtered_data = DB::table('jenispengeluaran')
            ->join('unitpendidikan', 'jenispengeluaran.idunitpendidikan', '=', 'unitpendidikan.id')
            ->join('tahunajaran', 'jenispengeluaran.id_tahunajaran', '=', 'tahunajaran.id')
            ->select('jenispengeluaran.*', 'unitpendidikan.namaUnit','tahunajaran.tahun_ajaran')
            ->get();
    
        return view('admin.jenis-pengeluaran', compact('all_data','filtered_data'));
    }

   

    public function filterDatas(Request $request)
{
    $unitId = $request->input('unitpendidikan');  // Ambil nilai dari filter unitpendidikan
    $status = $request->input('status');  // Ambil nilai dari filter status

    // Query dasar dengan join tabel terkait
    $query = DB::table('jenispengeluaran')
        ->join('unitpendidikan', 'jenispengeluaran.idunitpendidikan', '=', 'unitpendidikan.id')
        ->join('tahunajaran', 'jenispengeluaran.id_tahunajaran', '=', 'tahunajaran.id')
        ->select('jenispengeluaran.*', 'unitpendidikan.namaUnit', 'tahunajaran.tahun_ajaran');

    // Tambahkan filter jika ada input dari request
    if (!empty($unitId)) {
        $query->where('jenispengeluaran.idunitpendidikan', '=', $unitId);
    }
    if (!empty($status)) {
        $query->where('jenispengeluaran.status', '=', $status);
    }

    // Eksekusi query dan ambil hasilnya
    $filtered_data = $query->get();

    // Ambil daftar unit pendidikan untuk dropdown
    $unitpendidikan = DB::table('unitpendidikan')->select('id', 'namaUnit')->get();

    return view('admin.jenis-pengeluaran', compact('filtered_data', 'unitpendidikan', 'unitId', 'status'), ['title' => 'Manage Jenis Pengeluaran']);
}

    

    public function creates() {  
        $tahunAjaran = TahunAjaran::where('status', 'Aktif')->get(['tahun_ajaran', 'id']);
         return view('admin.create-jenis-pengeluaran', compact('tahunAjaran'));
    }
    

public function stores(Request $request): RedirectResponse
{
    // Validasi input
    $request->validate([
        'nama_pengeluaran' => 'required',
        'type' => 'required',
        'id_tahunajaran' => 'required',
        'nominal_jenispengeluaran' => 'required|numeric',
        'status' => 'required',
        'idunitpendidikan' => 'required',
    ]);

    // Cek apakah data sudah ada
    $exists = JenisPengeluaran::where('nama_pengeluaran', $request->nama_pengeluaran)
        ->where('type', $request->type)
        ->where('id_tahunajaran', $request->id_tahunajaran)
        ->where('nominal_jenispengeluaran', $request->nominal_jenispengeluaran)
        ->where('status', $request->status)
        ->where('idunitpendidikan', $request->idunitpendidikan)
        ->exists();

    if ($exists) {
        // Jika data sudah ada, kembalikan pesan error
        return redirect()->back()->withErrors('Data sudah ada! Silakan masukkan data yang berbeda.');
    }

    // Jika data belum ada, simpan ke database
    $jenispengeluaran = JenisPengeluaran::create([
        'nama_pengeluaran' => $request->nama_pengeluaran,
        'type' => $request->type,
        'id_tahunajaran' => $request->id_tahunajaran,
        'nominal_jenispengeluaran' => $request->nominal_jenispengeluaran,
        'status' => $request->status,
        'idunitpendidikan' => $request->idunitpendidikan,
    ]);

    // Trigger event jika diperlukan
    event(new Registered($jenispengeluaran));

    // Redirect ke halaman manajemen jenis pengeluaran dengan pesan sukses
    return redirect(route('admin.jenis-pengeluaran', absolute: false))
        ->with('success', 'Data berhasil ditambahkan!');
}

public function editDatas($id)
{
    // Ambil data jenis pengeluaran yang akan diedit
    $jenispengeluaran = DB::table('jenispengeluaran')
        ->join('unitpendidikan', 'jenispengeluaran.idunitpendidikan', '=', 'unitpendidikan.id')
        ->join('tahunajaran', 'jenispengeluaran.id_tahunajaran', '=', 'tahunajaran.id')
        ->select(
            'jenispengeluaran.id',
            'jenispengeluaran.nama_pengeluaran',
            'jenispengeluaran.type',
            'tahunajaran.tahun_ajaran',
            'jenispengeluaran.nominal_jenispengeluaran',
            'jenispengeluaran.status',
            'unitpendidikan.namaUnit',
            'unitpendidikan.id as idunitpendidikan', // Pastikan ini benar
            'jenispengeluaran.id_tahunajaran' // Ambil id_tahunajaran untuk set selected option
        )
        ->where('jenispengeluaran.id', '=', $id) // Perbaikan di sini
        ->first();

    // Ambil daftar unit pendidikan
    $unitpendidikan = DB::table('unitpendidikan')->get(['id', 'namaUnit']);

    // Ambil tahun ajaran yang statusnya Aktif
    $tahunAjaran = TahunAjaran::where('status', 'Aktif')->get(['id', 'tahun_ajaran']);

    return view('admin.edit-jenis-pengeluaran', compact('jenispengeluaran', 'unitpendidikan', 'tahunAjaran'), ['title' => 'Edit Jenis Pengeluaran']);
}

public function updateDatas(Request $request, $id)
{
    // Validasi input
    $validatedData = $request->validate([
        'nama_pengeluaran' => 'required|string',
        'type' => 'required|string',
        'id_tahunajaran' => 'required|numeric',
        'nominal_jenispengeluaran' => 'required|numeric',
        'status' => 'required|string',
        'idunitpendidikan' => 'required|numeric',
    ]);

    // Lakukan update data
    DB::table('jenispengeluaran')
        ->where('id', '=', $id)
        ->update([
            'nama_pengeluaran' => $validatedData['nama_pengeluaran'],
            'type' => $validatedData['type'],
            'id_tahunajaran' => $validatedData['id_tahunajaran'],
            'nominal_jenispengeluaran' => $validatedData['nominal_jenispengeluaran'],
            'status' => $validatedData['status'],
            'idunitpendidikan' => $validatedData['idunitpendidikan'], // Perbaikan
        ]);


    return redirect()->route('admin.jenis-pengeluaran')->with('success', 'Data berhasil diperbarui!');
}



} 


?>