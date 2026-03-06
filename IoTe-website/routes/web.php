<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\FormController;

// Named Route
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/laboratories', [PageController::class, 'laboratoriesIndex'])->name('laboratories.index');
Route::get('/laboratories/{id}', [PageController::class, 'laboratoriesShow'])->name('laboratories.show')->where('id', '[1-3]');
Route::get('/admission', [PageController::class, 'admission'])->name('admission');
Route::get('/syllabus', [PageController::class, 'syllabus'])->name('syllabus');
Route::get('/faculty', [PageController::class, 'faculty'])->name('faculty');
// Route::get('/test_contact', [PageController::class, 'test_contact'])->name('test_contact');
Route::get('/contacts', [PageController::class, 'contacts'])->name('contacts');

// Form Routes
Route::get('/courses/course_list', [FormController::class, 'index'])->name('course.index');
Route::get('/add_course', [FormController::class, 'create'])->name('course.create');
Route::post('/add_course', [FormController::class, 'store'])->name('course.store');
Route::get('/courses/{courseID}/edit', [FormController::class, 'edit'])->name('course.edit');
Route::put('/courses/{courseID}', [FormController::class, 'update'])->name('course.update');
Route::delete('/courses/{courseID}', [FormController::class, 'destroy'])->name('course.destroy');
