<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/admin/home', [App\Http\Controllers\HomeController::class, 'adminHome'])->name('admin.home')->middleware('is_admin');

Auth::routes();

Route::post('/backup-database', function () {
    Artisan::call('db:backup');
    return response()->json(['message' => 'Database backup successfully created!']);
})->middleware('auth')->name('backup.database');