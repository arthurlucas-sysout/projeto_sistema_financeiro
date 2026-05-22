<?php

use App\Http\Controllers\UserController;

Route::group([
    'prefix' => 'users',
    'as' => 'users.'
], function(){

    Route::get('/', [UserController::class, 'index'])->name('index')->middleware('auth'); // Buscar todos os usuários

    Route::get('/create', [UserController::class, 'create'])->name('create'); // Exibir tela de criação

    Route::post('/', [UserController::class, 'store'])->name('store'); // Criar um usuário

    Route::get('/{id}', [UserController::class, 'show'])->name('show')->middleware('auth'); // Buscar um usuário por id

    Route::get('/{id}/edit', [UserController::class, 'edit'])->name('edit')->middleware('auth'); // Exibir tela de edição

    Route::put('/{id}', [UserController::class, 'update'])->name('update')->middleware('auth'); // Atualizar um usuário conforme um id

    Route::delete('/{id}', [UserController::class, 'destroy'])->name('destroy')->middleware('auth'); // Deletar um usuário conforme um id
});
