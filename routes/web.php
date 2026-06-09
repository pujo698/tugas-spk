<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DssController;

Route::get('/', [DssController::class, 'dashboard'])->name('dashboard');
Route::get('/calculation', [DssController::class, 'calculation'])->name('calculation');
