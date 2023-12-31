<?php

use App\Http\Controllers\ChefController;
use Illuminate\Support\Facades\Route;
// import semua controller
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MakananController;
use App\Http\Controllers\MinumanController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\WaiterController;
use Illuminate\Support\Facades\Auth;

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

// buat url '/' lalu berinaka home
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/cart', [HomeController::class, 'cart']);


Route::get('/login', [LoginController::class, 'pengelola'])->name('login.pengelola');

Route::post('/login', [LoginController::class, 'pengelolaAuth'])->name('auth.pengelola');

// buat route untuk order
Route::group(['prefix'=>'order'], function () {
    Route::get('/', [OrderController::class, 'index'])->name('order');
    Route::post('/', [OrderController::class, 'orderStore']);
    Route::post('/finish', [OrderController::class, 'finishOrder']);

});

Route::group(['prefix' => 'chef', 'middleware'=>'chef'], function(){
    Route::get('/', [ChefController::class, 'indexChef'])->name('chef.index');
    Route::post('/order/status', [ChefController::class, 'orderStatus'])->name('chef.order');
});

Route::group(['prefix' => 'waiter', 'middleware'=>'waiter'], function(){
    Route::get('/', [WaiterController::class, 'indexWaiter'])->name('waiter.index');
    Route::post('/order/status', [WaiterController::class, 'orderStatus'])->name('chef.order');

});

// buat route untuk admin
Route::group(['prefix'=>'admin', 'middleware'=>'admin'], function () {
    Route::get('/', function () {
        return view('pages.admin.dashboard');
    })->name('admin.dashboard');

    // group menu dua route makanan dan minuman
    Route::group(['prefix'=>'menu'], function () {
        Route::group(['prefix' => "makanan"], function() {
            Route::get('/', [MakananController::class, 'indexAdminMakanan'])->name('admin.menu.makanan');
            Route::post('/', [MakananController::class, 'addAdminMakanan']);
            Route::get('/add', [MakananController::class, 'showFormTambahAdminMakanan']);
            Route::get('/{slug}', [MakananController::class, 'detailAdminMakanan']);
            Route::get('/{slug}/edit', [MakananController::class, 'editDetailAdminMakanan']);
            Route::post('/{slug}', [MakananController::class, 'editAdminMakanan']);
            Route::get('/{slug}/delete', [MakananController::class, 'deleteAdminMakanan']);
        });

        Route::group(['prefix' => "minuman"], function() {
            Route::get('/', [MinumanController::class, 'indexAdminMinuman'])->name('admin.menu.minuman');
            Route::post('/', [MinumanController::class, 'addAdminMinuman']);
            Route::get('/add', [MinumanController::class, 'showFormTambahAdminMinuman']);
            Route::get('/{slug}', [MinumanController::class, 'detailAdminMinuman']);
            Route::get('/{slug}/edit', [MinumanController::class, 'editDetailAdminMinuman']);
            Route::post('/{slug}', [MinumanController::class, 'editAdminMinuman']);
            Route::get('/{slug}/delete', [MinumanController::class, 'deleteAdminMinuman']);
        });
    });

    // karyawan
    Route::group(['prefix'=>'karyawan'], function () {
        Route::get('/', [KaryawanController::class, 'index'])->name('karyawan.index');
        Route::get('/add', [KaryawanController::class, 'create'])->name('karyawan.create');
        Route::post('/', [KaryawanController::class, 'store'])->name('karyawan.store');
        Route::get('/{id}', [KaryawanController::class, 'show'])->name('karyawan.show');
        Route::get('/{id}/edit', [KaryawanController::class, 'edit'])->name('karyawan.edit');
        Route::put('/{id}', [KaryawanController::class, 'update'])->name('karyawan.update');
        Route::delete('/{id}', [KaryawanController::class, 'destroy'])->name('karyawan.destroy');
    });

    // transaction
    Route::group(['prefix'=>'transaction'], function () {
        Route::get('/', [TransactionController::class, 'index'])->name('transaction.index');
        Route::get('/{transaksi_id}', [TransactionController::class, 'show'])->name('transaction.show');
        Route::post('/{transaksi_id}/pay', [TransactionController::class, 'pay'])->name('transaction.show');
        Route::put('/{transaksi_id}', [TransactionController::class, 'update'])->name('transaction.update');
        Route::delete('/{transaksi_id}', [TransactionController::class, 'destroy'])->name('transaction.destroy');
    });

});


// buat route untuk logout
Route::get('/logout', function () {
    Auth::logout();
    return redirect()->route('home');
})->name('logout');
