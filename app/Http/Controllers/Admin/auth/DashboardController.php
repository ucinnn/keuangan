<?php

namespace App\Http\Controllers\Admin\auth;

use App\Models\Kelas;
use App\Models\User;
use App\Models\Siswa;
use App\Models\UnitPendidikan;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{


    public function showUser()
    {
        // total user
        $users = User::count();
        $siswa = Siswa::count();

        $roleAdmin = User::where('role', '=', 'admin')->count();
        $roleTuunit = User::where('role', '=', 'tuunit')->count();
        $roleTupusat = User::where('role', '=', 'tupusat')->count();

        $listOfAllRole = [
            "admin" => $roleAdmin,
            "tuunit" => $roleTuunit,
            "tupusat" => $roleTupusat,
        ];

        $nama_unitTk = User::where('namaUnit', '=', '2')->count();
        $nama_unitSd = User::where('namaUnit', '=', '3')->count();
        $nama_unitSmp = User::where('namaUnit', '=', '4')->count();
        $nama_unitSma = User::where('namaUnit', '=', '5')->count();
        $nama_unitMadin = User::where('namaUnit', '=', '6')->count();
        $nama_unitTpq = User::where('namaUnit', '=', '7')->count();
        $nama_unitPondok = User::where('namaUnit', '=', '8')->count();

        $listOfAllUnit = [
            "TK" => $nama_unitTk,
            "SD" => $nama_unitSd,
            "SMP" => $nama_unitSmp,
            "SMA" => $nama_unitSma,
            "MADIN" => $nama_unitMadin,
            "TPQ" => $nama_unitTpq,
            "PONDOK" => $nama_unitPondok,
        ];
        $unitTk = Siswa::where('unitpendidikan_id', '=', '2')->count();
        $unitSd = Siswa::where('unitpendidikan_id', '=', '3')->count();
        $unitSmp = Siswa::where('unitpendidikan_id',  '=', '4')->count();
        $unitSma = Siswa::where('unitpendidikan_id', '=', '5')->count();
        $unitMadin = Siswa::where('unitpendidikan_idInformal', '=', '6')->count();
        $unitTpq = Siswa::where('unitpendidikan_idInformal', '=', '7')->count();
        $unitPondok = Siswa::where('unitpendidikan_idPondok', '=', '8')->count();

        $listOfAllSiswa = [
            "2" => $unitTk,
            "3" => $unitSd,
            "4" => $unitSmp,
            "5" => $unitSma,
            "6" => $unitMadin,
            "7" => $unitTpq,
            "8" => $unitPondok,
        ];

        return view('admin.dashboard', compact(
            'users',
            'siswa',
            'listOfAllRole',
            'listOfAllUnit',
            'listOfAllSiswa',
        ),);
    }
}
