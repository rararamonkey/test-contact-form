<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminController;

Route::get('/', [ContactController::class, 'index']);

Route::post('/contacts/confirm', [ContactController::class, 'confirm']);
Route::post('/contacts', [ContactController::class, 'store']);
Route::get('/thanks', [ContactController::class, 'thanks']);

Route::middleware('auth')->group(function () {
    Route::get('/admin', [AdminController::class, 'index']);
});
Route::delete('/admin/delete/{id}', [AdminController::class, 'destroy'])->name('contacts.delete');