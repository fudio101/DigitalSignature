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

Route::get('/', [SignController::class, 'index']);

//Route::get('/create-key', [SignController::class, 'keyIndex'])->name('keyIndex');
//Route::get('/verify', [VerifyController::class, 'index'])->name('verify');
//Route::get('/test/{msg}', [SignController::class, 'test'])->name('test');

Route::prefix('sign')->group(function () {
    Route::get('/', [SignController::class, 'index'])->name('sign');
    Route::prefix('ECDSA')->group(function () {
        Route::get('/', [SignController::class, 'showECDSA'])->name('ECDSASignShow');
        Route::post('gen-key', [SignController::class, 'genKeyECDSA'])->name('ECDSAGenKey');
        Route::post('/', [SignController::class, 'signECDSA'])->name('ECDSASign');
    });
    Route::prefix('RSASignature')->group(function () {
        Route::get('/', [SignController::class, 'showRSA'])->name('RSASignShow');
        Route::post('gen-key', [SignController::class, 'genKeyRSASignature'])->name('RSASignatureGenKey');
        Route::post('/', [SignController::class, 'signRSA'])->name('RSASignatureSign');
    });
});

Route::prefix('verify')->group(function () {
    Route::prefix('ECDSA')->group(function () {
        Route::get('/', [VerifyController::class, 'showECDSA'])->name('ECDSAVerifyShow');
        Route::post('/', [VerifyController::class, 'verifyECDSA'])->name('ECDSAVerify');
    });
    Route::prefix('RSA')->group(function () {
        Route::get('/', [VerifyController::class, 'showRSA'])->name('RSAVerifyShow');
        Route::post('/', [VerifyController::class, 'verifyRSA'])->name('RSAVerify');
    });
});
