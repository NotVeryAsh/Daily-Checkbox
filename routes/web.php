<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CheckController;

Route::get('/', [CheckController::class, 'index'])->name('index');
Route::post('/check', [CheckController::class, 'check'])->name('check');
