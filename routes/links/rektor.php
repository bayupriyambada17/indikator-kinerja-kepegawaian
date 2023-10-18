<?php

use App\Livewire\Pages\Rektor\CapaianIku;
use App\Livewire\Pages\Rektor\CapaianIku\LihatCapaian;
use App\Livewire\Pages\Rektor\CapaianIku\LihatTarget;
use App\Livewire\Pages\Rektor\CapaianRestra as RektorCapaianRestra;
use App\Livewire\Pages\Rektor\CapaianRestra\LihatCapaian as RektorLihatCapaian;
use App\Livewire\Pages\Rektor\CapaianRestra\LihatTarget as RektorLihatTarget;
use App\Livewire\Pages\Rektor\Dashboard as RektorDashboard;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'roles:1'])->prefix('rektor')->name('rektor.')->group(function () {

    // Route Rektor
    Route::get('/dashboard', RektorDashboard::class)->name('dashboard');
    // restra
    Route::get('/capaian-restra', RektorCapaianRestra::class)->name('capaian-restra');
    Route::get('/capaian-restra/{year}/lihat-target', RektorLihatTarget::class)->name('capaian-restra.lihat-target');
    Route::get('/capaian-restra/{year}/lihat-capaian-iku', RektorLihatCapaian::class)->name('capaian-restra.lihat-capaian');

    // IKU
    Route::get('/capaian-iku', CapaianIku::class)->name('capaian-iku');
    Route::get('/capaian-iku/{year}/lihat-target', LihatTarget::class)->name('capaian-iku.lihat-target');
    Route::get('/capaian-iku/{year}/lihat-capaian-iku', LihatCapaian::class)->name('capaian-iku.lihat-capaian');
});
