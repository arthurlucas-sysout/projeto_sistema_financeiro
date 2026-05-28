<?php

use App\Http\Controllers\UserController;

Route::controller(UserController::class)
    ->prefix('users')
    ->as('users.')
    ->group(function () {

        Route::get('/', 'index')->name('index')->middleware(['auth', 'role']);

        Route::get('/create', 'create')->name('create');

        Route::post('/', 'store')->name('store');

        Route::get('/{id}', 'show')->name('show')->middleware(['auth', 'role']);

        Route::get('/{id}/edit', 'edit')->name('edit')->middleware(['auth']);

        Route::put('/{id}', 'update')->name('update')->middleware(['auth']);

        Route::delete('/{id}', 'destroy')->name('destroy')->middleware(['auth']);
});
