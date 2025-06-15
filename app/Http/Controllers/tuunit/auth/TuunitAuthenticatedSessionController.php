<?php

namespace App\Http\Controllers\tuunit\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\TuUnitRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class TuunitAuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view(view: 'tuunit.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(TuUnitRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(route('tuunit.dashboard', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(TuUnitRequest $request): RedirectResponse
    {
        Auth::guard('tuunit')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/tuunit/login');
    }
}
