<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;

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

Route::get('/', [AuthController::class, 'index']);


Route::get('/', [ContactController::class, 'index']);
Route::post('/confirm', [ContactController::class, 'confirm']);
Route::post('/send', [ContactController::class, 'send']);

Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
Route::get('/admin/{id}', [AdminController::class, 'show'])->name('admin.show');
Route::delete('/admin/{id}', [AdminController::class, 'destroy'])->name('admin.destroy');

Route::post('/logout', function () {
    return redirect('/admin'); // とりあえず管理画面に戻す
})->name('logout');
