<?php

namespace App\Http\Controllers\tuunit\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\TuUnitRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class LoginController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('tuunit.auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(TuUnitRequest $request): RedirectResponse
    {
        $request->authenticate('tuunit');
        $request->session()->regenerate();

        // Ambil user yang login
        $user = Auth::guard('tuunit')->user();

        // Cek apakah relasi unitpendidikan ada
        if (!$user->unitpendidikan) {
            return redirect()->route('tuunit.login')->with('error', 'Data unit pendidikan tidak ditemukan');
        }

        $namaUnit = strtolower($user->unitpendidikan->namaUnit); // Pastikan relasi & kolom namaUnit benar

        switch ($namaUnit) {
            case 'MADIN':
                return redirect()->route('tuunit.madin.dashboard');
            case 'TPQ':
                return redirect()->route('tuunit.tpq.dashboard');
            case 'TK':
                return redirect()->route('tuunit.tk.dashboard');
            case 'SD':
                return redirect()->route('tuunit.sd.dashboard');
            case 'SMP':
                return redirect()->route('tuunit.smp.dashboard');
            case 'SMA':
                return redirect()->route('tuunit.sma.dashboard');
            case 'PONDOK':
                return redirect()->route('tuunit.pondok.dashboard');
            default:
                return redirect()->route('tuunit.dashboard');
        }
    }


    /**
     * Destroy an authenticated session.
     */
    public function destroy(TuunitRequest $request): RedirectResponse
    {
        Auth::guard('tuunit')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('tuunit.login');
    }
}
