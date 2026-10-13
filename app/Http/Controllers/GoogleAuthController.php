<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthController extends Controller
{
    /**
     * Redirect the user to the Google authentication page.
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from Google.
     */
    public function handleGoogleCallback(Request $request)
    {
        try {
            $googleUser = Socialite::driver('google')->user();
        } catch (Exception $e) {
            return redirect('/')->with('error', 'Gagal masuk dengan Google: ' . $e->getMessage());
        }

        $email = $googleUser->getEmail();
        if (!$email) {
            return redirect('/')->with('error', 'Akun Google tidak memiliki alamat email yang valid.');
        }

        $user = User::where('email', $email)->first();

        if (!$user) {
            $user = User::create([
                'name' => $googleUser->getName() ?? $googleUser->getNickname() ?? 'Anggota Aozora',
                'email' => $email,
                'password' => Hash::make(Str::random(32)),
            ]);

            $user->assignRole('anggota');
        } elseif ($user->roles()->count() === 0) {
            $user->assignRole('anggota');
        }

        Auth::login($user, true);
        $request->session()->regenerate();

        // Redirect based on roles
        if ($user->hasAnyRole(['super_admin', 'admin', 'pengurus'])) {
            return redirect()->intended('/admin');
        }

        if ($user->hasAnyRole(['koordinator_kegiatan', 'pdd'])) {
            return redirect()->intended('/events-hub');
        }

        if ($user->hasRole('koordinator_inventaris')) {
            return redirect()->intended('/inventaris');
        }

        return redirect('/?chat=open')->with('auth_success', 'Selamat datang, ' . $user->name . '! Kamu sekarang bisa langsung ngobrol dengan Sora 🌸');
    }
}
