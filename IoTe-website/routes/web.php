<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

/*
|--------------------------------------------------------------------------
| IoTe KMITL Website Routes
|--------------------------------------------------------------------------
*/

// Home
Route::get('/', [PageController::class, 'home'])->name('home');

// Laboratories
Route::get('/laboratories', [PageController::class, 'laboratoriesIndex'])->name('laboratories.index');
Route::get('/laboratories/{id}', [PageController::class, 'laboratoriesShow'])->name('laboratories.show')->where('id', '[1-3]');

// Other Pages
Route::get('/admission', [PageController::class, 'admission'])->name('admission');
Route::get('/syllabus', [PageController::class, 'syllabus'])->name('syllabus');
Route::get('/faculty', [PageController::class, 'faculty'])->name('faculty');
