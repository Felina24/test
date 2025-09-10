<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;

Route::get('/contact', [ContactController::class, 'index'])->name('contact');

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/', [ContactController::class, 'index']);
Route::post('/confirm', [ContactController::class, 'confirm']);
Route::post('/send', [ContactController::class, 'send']);

Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
Route::get('/admin/export', [AdminController::class, 'export'])->name('admin.export');
Route::get('/admin/{id}', [AdminController::class, 'show'])->name('admin.show');
Route::delete('/admin/{id}', [AdminController::class, 'destroy'])->name('admin.destroy');