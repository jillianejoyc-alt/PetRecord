<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PetController;

Route::redirect('/', '/dashboard');
Route::get('/dashboard', [PetController::class, 'dashboard'])->name('dashboard');
Route::resource('pets', PetController::class);
