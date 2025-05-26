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

        $nama_unitTk = User::where('namaUnit', '=', 'TK')->count();
        $nama_unitSd = User::where('namaUnit', '=', 'SD')->count();
        $nama_unitSmp = User::where('namaUnit', '=', 'SMP')->count();
        $nama_unitSma = User::where('namaUnit', '=', 'SMA')->count();
        $nama_unitMadin = User::where('namaUnit', '=', 'MADIN')->count();
        $nama_unitTpq = User::where('namaUnit', '=', 'TPQ')->count();
        $nama_unitPondok = User::where('namaUnit', '=', 'YA PONDOK')->count();
        $nama_unitTidakPondok = User::where('namaUnit', '=', 'TIDAK PONDOK')->count();

        $listOfAllUnit = [
            "TK" => $nama_unitTk,
            "SD" => $nama_unitSd,
            "SMP" => $nama_unitSmp,
            "SMA" => $nama_unitSma,
            "MADIN" => $nama_unitMadin,
            "TPQ" =>  $nama_unitTpq,
            "YA PONDOK" => $nama_unitPondok,
            "TIDAK PONDOK" => $nama_unitTidakPondok
        ];

        $unitTk = Siswa::where('unitpendidikan_id', '=', '2')->count();
        $unitSd = Siswa::where('unitpendidikan_id', '=', '3')->count();
        $unitSmp = Siswa::where('unitpendidikan_id',  '=', '4')->count();
        $unitSma = Siswa::where('unitpendidikan_id', '=', '5')->count();
        $unitMadin = Siswa::where('unitpendidikan_idInformal', '=', '6')->count();
        $unitTpq = Siswa::where('unitpendidikan_idInformal', '=', '7')->count();
        $unitPondok = Siswa::where('unitpendidikan_idPondok', '=', '8')->count();
        $unitTidakPondok = Siswa::where('unitpendidikan_idPondok', '=', '9')->count();

        $listOfAllSiswa = [
            "2" => $unitTk,
            "3" => $unitSd,
            "4" => $unitSmp,
            "5" => $unitSma,
            "6" => $unitMadin,
            "7" => $unitTpq,
            "8" => $unitPondok,
            "9" => $unitTidakPondok
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
