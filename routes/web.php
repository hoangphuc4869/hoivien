<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('admin.main');
})->name('main');

Route::get('/danh-sach-hoi-vien', function () {
    return view('admin.member');
})->name('member');