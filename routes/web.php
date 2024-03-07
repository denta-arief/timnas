<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\MonitoringTransactionController;

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