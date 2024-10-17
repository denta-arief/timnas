<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\MonitoringTransactionController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\BotTelegramController;
use App\Http\Controllers\TimbanganController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ProfileController;

// Route utama
Route::get('/', function () {
    return view('welcome');
});

<<<<<<< HEAD
// Route login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
=======
Route::get('/index', function () {
    return view('index');
})->middleware('auth');
>>>>>>> 59d3e6f2d953766e051eacb53911e5e1b6335155

// Route Google login
Route::get('/auth/google', [LoginController::class, 'redirectToGoogle'])->name('google.login');
Route::get('/auth/google/callback', [LoginController::class, 'handleGoogleCallback']);

// Route Telegram login
Route::get('/auth/telegram', [LoginController::class, 'redirectToTelegram'])->name('telegram.login');
Route::get('/telegram/callback/{telegramUsername}', [LoginController::class, 'handleTelegramCallback'])->name('telegram.callback');

// Route Check User
Route::post('/check-user', [LoginController::class, 'checkUser'])->name('check.user');

// Route logout
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');

// Route yang memerlukan login
Route::middleware(['auth'])->group(function () { // Ganti 'check.user' dengan 'auth'
    
    Route::get('/index', function () {
        return view('index');
    })->name('index');
    
    // Route untuk Profile dan Update Profile
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile', function () {
        return view('profil');
    })->name('profile');
    

    Route::prefix('devices')->group(function () {
        Route::get('/', [DeviceController::class, 'index']);
        Route::get('/create', [DeviceController::class, 'create']);
        Route::post('/store', [DeviceController::class, 'store']);
        Route::get('/edit/{id}', [DeviceController::class, 'edit']);
        Route::post('/update/{id}', [DeviceController::class, 'update']);
    });

    Route::prefix('monitoring')->group(function () {
        Route::get('/router', [MonitoringTransactionController::class, 'router']);
        Route::get('/ping', [MonitoringTransactionController::class, 'ping']);
    });

    Route::prefix('weighbridge')->group(function () {
        Route::get('/sap', function () {
            return view('weighbridge.sap');
        });
    });

    Route::prefix('report')->group(function () {
        Route::get('/daily', [ReportController::class, 'rpt_daily']);
        Route::post('/daily', [ReportController::class, 'rpt_daily'])->name('route_daily');
        Route::get('/daily/{pdf}', [ReportController::class, 'rpt_daily']);
        Route::get('/sendpdf', [BotTelegramController::class, 'sendPdf']);
    });
});

<<<<<<< HEAD
// Route test
Route::get('/test', [TimbanganController::class, 'insertTicket']);
=======
Route::prefix('report')->group(function () {
    Route::get('/daily', [ReportController::class, 'rpt_daily']);
    Route::post('/daily', [ReportController::class, 'rpt_daily'])->name('route_daily');
    // Route::get('/pdf_daily', [ReportController::class, 'rpt_daily_pdf']);
    Route::get('/daily/{pdf}', [ReportController::class, 'rpt_daily']);
    Route::get('/sendpdf', [BotTelegramController::class, 'sendPdf']);
});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

// Rute untuk permintaan reset kata sandi
Route::get('/password/reset', [LoginController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/password/email', [LoginController::class, 'sendResetLinkEmail'])->name('password.email');

// Rute untuk mengatur ulang kata sandi
Route::get('/password/reset/{token}', [LoginController::class, 'showResetForm'])->name('password.reset');
Route::post('/password/reset', [LoginController::class, 'reset'])->name('password.update');
Route::get('auth/google', [LoginController::class, 'redirectToGoogle'])->name('google.login');
Route::get('auth/google/callback', [LoginController::class, 'handleGoogleCallback']);

Route::post('/login/telegram', [LoginController::class, 'loginWithTelegram'])->name('telegram.login');
Route::post('/auth/telegram/callback', [LoginController::class, 'handleTelegramCallback']);
Route::get('/auth/telegram/confirm-login/{id}', [LoginController::class, 'confirmLogin'])->name('telegram.confirm-login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
Route::put('/profile/{id}', [ProfileController::class, 'update'])->name('profile.update');
>>>>>>> 59d3e6f2d953766e051eacb53911e5e1b6335155
