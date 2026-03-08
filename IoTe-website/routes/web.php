<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\AuthAdmin;

//Public Routes
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/laboratories', [PageController::class, 'laboratoriesIndex'])->name('laboratories.index');
Route::get('/laboratories/{id}', [PageController::class, 'laboratoriesShow'])->name('laboratories.show')->where('id', '[1-3]');
Route::get('/admission', [PageController::class, 'admission'])->name('admission');
Route::get('/syllabus', [PageController::class, 'syllabus'])->name('syllabus');
Route::get('/faculty', [PageController::class, 'faculty'])->name('faculty');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');

//Google Auth
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);
    Route::get('/auth/google', [GoogleController::class, 'redirect'])->name('google.login');
    Route::get('/auth/google/callback', [GoogleController::class, 'callback'])->name('google.callback');
});

//Logout 
Route::post('/logout', [GoogleController::class, 'logout'])->name('logout');

//Auth Routes 
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [AuthController::class, 'index'])->name('dashboard');
});

//Admin-Only Routes
Route::middleware(['auth', 'admin'])->group(function () {

    // Admin panel
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');

    Route::get('/courses',               [FormController::class, 'index'])->name('course.index');
    Route::get('/courses/create',        [FormController::class, 'create'])->name('course.create');
    Route::post('/courses',              [FormController::class, 'store'])->name('course.store');

    Route::get('/courses/{courseID}/edit', [FormController::class, 'edit'])->name('course.edit');
    Route::put('/courses/{courseID}',      [FormController::class, 'update'])->name('course.update');
    Route::delete('/courses/{courseID}',   [FormController::class, 'destroy'])->name('course.destroy');
});
