<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    // Menampilkan halaman login
    public function showLoginForm()
    {
        return view('Login.login');
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
{
    try {
        // Mendapatkan user dari Google
        $googleUser = Socialite::driver('google')->user();

        // Mencari pengguna di database berdasarkan email
        $user = User::where('email', $googleUser->getEmail())->first();

        // Jika pengguna tidak ditemukan, redirect ke halaman login dengan pesan error
        if (!$user) {
            return redirect()->route('login')->withErrors(['email' => 'Email tidak terdaftar. Silakan daftar terlebih dahulu.']);
        }

        // Jika pengguna ditemukan, login
        Auth::login($user);

        // Redirect ke halaman yang dituju (misalnya ke index)
        return redirect()->intended('index');
    } catch (\Exception $e) {
        // Tangani error
        return redirect()->route('login')->withErrors(['email' => 'Login dengan Google gagal, silakan coba lagi.']);
    }
}

public function loginWithTelegram(Request $request)
    {
        // Arahkan pengguna ke bot Telegram
        return redirect('https://telegram.me/' . env('TELEGRAM_BOT_USERNAME', 'timnas_n7_bot') . '?start'); // Ganti dengan username bot Telegram Anda
    }

public function handleTelegramCallback(Request $request)
{
    // Ambil data dari update Telegram (JSON)
    $telegramUserData = $request->input('message');

    // Periksa apakah ini perintah "/start"
    if (isset($telegramUserData['text']) && $telegramUserData['text'] == '/start') {
        // Ambil data username dan user ID dari pesan Telegram
        $telegramUsername = $telegramUserData['from']['username'] ?? null;
        $telegramId = $telegramUserData['from']['id'] ?? null;

        if ($telegramUsername) {
            // Cari user di database berdasarkan telegram_username
            $user = User::where('telegram_username', $telegramUsername)->first();

            if ($user) {
                // Jika user ditemukan, buat link login
                $loginUrl = url('/auth/telegram/confirm-login/' . $user->id);

                // Kirimkan pesan ke pengguna untuk login dengan link
                $this->sendMessage($telegramId, "Hai {$user->name}, silakan login menggunakan link berikut: " . $loginUrl);
            } else {
                // Jika pengguna tidak ditemukan di database
                $this->sendMessage($telegramId, "Maaf, username Telegram Anda tidak terdaftar.");
            }
        } else {
            // Jika tidak ada username dari Telegram
            $this->sendMessage($telegramId, "Data Telegram tidak valid. Username tidak ditemukan.");
        }
    }
}

private function sendMessage($chatId, $message)
    {
        $botToken = env('TELEGRAM_BOT_TOKEN'); // Simpan token bot Anda di .env
        $telegramApiUrl = "https://api.telegram.org/bot{$botToken}/sendMessage";

        $client = new \GuzzleHttp\Client();
        $response = $client->post($telegramApiUrl, [
            'form_params' => [
                'chat_id' => $chatId,
                'text' => $message,
            ]
        ]);

        return $response;
    }

    public function confirmLogin($id)
    {
        // Cari pengguna berdasarkan ID yang diterima
        $user = User::find($id);
    
        if (!$user) {
            return redirect('login')->with('error', 'Pengguna tidak ditemukan.');
        }
    
        // Login pengguna di Laravel
        Auth::login($user);
    
        // Redirect ke halaman dashboard atau halaman lain
        return redirect('index')->with('success', 'Anda telah berhasil login menggunakan Telegram.');
    }
    

    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Cek kredensial
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // Jika berhasil, redirect ke halaman dashboard atau halaman lainnya
            return redirect()->intended('index'); // Ganti dengan rute yang sesuai
        }

        // Jika gagal, kembali ke form login dengan error
        return back()->withErrors([
            'email' => 'Email atau kata sandi tidak valid.',
        ]);
    }

    // Logout pengguna
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('login'); // Ganti dengan rute yang sesuai
    }

    // Menampilkan form permintaan reset kata sandi
    public function showLinkRequestForm()
    {
        return view('Login.reset');
    }

    // Mengirimkan email untuk reset kata sandi
    public function sendResetLinkEmail(Request $request)
    {
        // Validasi input
        $request->validate(['email' => 'required|email']);

        // Mengirimkan tautan reset kata sandi
        $status = Password::sendResetLink($request->only('email'));

        return $status === Password::RESET_LINK_SENT
            ? back()->with('status', __($status))
            : back()->withErrors(['email' => __($status)]);
    }

    // Menampilkan form reset kata sandi
    public function showResetForm(Request $request, $token = null)
    {
        return view('Login.reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    // Memproses reset kata sandi
    public function reset(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
            'token' => 'required',
        ]);

        // Memproses reset kata sandi
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->password = bcrypt($password);
                $user->save();
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __($status))
            : back()->withErrors(['email' => __($status)]);
    }
}
