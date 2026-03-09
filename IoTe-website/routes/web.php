<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\AdmissionController;
use App\Http\Controllers\Admin\ItemController;
use App\Http\Controllers\Admin\ReservationAdminController;
use App\Http\Controllers\Admin\UserManagementController;
use App\Http\Controllers\Student\ReservationController;
use App\Http\Controllers\Admin\FacultyController;
use App\Http\Middleware\AuthStudent;
use App\Http\Middleware\AuthAdmin;


//Public Routes
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/laboratories', [PageController::class, 'laboratoriesIndex'])->name('laboratories.index');
Route::get('/laboratories/{id}', [PageController::class, 'laboratoriesShow'])->name('laboratories.show')->where('id', '[1-3]');
Route::get('/admission', [PageController::class, 'admission'])->name('admission.index');
Route::get('/syllabus', [PageController::class, 'syllabus'])->name('syllabus');
Route::get('/faculty', [PageController::class, 'faculty'])->name('faculty.index');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::get('/about-us', [PageController::class, 'about_us'])->name('about_us');
Route::get('/syllabus/dual', [PageController::class, 'syllabusdual'])->name('syllabus.dual');

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
    // Browse & reserve equipment
    Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations.index');
    Route::get('/reservations/history', [ReservationController::class, 'history'])->name('reservations.history');
    Route::get('/reservations/{reservableItem}/create', [ReservationController::class, 'create'])
        ->name('reservations.create');

    Route::post('/reservations/{reservableItem}', [ReservationController::class, 'store'])
        ->name('reservations.store');
    Route::patch('/reservations/{reservation}/cancel', [ReservationController::class, 'cancel'])->name('reservations.cancel');
});

//Admin-Only Routes
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard/admin', [AdminController::class, 'index'])->name('dashboard.admin');
    // Admin panel
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');

    Route::get('/courses',               [FormController::class, 'index'])->name('course.index');
    Route::get('/courses/create',        [FormController::class, 'create'])->name('course.create');
    Route::post('/courses',              [FormController::class, 'store'])->name('course.store');

    Route::get('/courses/{courseID}/edit', [FormController::class, 'edit'])->name('course.edit');
    Route::put('/courses/{courseID}',      [FormController::class, 'update'])->name('course.update');
    Route::delete('/courses/{courseID}',   [FormController::class, 'destroy'])->name('course.destroy');

    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('faculty', FacultyController::class)->except(['show']);
    });

    Route::prefix('admin/admission')->name('admin.admission.')->group(function () {

        Route::get('/', [AdmissionController::class, 'index'])->name('index');

        // Rounds
        Route::get('/rounds/create', [AdmissionController::class, 'createRound'])->name('rounds.create');
        Route::post('/rounds', [AdmissionController::class, 'storeRound'])->name('rounds.store');
        Route::get('/rounds/{round}/edit', [AdmissionController::class, 'editRound'])->name('rounds.edit');
        Route::put('/rounds/{round}', [AdmissionController::class, 'updateRound'])->name('rounds.update');
        Route::delete('/rounds/{round}', [AdmissionController::class, 'destroyRound'])->name('rounds.destroy');

        // Projects
        Route::get('/rounds/{round}/projects/create', [AdmissionController::class, 'createProject'])->name('projects.create');
        Route::post('/rounds/{round}/projects', [AdmissionController::class, 'storeProject'])->name('projects.store');
        Route::get('/projects/{project}/edit', [AdmissionController::class, 'editProject'])->name('projects.edit');
        Route::put('/projects/{project}', [AdmissionController::class, 'updateProject'])->name('projects.update');
        Route::delete('/projects/{project}', [AdmissionController::class, 'destroyProject'])->name('projects.destroy');
    });

    //  User Management 
    Route::get('/users', [UserManagementController::class, 'index'])->name('users.index');
    Route::patch('/users/{user}/role', [UserManagementController::class, 'updateRole'])->name('users.updateRole');

    //  Item/Equipment Management 
    Route::resource('items', ItemController::class);

    //  Reservations (admin view all)
    Route::get('/reservations/admin', [ReservationAdminController::class, 'index'])->name('reservations.admin');
    Route::patch('/reservations/{reservation}/status', [ReservationAdminController::class, 'updateStatus'])->name('reservations_admin.updateStatus');
});
