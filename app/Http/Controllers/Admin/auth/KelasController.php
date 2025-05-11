<?php

namespace App\Http\Controllers\Admin\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kelas;  // Perbaiki ini untuk memanggil model Kelas yang benar
use App\Models\UnitPendidikan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class KelasController extends Controller
{
    public function index()
            {
                $kelas = Kelas::all();  // Pastikan data kelas ada
                return view('admin.manage-kelas', compact('kelas'));
            }


    public function create()
    {
        $unitpendidikan = UnitPendidikan::all();
        return view('admin.create-kelas', compact('unitpendidikan'));
    }

    public function editt($id)
    {
        $unitpendidikan = UnitPendidikan::all();
        $kelas = Kelas::with('unitpendidikan')->find($id);
        return view('admin.edit-kelas', compact('kelas', 'unitpendidikan'));
    }

    public function updatee(Request $request, $id)
    {
        $kelas = kelas::findorFail($id);
        $kelas->update($request->all());
        return redirect()->route('admin.manage-kelas', $id)->with('success', 'Data berhasil di edit');
    }



    public function store(Request $request)
    {
        \Log::info($request->all());

        // Validate the request data
        $validated = $request->validate([
            'unitpendidikan_id' => 'required',
            'nama_kelas' => 'required|string|max:20',
            'status' => 'required|in:AKTIF,TIDAK AKTIF',
            'grade' => 'required|in:-,A,B,C,D,E,F',
            'keterangan' => 'required|string|max:500',
        ]);

        // Create a new record in the 'kelas' table
        $kelas = Kelas::create([  
            'unitpendidikan_id' => $validated['unitpendidikan_id'],
            'nama_kelas' => $validated['nama_kelas'],
            'status' => $validated['status'],
            'grade' => $validated['grade'],
            'keterangan' => $validated['keterangan'],
            
        ]);

        return redirect()->route('admin.manage-kelas', compact('kelas'))->with('success', 'Kelas berhasil ditambah');
    }
}























// public function store(Request $request)
// {
//     Kelas::create($request->all());
//     return redirect()->route('admin.manage-kelas')->with('success', 'Kelas berhasil ditambahkan');
// }

// public function edit($id)
// {
//     $kelas = Kelas::find($id);
//     return view('admin.edit-kelas', compact('kelas'));
// }

// public function update(Request $request, $id)
// {
//     $kelas = Kelas::find($id);
//     $kelas->update($request->all());
    
// }

// }