<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Password;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\Game\GameController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Data\CloudController;
use App\Http\Controllers\Data\LocalController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Game\CommentController;
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

//Verify Email
Route::get('/email/verify', [EmailController::class, 'VerifyEmailNotice'])->middleware('auth')->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', [EmailController::class, 'VeficationHandler'])->middleware(['auth', 'signed'])->name('verification.verify');
Route::post('/email/verification-notification', [EmailController::class, 'ResentVerificationEmail'])->middleware(['auth', 'throttle:6,1'])->name('verification.send');
Route::post('/email/reset', [EmailController::class, 'UpdateEmail'])->name('update-email');

Route::get('/User/{username}', [UserController::class, 'index'])->middleware(['auth'])->name('user');
Route::get('/User/{username}/Edit', [UserController::class, 'edit'])->middleware(['auth'])->name('edit-user');
Route::post('/User/{username}/UploadPicture', [UserController::class, 'storePicture'])->middleware(['auth'])->name('upload-picture');
Route::post('/User/{username}/RemovePicture', [UserController::class, 'RemoveProfile'])->middleware(['auth'])->name('remove-picture');
Route::post('/User/{username}/Save', [UserController::class, 'saveEdits'])->middleware(['auth'])->name('save-edits');

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

//My Games
Route::get('/my-games', [UserController::class, 'myGames'])->middleware(['verified','auth'])->name('my-games');
//Upload Game
Route::get('/upload-game', [GameController::class, 'uploadGameForm'])->middleware(['verified','auth'])->name('upload-game');
Route::post('/upload-game', [GameController::class, 'uploadGame'])->middleware(['verified','auth']);
//Edit Game
Route::get('/game/{gameName}/edit', [GameController::class, 'editGame'])->middleware(['verified','auth'])->name('edit-game');
Route::post('/game/{gameName}/edit', [GameController::class, 'updateGame'])->middleware(['verified','auth'])->name('update-game');
//Delete Game
Route::post('/game/{gameName}/delete', [GameController::class, 'deleteGame'])->middleware(['verified','auth'])->name('delete-game');
//Game Submitted
Route::get('/upload-game/submit-success', [GameController::class, 'submitSuccess'])->middleware(['verified','auth'])->name('submit-success');

//Game player
Route::get('/game/{gameName}', [GameController::class, 'loadGame'])->middleware('googledrive')->name('load-game');
Route::get('/cloud/{target}', [GameController::class, 'ForwardStorageRequest'])->where('target', '.*')->name('cloud');

//Post Comment
Route::post('/game/{gameName}/comment', [CommentController::class, 'postComment'])->middleware(['verified','auth'])->name('post-comment');
//Post Reply
Route::post('/game/{gameName}/comment/{commentId}/reply', [CommentController::class, 'postReply'])->middleware(['verified','auth'])->name('post-reply');