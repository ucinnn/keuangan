<?php

namespace App\Http\Controllers\Admin\auth;

use App\Http\Controllers\Controller;
use App\Models\UnitPendidikan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UnitPendidikanController extends Controller
{
    public function index(Request $request)
    {
        // Contoh data Nama Unit Pendidikan
        $namaUnitList = ['-','TK', 'SD', 'SMP', 'SMA', 'MADIN', 'TPQ', 'YA PONDOK', 'TIDAK PONDOK'];
    
        // Data kategori untuk filter
        $kategoriList = ['-','Formal', 'Informal', 'Pondok'];
    
        // Ambil data dari database (opsional, sesuai kebutuhan)
        $unitpendidikan = UnitPendidikan::query();
    
        // Filter berdasarkan input pengguna
        if ($request->filled('kategori')) {
            $kategoriFilter = is_array($request->kategori) ? $request->kategori : explode(',', $request->kategori);
            $unitpendidikan->whereIn('kategori', $kategoriFilter);
        }
        if ($request->filled('namaUnit')) {
            $unitpendidikan->where('namaUnit', $request->namaUnit);
        }
        if ($request->filled('status')) {
            $unitpendidikan->where('status', $request->status);
        }
        if ($request->filled('search')) {
            $unitpendidikan->where(function ($query) use ($request) {
                $query->where('namaUnit', 'like', '%' . $request->search . '%')
                      ->orWhere('kategori', 'like', '%' . $request->search . '%')
                      ->orWhere('status', 'like', '%' . $request->search . '%');
            });
        }
    
        // Ambil data setelah filter
        $unitpendidikan = $unitpendidikan->get();
    
        // Kirim data ke view
        return view('admin.manage-unit-pendidikan', compact('namaUnitList', 'kategoriList', 'unitpendidikan'));
    }
    function createUnitPendidikan () {
        return view("admin.create-manage-unit-pendidikan");
    }
    function submitUnitPendidikan (Request $request)
    {
        $unitpendidikan = new UnitPendidikan();
        $unitpendidikan->kategori = $request->kategori;
        $unitpendidikan->namaUnit = $request->namaUnit;
        $unitpendidikan->status = $request->status;
        $unitpendidikan->save();

        return redirect()->route('admin.manage-unit-pendidikan');
    }

    function editUnitPendidikan ($id) {
        $unitpendidikan = UnitPendidikan::find($id);
        return view('admin.edit-manage-unit-pendidikan', compact('unitpendidikan'));
    }

    function updateUnitPendidikan (Request $request, $id) {
        $unitpendidikan = UnitPendidikan::find($id);
        $unitpendidikan->kategori = $request->kategori;
        $unitpendidikan->namaUnit = $request->namaUnit;
        $unitpendidikan->status = $request->status;
        $unitpendidikan->update();

        return redirect()->route('admin.manage-unit-pendidikan');
    }

    function deleteUnitPendidikan ($id) {
        $unitpendidikan = UnitPendidikan::find($id);
        $unitpendidikan->delete();
        return redirect()->route('admin.manage-unit-pendidikan')->with('success', 'Data Unit Pendidikan berhasil dihapus.');
    }
}