<?php

use App\Http\Controllers\LoginController;

Route::view('/login', 'pages.login.login')->name('login.form');

Route::post('/auth', [LoginController::class, 'auth'])->name('login.auth');

Route::get('/logout', [LoginController::class, 'logout'])->name('login.logout')->middleware('auth');
