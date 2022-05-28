<?php

use App\Http\Controllers\SignController;
use App\Http\Controllers\VerifyController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('sign');
});

Route::get('/create-key', [SignController::class, 'keyIndex'])->name('keyIndex');
Route::get('/verify', [VerifyController::class, 'index'])->name('verify');
Route::get('/test/{msg}', [SignController::class, 'test'])->name('test');

Route::prefix('sign')->group(function () {
    Route::get('/', [SignController::class, 'index'])->name('sign');
    Route::prefix('ECDSA')->group(function () {
        Route::get('gen-key', [SignController::class, 'genKeyECDSA'])->name('ECDSAGenKey');
        Route::get('/', [SignController::class, 'signECDSA'])->name('ECDSASign');
    });
});

Route::prefix('verify')->group(function () {
    Route::get('ECDSA', [VerifyController::class, 'verifyECDSA'])->name('ECDSAVerify');
});
