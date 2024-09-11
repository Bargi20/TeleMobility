<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;


class AuthenticatedSessionController extends Controller {

    /**
     * Display the login view.
     */
    public function create(): View {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse {

        $request->authenticate();
        $request->session()->regenerate(); //rigenera la sessione

//        return redirect()->intended(RouteServiceProvider::HOME);

        $role = auth()->user()->role;

        switch ($role) { //prende come parametro il ruolo estratto alla riga prima che può essere o admin o user e in base a quello facciamo un redirect
            case 'admin': return redirect()->route('home');
                break;
            case 'Paziente': return redirect()->route('home');
                break;
            case 'Clinico': return redirect()->route('home');
                break;
            default: return redirect('/');
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
