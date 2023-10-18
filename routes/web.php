<?php

use App\Livewire\Pages\Operator\Login;;

use Illuminate\Support\Facades\Route;


Route::middleware(['guest'])->group(function () {
    Route::get('/', function () {
        return redirect(route('operator.login'));
    })->name('redirect');
    Route::get("/login", Login::class)->name('operator.login');
});

require 'links/operator.php';
require 'links/rektor.php';
