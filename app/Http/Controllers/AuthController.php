<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('pages.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            /** @var \App\Models\User $user */
            $user = Auth::user();

            if ($user->hasAnyRole(['super_admin', 'admin', 'pengurus'])) {
                return redirect()->intended('/admin');
            }

            if ($user->hasAnyRole(['koordinator_kegiatan', 'pdd'])) {
                return redirect()->intended('/events');
            }

            if ($user->hasRole('koordinator_inventaris')) {
                return redirect()->intended('/inventaris');
            }

            if ($user->hasRole('anggota')) {
                return redirect()->intended('/anggota');
            }

            return redirect()->intended('/events');
        }

        return back()->withErrors([
            'email' => 'Kredensial yang diberikan tidak cocok dengan catatan kami.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
