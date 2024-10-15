<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use Socialite;
use App\Models\User;
use Exception;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect()->route('index');
        }
    
        // Jika belum login, tampilkan halaman login
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Jika login berhasil
            return redirect()->intended('/index');
        }

        // Jika login gagal
        return back()->withErrors([
            'email' => 'Kredensial yang diberikan tidak cocok dengan catatan kami.',
        ]);
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->with(['prompt' => 'select_account'])->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();
            
            // Mencari pengguna berdasarkan google_id atau email
            $user = User::where('google_id', $googleUser->id)
                        ->orWhere('email', $googleUser->email)
                        ->first();

            if ($user) {
                // Login pengguna
                Auth::login($user);
                return redirect('/index'); // Redirect ke halaman yang diinginkan
            } else {
                // Jika pengguna belum ada, buat akun baru
                $newUser = User::create([
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'google_id' => $googleUser->id,
                    'password' => bcrypt('defaultpassword'), // Buat password sementara
                ]);
                Auth::login($newUser);
                return redirect('/index');
            }
        } catch (Exception $e) {
            return redirect('/login')->with('error', 'Gagal login menggunakan Google.');
        }
    }

    public function redirectToTelegram()
    {
        return Socialite::driver('telegram')->redirect(); // Redirect user ke bot Telegram
    }
    
    public function handleTelegramCallback($telegramUsername)
    {
        // Cari user berdasarkan username Telegram
        $user = User::where('telegram_username', $telegramUsername)->first();
    
        if ($user) {
            // Login user menggunakan Auth
            Auth::login($user);
    
            // Redirect ke halaman index
            return redirect()->route('index');
        } else {
            // Jika user tidak ditemukan, kembalikan ke halaman login dengan pesan error
            return redirect()->route('login')->withErrors(['msg' => 'Username Telegram anda tidak terdaftar.']);
        }
    }
    

    public function checkUser(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'telegram_username' => 'required|string',
        ]);

        // Ambil data email dan username Telegram dari request
        $email = $request->input('email');
        $telegramUsername = $request->input('telegram_username');

        // Cek apakah pengguna terdaftar berdasarkan email atau username Telegram
        $user = User::where('email', $email)
                    ->orWhere('telegram_username', $telegramUsername)
                    ->first();

        // Jika pengguna ditemukan, login
        if ($user) {
            Auth::login($user);

            // Redirect ke halaman index setelah login berhasil
            return redirect()->route('index')->with('success', 'Login berhasil');
        } else {
            // Jika pengguna tidak ditemukan, kembali ke halaman login dengan pesan error
            return redirect()->route('login')->with('error', 'User tidak ditemukan');
        }
    }

    public function logout()
    {
        // Logout pengguna
        Auth::logout();

        // Redirect ke halaman login setelah logout
        return redirect('/login')->with('success', 'Anda telah berhasil logout.');
    }
} 

