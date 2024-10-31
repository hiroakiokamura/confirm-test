<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Fortify;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminFormController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/index', function (){
//     return view('index');
// });

Fortify::registerView(function () {
    return view('auth.register');
});

Fortify::loginView(function () {
    return view('auth.login');
});

Route::get('/contact', [ContactController::class, 'showContact'])->name('showContact');
Route::post('/confirm', [ContactController::class, 'confirm'])->name('confirm');
Route::post('/thanks', [ContactController::class, 'store'])->name('store');

Route::post('/register', [RegisterController::class, 'register'])->name('register');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/auth/admin/dashboard', [AdminFormController::class, 'showAdminForm'])->name('showAdmin');  // 管理ページのビューを返す
    Route::get('/auth/admin/search', [AdminFormController::class, 'searchContact'])->name('searchContact');
});

Route::get('/contact/export', [AdminFormController::class, 'export'])->name('contact.export');
Route::delete('/contact/{id}', [AdminFormController::class, 'destroy'])->name('contact.destroy');