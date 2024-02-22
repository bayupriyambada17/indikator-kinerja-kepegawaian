<?php

use App\Livewire\Pages\Operator\Login;;

use Illuminate\Support\Facades\Route;


Route::middleware(['guest'])->group(function () {
    Route::get('/', function () {
        return redirect(route('login'));
    })->name('redirect');
    Route::get("/login", Login::class)->name('login');
});

require 'links/operator.php';
require 'links/viewers.php';
require 'links/rektor.php';
