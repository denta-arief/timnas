<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\MonitoringTransactionController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\BotTelegramController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/index', function () {
    return view('index');
});

Route::get('/test',[BotTelegramController::class,'testDevelop']);

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
    // Route::get('/pdf_daily', [ReportController::class, 'rpt_daily_pdf']);
    Route::get('/daily/{pdf}', [ReportController::class, 'rpt_daily']);
    Route::get('/sendpdf', [BotTelegramController::class, 'sendPdf']);
});