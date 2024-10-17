<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
<<<<<<< HEAD
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
=======
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
>>>>>>> 59d3e6f2d953766e051eacb53911e5e1b6335155
    }

    public function redirectToGoogle()
    {
<<<<<<< HEAD
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
=======
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
>>>>>>> 59d3e6f2d953766e051eacb53911e5e1b6335155
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
<<<<<<< HEAD
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

=======
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
>>>>>>> 59d3e6f2d953766e051eacb53911e5e1b6335155
