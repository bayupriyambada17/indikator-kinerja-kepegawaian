<?php

use App\Livewire\Pages\Viewers\Capaian\Iku\Index;
use App\Livewire\Pages\Viewers\Capaian\Iku\LihatCapaian\Index as LihatCapaianIndex;
use App\Livewire\Pages\Viewers\Capaian\Iku\LihatTarget\Index as LihatTargetIndex;
use App\Livewire\Pages\Viewers\Capaian\Restra\Index as RestraIndex;
use App\Livewire\Pages\Viewers\Capaian\Restra\LihatCapaian\Index as RestraLihatCapaianIndex;
use App\Livewire\Pages\Viewers\Capaian\Restra\LihatTarget\Index as RestraLihatTargetIndex;
use App\Livewire\Pages\Viewers\Dashboard;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth', 'roles:4'])->name('view.')->prefix('viewers')->group(function () {
    Route::get("/dashboard", Dashboard::class)->name('dashboard');

    Route::prefix('capaian-target-iku')->group(function () {
        Route::get("", Index::class)->name('capaian.iku');
        Route::get("/{year}/lihat-target", LihatTargetIndex::class)->name('capaian.iku.target');
        Route::get("/{year}/lihat-capaian", LihatCapaianIndex::class)->name('capaian.iku.capaian');
    });
    Route::prefix('capaian-target-restra')->group(function () {
        Route::get("", RestraIndex::class)->name('capaian.restra');
        Route::get("/{year}/lihat-target", RestraLihatTargetIndex::class)->name('capaian.restra.target');
        Route::get("/{year}/lihat-capaian", RestraLihatCapaianIndex::class)->name('capaian.restra.capaian');
    });
});
