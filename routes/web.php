<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Password;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;

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

Route::get('/', [HomeController::class, 'index'])->name('home');

//Auth
Route::get('/Register', [RegisterController::class, 'index'])->name('register');
Route::post('/Register', [RegisterController::class, 'store']);

Route::get('/Login', [LoginController::class, 'index'])->name('login');
Route::post('/Login', [LoginController::class, 'store']);

Route::post('/Logout', [LogoutController::class, 'store'])->name('logout');

Route::get('/User/{username}', [UserController::class, 'index'])->name('user');
Route::get('/User/{username}/Edit', [UserController::class, 'edit'])->name('edit-user');
Route::post('/User/{username}/UploadPicture', [UserController::class, 'storePicture'])->name('upload-picture');
Route::post('/User/{username}/Save', [UserController::class, 'saveEdits'])->name('save-edits');

//Reset password
Route::get('/forgot-password', [UserController::class, 'forgotPassword'])
  ->middleware('guest')
  ->name('forgot-password');

Route::post('/forgot-password', [UserController::class, 'storeResetEmail'])
  ->middleware('guest')
  ->name('store-reset-email');

Route::get('/reset-password/{token}', [UserController::class, 'resetPassword'])
  ->middleware('guest')
  ->name('password.reset');

Route::post('/reset-password', [UserController::class, 'updatePassword'])
  ->middleware('guest')
  ->name('password-update');
