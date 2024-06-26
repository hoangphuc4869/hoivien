<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\UploadController;
use App\Http\Controllers\Admin\MemberController;


Route::middleware(['login', 'check_date'] )->group(function() {
    Route::get('/', function () {
        return view('admin.main');
    })->name('main');
    
    Route::post('/profile/{id}', [MemberController::class, 'store']);

    Route::get('/danh-sach-hoi-vien', [AdminController::class, 'member'])->name('member');
    Route::get('/profile/{id}', [AdminController::class, 'getMemberById'])->name('showProfile');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::post('/register', [LoginController::class, 'register'])->name("regis");
    Route::get('/register', [LoginController::class, 'register_index'])->name('register_index');
    Route::get('/transaction', [AdminController::class, 'transaction'])->name('transaction');
    Route::post('/register', [LoginController::class, 'register'])->name("regis");
});

Route::post('/change', [AdminController::class, 'changeStatus'])->name('change.user.status');
Route::post('/queryid', [AdminController::class, 'query'])->name('query');
Route::post('/query-id-profile', [AdminController::class, 'query_in_profile'])->name('query_in_profile');
Route::post('/process-accept', [AdminController::class, 'processAccept'])->name('accept');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');

Route::post('/login', [LoginController::class, 'login'])->name('login.submit');

Route::post('/admin/upload/services', [UploadController::class, 'store']);


// Route::get('/create-user', [LoginController::class, 'createUser']);