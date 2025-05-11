<?php

namespace App\Http\Controllers\Admin\auth;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\UnitPendidikan;
use App\Imports\SiswaImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;


class SiswaController extends Controller
{

    function createSiswa () {
        $kelas = Kelas::all();
        $unitpendidikan = UnitPendidikan::all();
        return view("admin.create-data-siswa", compact('kelas', 'unitpendidikan'));
    }

    function submitSiswa (Request $request)
    {
        $siswas = new Siswa();
        $siswas->nis = $request->nis;
        $siswas->nisn = $request->nisn;
        $siswas->nama = $request->nama;
        $siswas->jenis_kelamin = $request->jenis_kelamin;
        $siswas->kelas_id = $request->kelas_id;
        $siswas->agama = $request->agama;
        $siswas->namaOrtu = $request->namaOrtu;
        $siswas->alamatOrtu = $request->alamatOrtu;
        $siswas->noTelp = $request->noTelp;
        $siswas->email = $request->email;
        $siswas->unitpendidikan_id = $request->unitpendidikan_id;
        $siswas->unitpendidikan_idInformal = $request->unitpendidikan_idInformal;
        $siswas->unitpendidikan_idPondok = $request->unitpendidikan_idPondok;
        // $siswas->unitPendidikanInformal = $request->unitPendidikanInformal;
        // $siswas->statusPondok = $request->statusPondok;
        $siswas->status = $request->status;
        $siswas->save();

        return redirect()->route('admin.manage-data-siswa');

    }

    function editSiswa ($id) {
        $kelas = Kelas::all();
        $unitpendidikan = UnitPendidikan::all();
        $siswas = Siswa::with('kelas', 'unitpendidikan')->find($id);
        return view('admin.edit-data-siswa', compact('siswas', 'kelas', 'unitpendidikan'));
    }

    function updateSiswa (Request $request, $id) {
        $siswas = Siswa::find($id);
        $siswas->nis = $request->nis;
        $siswas->nisn = $request->nisn;
        $siswas->nama = $request->nama;
        $siswas->jenis_kelamin = $request->jenis_kelamin;
        $siswas->kelas_id = $request->kelas_id;
        $siswas->agama = $request->agama;
        $siswas->namaOrtu = $request->namaOrtu;
        $siswas->alamatOrtu = $request->alamatOrtu;
        $siswas->noTelp = $request->noTelp;
        $siswas->email = $request->email;
        $siswas->unitpendidikan_id = $request->unitpendidikan_id;
        $siswas->unitpendidikan_idInformal = $request->unitpendidikan_idInformal;
        $siswas->unitpendidikan_idPondok = $request->unitpendidikan_idPondok;
        // $siswas->unitPendidikanInformal = $request->unitPendidikanInformal;
        // $siswas->statusPondok = $request->statusPondok;
        $siswas->status = $request->status;
        $siswas->update();

        return redirect()->route('admin.manage-data-siswa');

    }

    public function detailSiswa($id)
    {
        // Ambil data siswa berdasarkan ID
        $siswas = Siswa::findorFail($id);
        $unitpendidikan = UnitPendidikan::all();

        // Return view ke halaman detail data siswa
        return view('admin.detail-data-siswa', compact('siswas', 'unitpendidikan'));
    }

    public function importData(Request $request)
    {
        $data = $request->file('file');

        $namaFile = $data->getClientOriginalName();
        $data->move('DataSiswa', $namaFile);

        Excel::import(new SiswaImport, \public_path('/DataSiswa/' . $namaFile));
        return redirect()->route('admin.manage-data-siswa');
    }

    public function index(Request $request)
    {
        // Query untuk mengambil data siswa
        $query = Siswa::with('kelas', 'unitpendidikan');
        // Filter berdasarkan nama atau NIS
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('nama', 'like', "%{$search}%")
                ->orWhere('nis', 'like', "%{$search}%");
        }
        // Filter berdasarkan status
        if ($request->has('status') && $request->status != 'Pilih Status') {
            $query->where('status', $request->status);
        }
        // Filter berdasarkan kelas
        if ($request->has('kelas_id') && $request->kelas_id != '') {
            $query->where('kelas_id', $request->kelas_id);
        }
        // Ambil data dengan pagination
        $siswas = $query->paginate(10);
        // Ambil data kelas untuk dropdown
        $kelas = Kelas::all();
        $unitpendidikan = UnitPendidikan::all();
        return view('admin.manage-data-siswa', compact('siswas', 'kelas', 'unitpendidikan'));
    }
}