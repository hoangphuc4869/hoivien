<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Auth\LoginController;


Route::middleware('login')->group(function() {
    Route::get('/', function () {
        return view('admin.main');
    })->name('main');
    
    Route::get('/danh-sach-hoi-vien', [AdminController::class, 'member'])->name('member');
    Route::get('/profile/{id}', [AdminController::class, 'getMemberById'])->name('showProfile');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});


    Route::post('/change', [AdminController::class, 'changeStatus'])->name('change.user.status');









Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');


Route::post('/login', [LoginController::class, 'login'])->name('login.submit');


// Route::get('/create-user', [LoginController::class, 'createUser']);