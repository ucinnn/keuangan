<?php

namespace App\Http\Controllers\Admin\auth;

use App\Models\Kelas;
use App\Models\User;
use App\Models\Siswa;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{


    public function showUser()
    {
        // total user
        $users = User::count();
        $siswas = Siswa::count();

        $roleAdmin = User::where('role', '=', 'admin')->count();
        $roleTuunit = User::where('role', '=', 'tuunit')->count();
        $roleTupusat = User::where('role', '=', 'tupusat')->count();

        $listOfAllRole = [
            "admin" => $roleAdmin,
            "tuunit" => $roleTuunit,
            "tupusat" => $roleTupusat,
        ];

        $nama_unitTk = Siswa::where('unitpendidikan_id', '=', '2')->count();
        $nama_unitSd = Siswa::where('unitpendidikan_id', '=', '3')->count();
        $nama_unitSmp = Siswa::where('unitpendidikan_id', '=', '4')->count();
        $nama_unitSma = Siswa::where('unitpendidikan_id', '=', '5')->count();
        $nama_unitMadin = Siswa::where('unitpendidikan_idInformal', '=', '6')->count();
        $nama_unitTpq = Siswa::where('unitpendidikan_idInformal', '=', '7')->count();
        $nama_unitPondok = Siswa::where('unitpendidikan_idPondok', '=', '8')->count();
        $nama_unitTidakPondok = Siswa::where('unitpendidikan_idPondok', '=', '9')->count();

        $listOfAllUnit = [
            "2" => $nama_unitTk,
            "3" => $nama_unitSd,
            "4" => $nama_unitSmp,
            "5" => $nama_unitSma,
            "6" => $nama_unitMadin,
            "7" => $nama_unitTpq,
            "8" => $nama_unitPondok,
            "9" => $nama_unitTidakPondok
        ];

        // $nama_Tk = Siswa::where('namaUnit', '=', 'TK')->count();
        // $nama_Sd = Siswa::where('namaUnit', '=', 'SD')->count();
        // $nama_Smp = Siswa::where('namaUnit', '=', 'SMP')->count();
        // $nama_Sma = Siswa::where('namaUnit', '=', 'SMA')->count();
        // $nama_Madin = Siswa::where('namaUnit', '=', 'MADIN')->count();
        // $nama_Tpq = Siswa::where('namaUnit', '=', 'TPQ')->count();
        // $nama_Pondok = Siswa::where('namaUnit', '=', 'YA PONDOK')->count();
        // $nama_TidakPondok = Siswa::where('namaUnit', '=', 'TIDAK PONDOK')->count();

        // $listOfAllSiswa = [
        //     "TK" => $nama_Tk,
        //     "SD" => $nama_Sd,
        //     "SMP" => $nama_Smp,
        //     "SMA" => $nama_Sma,
        //     "MADIN" => $nama_Madin,
        //     "TPQ" =>  $nama_Tpq,
        //     "YA PONDOK" => $nama_Pondok,
        //     "TIDAK PONDOK" => $nama_TidakPondok
        // ];


        return view('admin.dashboard', compact(
            'users',
            'siswas',
            'listOfAllRole',
            'listOfAllUnit',
            // 'listOfAllSiswa',
        ),);
    }
}