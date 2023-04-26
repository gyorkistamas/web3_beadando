<?php

use App\Http\Controllers\AnswerPollController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\PollController;
use App\Http\Controllers\UserController;
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

Route::get('/', [Controller::class, 'home'])->name('home');

//Register and login
Route::middleware('guest')->group( function () {

    Route::get('/register', [UserController::class, 'create'])->name('register');
    Route::post('/register', [UserController::class, 'store'])->name('register.store');

    Route::get('/login', [UserController::class, 'login'])->name('login');
    Route::post('/login', [UserController::class, 'auth'])->name('login.auth');
});

//Logout and edit profile
Route::middleware('auth')->group(function () {
    Route::get('logout', [UserController::class, 'logout'])->name('logout');
    Route::get('/edit-profile', [UserController::class, 'update'])->name('edit-profile');
    Route::post('/edit-profile', [UserController::class, 'save'])->name('edit-profile.save');
});

// Create poll
Route::middleware('auth')->group(function () {
    Route::get('/poll/new', [PollController::class, 'create'])->name('polls.create');
    Route::post('/poll/new', [PollController::class, 'store'])->name('polls.store');
});

//Answer poll
Route::get('/poll/{poll}', [AnswerPollController::class, 'get'])->name('polls.get');
Route::post('/poll/{poll}', [AnswerPollController::class, 'answerPoll'])->name('polls.answer');

// Get poll results
Route::get('poll/{poll}/result', [PollController::class, 'getResult'])->name('polls.result');
