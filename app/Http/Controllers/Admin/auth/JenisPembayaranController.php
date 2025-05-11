<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use App\Models\JenisPembayaran; // Pastikan model diimpor
use App\Models\TahunAjaran;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class JenisPembayaranController extends Controller{
    public function showData()
    {
        $all_data = DB::table('jenispembayaran')
            ->join('unitpendidikan', 'jenispembayaran.idunitpendidikan', '=', 'unitpendidikan.id')
            ->join('tahunajaran', 'jenispembayaran.id_tahunajaran', '=', 'tahunajaran.id')
            ->select(
                'jenispembayaran.nama_pembayaran',
                'jenispembayaran.type',
                'tahunajaran.tahun_ajaran',
                'jenispembayaran.nominal_jenispembayaran',
                'jenispembayaran.status',
                'unitpendidikan.namaUnit' // Tambahkan namaUnit dari unitpendidikan
            )
            ->get(); // Mengambil semua data
            $filtered_data = DB::table('jenispembayaran')
            ->join('unitpendidikan', 'jenispembayaran.idunitpendidikan', '=', 'unitpendidikan.id')
            ->join('tahunajaran', 'jenispembayaran.id_tahunajaran', '=', 'tahunajaran.id')
            ->select('jenispembayaran.*', 'unitpendidikan.namaUnit','tahunajaran.tahun_ajaran')
            ->get();
    
        return view('admin.manage-jenis-pembayaran', compact('all_data','filtered_data'));
    }

   

    public function filterData(Request $request)
{
    $unitId = $request->input('unitpendidikan');  // Ambil nilai dari filter unitpendidikan
    $status = $request->input('status');  // Ambil nilai dari filter status

    // Query dasar dengan join tabel terkait
    $query = DB::table('jenispembayaran')
        ->join('unitpendidikan', 'jenispembayaran.idunitpendidikan', '=', 'unitpendidikan.id')
        ->join('tahunajaran', 'jenispembayaran.id_tahunajaran', '=', 'tahunajaran.id')
        ->select('jenispembayaran.*', 'unitpendidikan.namaUnit', 'tahunajaran.tahun_ajaran');

    // Tambahkan filter jika ada input dari request
    if (!empty($unitId)) {
        $query->where('jenispembayaran.idunitpendidikan', '=', $unitId);
    }
    if (!empty($status)) {
        $query->where('jenispembayaran.status', '=', $status);
    }

    // Eksekusi query dan ambil hasilnya
    $filtered_data = $query->get();

    // Ambil daftar unit pendidikan untuk dropdown
    $unitpendidikan = DB::table('unitpendidikan')->select('id', 'namaUnit')->get();

    return view('admin.manage-jenis-pembayaran', compact('filtered_data', 'unitpendidikan', 'unitId', 'status'), ['title' => 'Manage Jenis Pembayaran']);
}

    

    public function create() {  
        $tahunAjaran = TahunAjaran::where('status', 'Aktif')->get(['tahun_ajaran', 'id']);
         return view('admin.create-jenis-pembayaran', compact('tahunAjaran'));
    }
    

public function store(Request $request): RedirectResponse
{
    // Validasi input
    $request->validate([
        'nama_pembayaran' => 'required',
        'type' => 'required',
        'id_tahunajaran' => 'required',
        'nominal_jenispembayaran' => 'required|numeric',
        'status' => 'required',
        'idunitpendidikan' => 'required',
    ]);

    // Cek apakah data sudah ada
    $exists = JenisPembayaran::where('nama_pembayaran', $request->nama_pembayaran)
        ->where('type', $request->type)
        ->where('id_tahunajaran', $request->id_tahunajaran)
        ->where('nominal_jenispembayaran', $request->nominal_jenispembayaran)
        ->where('status', $request->status)
        ->where('idunitpendidikan', $request->idunitpendidikan)
        ->exists();

    if ($exists) {
        // Jika data sudah ada, kembalikan pesan error
        return redirect()->back()->withErrors('Data sudah ada! Silakan masukkan data yang berbeda.');
    }

    // Jika data belum ada, simpan ke database
    $jenispembayaran = JenisPembayaran::create([
        'nama_pembayaran' => $request->nama_pembayaran,
        'type' => $request->type,
        'id_tahunajaran' => $request->id_tahunajaran,
        'nominal_jenispembayaran' => $request->nominal_jenispembayaran,
        'status' => $request->status,
        'idunitpendidikan' => $request->idunitpendidikan,
    ]);

    // Trigger event jika diperlukan
    event(new Registered($jenispembayaran));

    // Redirect ke halaman manajemen jenis pembayaran dengan pesan sukses
    return redirect(route('admin.manage-jenis-pembayaran', absolute: false))
        ->with('success', 'Data berhasil ditambahkan!');
}

public function editData($id)
{
    // Ambil data jenis pembayaran yang akan diedit
    $jenispembayaran = DB::table('jenispembayaran')
        ->join('unitpendidikan', 'jenispembayaran.idunitpendidikan', '=', 'unitpendidikan.id')
        ->join('tahunajaran', 'jenispembayaran.id_tahunajaran', '=', 'tahunajaran.id')
        ->select(
            'jenispembayaran.idjenispembayaran',
            'jenispembayaran.nama_pembayaran',
            'jenispembayaran.type',
            'tahunajaran.tahun_ajaran',
            'jenispembayaran.nominal_jenispembayaran',
            'jenispembayaran.status',
            'unitpendidikan.namaUnit',
            'unitpendidikan.id as idunitpendidikan', // Pastikan ini benar
            'jenispembayaran.id_tahunajaran' // Ambil id_tahunajaran untuk set selected option
        )
        ->where('idjenispembayaran', '=', $id)
        ->first();

    // Ambil daftar unit pendidikan
    $unitpendidikan = DB::table('unitpendidikan')->get(['id', 'namaUnit']);

    // Ambil tahun ajaran yang statusnya Aktif
    $tahunAjaran = TahunAjaran::where('status', 'Aktif')->get(['id', 'tahun_ajaran']);

    return view('admin.edit-jenis-pembayaran', compact('jenispembayaran', 'unitpendidikan', 'tahunAjaran'), ['title' => 'Edit Jenis Pembayaran']);
}

public function updateData(Request $request, $id)
{
    // Validasi input
    $validatedData = $request->validate([
        'nama_pembayaran' => 'required|string',
        'type' => 'required|string',
        'id_tahunajaran' => 'required|numeric',
        'nominal_jenispembayaran' => 'required|numeric',
        'status' => 'required|string',
        'idunitpendidikan' => 'required|numeric',
    ]);

    // Lakukan update data
    DB::table('jenispembayaran')
        ->where('idjenispembayaran', '=', $id)
        ->update([
            'nama_pembayaran' => $validatedData['nama_pembayaran'],
            'type' => $validatedData['type'],
            'id_tahunajaran' => $validatedData['id_tahunajaran'],
            'nominal_jenispembayaran' => $validatedData['nominal_jenispembayaran'],
            'status' => $validatedData['status'],
            'idunitpendidikan' => $validatedData['idunitpendidikan'], // Perbaikan
        ]);


    return redirect()->route('admin.manage-jenis-pembayaran')->with('success', 'Data berhasil diperbarui!');
}



} 


?>