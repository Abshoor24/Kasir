<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Livewire\Beranda;
use App\Livewire\User;
use App\Livewire\Laporan;
use App\Livewire\Produk;
use App\Livewire\Transaksi;
use App\Http\Controllers\AdminDashboardController;

Route::get('/admin/dashboard',[AdminDashboardController::class, 'dashboard']);

Route::get('/', function () {
    return redirect('http://localhost:5173');
});

Auth::routes();

Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])
    ->middleware(['auth']) 
    ->name('admin.dashboard');
Route::get('/home', Beranda::class)->middleware(['auth'])->name('home');
Route::get('/user', User::class)->middleware(['auth'])->name('user');
Route::get('/laporan', Laporan::class)->middleware(['auth'])->name('laporan');
Route::get('/produk', Produk::class)->middleware(['auth'])->name('produk');
Route::get('/transaksi', Transaksi::class)->middleware(['auth'])->name('transaksi');
Route::get('/cetak', ['App\Http\Controllers\HomeController', 'cetak']);
