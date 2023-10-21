<?php

use App\Livewire\Pages\Operator\BuktiUploads;
use App\Livewire\Pages\Operator\BuktiUploads\Add as BuktiUploadsAdd;
use App\Livewire\Pages\Operator\BuktiUploads\Edit as BuktiUploadsEdit;
use App\Livewire\Pages\Operator\CapaianIkp;
use App\Livewire\Pages\Operator\CapaianIndikatorIkp;
use App\Livewire\Pages\Operator\CapaianIndikatorIkp\Add as CapaianIndikatorIkpAdd;
use App\Livewire\Pages\Operator\CapaianIndikatorIkp\Edit as CapaianIndikatorIkpEdit;
use App\Livewire\Pages\Operator\Lakip\Add as LakipAdd;
use App\Livewire\Pages\Operator\Lakip;
use App\Livewire\Pages\Operator\CapaianRestra;
use App\Livewire\Pages\Operator\Dashboard;
use App\Livewire\Pages\Operator\Indikator;
use App\Livewire\Pages\Operator\Indikator\Add as IndikatorAdd;
use App\Livewire\Pages\Operator\Indikator\Edit as IndikatorEdit;
use App\Livewire\Pages\Operator\SatuanIndikator;
use App\Livewire\Pages\Operator\SatuanIndikator\Add;
use App\Livewire\Pages\Operator\SatuanIndikator\Edit;
use App\Livewire\Pages\Operator\TargetCapaianIkp\IsiCapaian as TargetCapaianIkpIsiCapaian;
use App\Livewire\Pages\Operator\TargetCapaianIkp\IsiTarget as TargetCapaianIkpIsiTarget;
use App\Livewire\Pages\Operator\TargetRestra\IsiCapaian;
use App\Livewire\Pages\Operator\TargetRestra\IsiTarget;
use App\Livewire\Pages\Operator\Year;
use App\Livewire\Pages\Operator\Year\Add as YearAdd;
use App\Livewire\Pages\Operator\Year\Edit as YearEdit;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth', 'roles:2'])->group(function () {
    Route::get("/dashboard", Dashboard::class)->middleware('roles:2')->name('dashboard');
    Route::prefix('capaian-target-restra')->group(function () {
        Route::get("", CapaianRestra::class)->name('capaian.restra');
        Route::get("/{year}/isi-target", IsiTarget::class)->name('capaian.restra.isi-target');
        Route::get("/{year}/isi-capaian", IsiCapaian::class)->name('capaian.restra.isi-capaian');
    });

    Route::prefix('capaian-target-iku')->group(function () {
        Route::get("", CapaianIkp::class)->name('capaian.ikp');
        Route::get("/{year}/isi-target", TargetCapaianIkpIsiTarget::class)->name('capaian.ikp.isi-target');
        Route::get("/{year}/isi-capaian", TargetCapaianIkpIsiCapaian::class)->name('capaian.ikp.isi-capaian');
    });

    Route::prefix('satuan-indikator')->group(function () {
        Route::get("", SatuanIndikator::class)->name('satuan.indikator');
        Route::get("/tambah", Add::class)->name('satuan.indikator.add');
        Route::get("/{unitId}/ubah", Edit::class)->name('satuan.indikator.edit');
    });

    Route::prefix('indikator')->group(function () {
        Route::get("", Indikator::class)->name('indikator');
        Route::get("/tambah", IndikatorAdd::class)->name('indikator.add');
        Route::get("/{indicatorId}/ubah", IndikatorEdit::class)->name('indikator.edit');
    });

    Route::prefix('capaian-indikator')->name('capaian.')->group(function () {
        Route::get("", CapaianIndikatorIkp::class)->name('indikator');
        Route::get("/tambah", CapaianIndikatorIkpAdd::class)->name('indikator.add');
        Route::get("/{capaianIndicatorId}/ubah", CapaianIndikatorIkpEdit::class)->name('indikator.edit');
    });

    Route::prefix('tahun')->group(function () {
        Route::get("", Year::class)->name("year");
        Route::get("/tambah", YearAdd::class)->name('year.add');
        Route::get("/{yearId}/ubah", YearEdit::class)->name('year.edit');
    });

    Route::prefix('lakip')->group(function () {
        Route::get('', Lakip::class)->name('lakip');
        Route::get('/tambah', LakipAdd::class)->name('lakip.add');
    });

    Route::prefix('bukti-uploads')->group(function () {
        Route::get('', BuktiUploads::class)->name('bukti-upload');
        Route::get('/tambah', BuktiUploadsAdd::class)->name('bukti-upload.add');
        Route::get('/{buktiUploadId}/ubah', BuktiUploadsEdit::class)->name('bukti-upload.edit');
    });
});
