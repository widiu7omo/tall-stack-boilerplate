<?php

use App\Http\Controllers\Application\AuthController;
use App\Http\Controllers\Application\HomeController;
use App\Http\Livewire\App\Auth\LoginForm;
use App\Http\Livewire\App\Auth\RegisterForm;
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
    return view('landing.welcome');
});

Route::prefix('app')->middleware(['auth:web'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('app.home');
});
Route::name('auth.')->group(function () {
    Route::get('login', LoginForm::class)->name('login');
    Route::get('register', RegisterForm::class)->name('register');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
});
