<?php

namespace App\Http\Controllers\Admin\auth;

use App\Models\Kelas;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{


    public function showUser()
    {
        // total user
        $users = User::count();

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

        // dd($listOfAllUnit);

        return view('admin.dashboard', compact(
            'users',
            'listOfAllRole',
            'listOfAllUnit',
        ),);
    }
}