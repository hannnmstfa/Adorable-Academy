<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\Payment\TripayCallbackController;
use App\Http\Controllers\TransaksiController;
use App\Http\Middleware\CheckRole;
use App\Http\Middleware\VerifyCsrfToken;
use Illuminate\Support\Facades\Route;

// Route Global======================================================================================
Route::get('/', function () {
    return view('home');
})->name('home');
Route::get('/kelas', [KelasController::class,'index'])->name('kelas.index');
Route::get('/kelas/${kodekelas}', [KelasController::class, 'show'])->name('kelas.show');

// Route Menu
Route::get('/testimoni', function () {
    return view('testimoni');
})->name('testimoni');
Route::get('/tutorial', function () {
    return view('tutorial');
})->name('tutorial');
Route::get('/kemitraan', function () {
    return view('kemitraan');
})->name('kemitraan');
Route::get('/affiliate', function () {
    return view('affiliate');
})->name('affiliate');
//=========================================================================
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    

    // Keranjang
    Route::get('keranjang', [KeranjangController::class,'index'])->name('keranjang');
    //Kelas
    Route::resource('kelas', KelasController::class)->except('index', 'show');
    Route::get('/kelas/{kodekelas}/checkout', [KelasController::class, 'checkout'])->name('kelas.checkout');
    // Transaksi
    Route::resource('transaksi', TransaksiController::class);
    // Route::get('/transaksi/${trx}', [TransaksiController::class,'pemesanan'])->name('transaksi.detail');
});


// Rute untuk Super Admin=================================
Route::middleware('auth', CheckRole::class . ':superadmin')->group(function(){
    //User Manage
    Route::resource('superadmin/usersmanage', UserController::class)->except('show');
    Route::put('/usersmanage/resetpass/{id}', [UserController::class, 'resetpass'])->name('usersmanage.resetpass');
});//======================================================


Route::post('/callback', [TripayCallbackController::class,'handle']);

require __DIR__.'/auth.php';
