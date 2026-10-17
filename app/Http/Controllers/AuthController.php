<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\View\View;

class AuthController extends Controller
{
    /**
     * Tampilkan form login pustakawan.
     * Mengambil email dari cookie 'del_last_librarian_email' jika ada.
     */
    public function showLoginForm(): View
    {
        $rememberedEmail = Cookie::get('del_last_librarian_email');

        return view('auth.login', compact('rememberedEmail'));
    }

    /**
     * Proses autentikasi pustakawan, regenerasi sesi, dan simpan cookie identitas.
     */
    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'password.required' => 'Password wajib diisi.',
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            // Mitigasi Session Fixation: perbarui ID sesi
            $request->session()->regenerate();

            // Simpan metadata sesi login
            session(['login_timestamp' => now()->translatedFormat('d F Y, H:i')]);

            // Simpan cookie email pustakawan (berlaku 7 hari = 10080 menit)
            Cookie::queue('del_last_librarian_email', $request->email, 10080);

            return redirect()->intended(route('dashboard'))
                ->with('success', 'Selamat datang kembali di SIPUS-Del, ' . Auth::user()->name . '!');
        }

        return back()->withErrors([
            'email' => 'Kombinasi email dan kata sandi pustakawan tidak cocok dengan data kami.',
        ])->onlyInput('email');
    }

    /**
     * Proses logout pustakawan: hapus otentikasi, batalkan sesi, dan regenerasi token CSRF.
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        // Invalidate session data & regenerate CSRF token
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')
            ->with('success', 'Anda telah berhasil keluar dari sesi pustakawan SIPUS-Del.');
    }
}
