<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::middleware('auth')->group(function() {
    Route::resource('groups', App\Http\Controllers\Admin\GroupController::class);
    Route::resource('replacements', App\Http\Controllers\Admin\ReplacementController::class);
    Route::resource('schedules', App\Http\Controllers\Admin\ScheduleController::class);
    Route::resource('subjects', App\Http\Controllers\Admin\SubjectController::class);
    Route::resource('teachers', App\Http\Controllers\Admin\TeacherController::class);
});
