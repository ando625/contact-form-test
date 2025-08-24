<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
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



Route::get('/', [ContactController::class, 'index'])->name('contact.index');
Route::post('/confirm', [ContactController::class, 'confirm']);
Route::post('/back', [ContactController::class, 'back'])->name('contact.back');
Route::post('/contacts', [ContactController::class, 'store'])->name('contact.store');




Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
Route::post('/admin/export', [AdminController::class, 'export'])->name('admin.export');
Route::post('/logout', [AdminController::class, 'destroy'])->name('logout');
Route::delete('/admin/contact/{contact}', [AdminController::class, 'destroyContact'])
    ->name('admin.contact.destroy');

