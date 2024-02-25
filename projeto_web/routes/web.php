<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/upload', [App\Http\Controllers\UploadController::class, 'showUploadForm'])->name('upload');
Route::post('/upload', [App\Http\Controllers\UploadController::class, 'upload'])->name('upload');

Route::get('/archive', [App\Http\Controllers\AdminController::class, 'index'])->middleware('admin')->name('archive');
Route::put('/files/{id}/{name}/approve', [App\Http\Controllers\AdminController::class, 'approve'])->middleware('admin')->name('admin.approve');
Route::put('/files/{id}/{name}/reject', [App\Http\Controllers\AdminController::class, 'reject'])->middleware('admin')->name('admin.reject');

// Payment Type routes
Route::get('/payment-types', [App\Http\Controllers\PaymentTypeController::class, 'index'])->middleware('admin')->name('paymentTypes.index');
Route::post('/payment-types', [App\Http\Controllers\PaymentTypeController::class, 'store'])->middleware('admin')->name('paymentTypes.store');
Route::put('/payment-types/{id}', [App\Http\Controllers\PaymentTypeController::class, 'update'])->middleware('admin')->name('paymentTypes.update');
Route::delete('/payment-types/{id}', [App\Http\Controllers\PaymentTypeController::class, 'destroy'])->middleware('admin')->name('paymentTypes.destroy');

// Payment routes
Route::get('/payments', [App\Http\Controllers\PaymentController::class, 'index'])->name('payments.index');
Route::post('/payments', [App\Http\Controllers\PaymentController::class, 'store'])->name('payments.store');
Route::put('/payments/{id}', [App\Http\Controllers\PaymentController::class, 'update'])->middleware('admin')->name('payments.update');
Route::delete('/payments/{id}', [App\Http\Controllers\PaymentController::class, 'destroy'])->middleware('admin')->name('payments.destroy');

// Client routes
Route::get('/clients', [App\Http\Controllers\ClientController::class, 'index'])->name('clients.index');
Route::post('/clients', [App\Http\Controllers\ClientController::class, 'store'])->name('clients.store');
Route::put('/clients/{id}', [App\Http\Controllers\ClientController::class, 'update'])->name('clients.update');
Route::delete('/clients/{id}', [App\Http\Controllers\ClientController::class, 'destroy'])->name('clients.destroy');
