<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/upload', [App\Http\Controllers\UploadController::class, 'showUploadForm'])->name('upload');
Route::post('/upload', [App\Http\Controllers\UploadController::class, 'upload'])->name('upload');

Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->middleware('admin')->name('admin');
Route::put('/files/{id}/{name}/approve', [App\Http\Controllers\AdminController::class, 'approve'])->name('admin.approve');
Route::put('/files/{id}/{name}/reject', [App\Http\Controllers\AdminController::class, 'reject'])->name('admin.reject');

