<?php

use App\Http\Controllers\UserController;

Route::group([
    'prefix' => 'users',
    'as' => 'users.'
], function(){

    Route::get('/', 'UserController@index')->name('index'); // Buscar todos os usuários

    Route::get('/create', 'UserController@create')->name('create'); // Exibir tela de criação

    Route::post('/', 'UserController@store')->name('store'); // Criar um usuário

    Route::get('/{id}', 'UserController@show')->name('show'); // Buscar um usuário por id

    Route::get('/{id}/edit', 'UserController@edit')->name('edit'); // Exibir tela de edição

    Route::put('/{id}', 'UserController@update')->name('update'); // Atualizar um usuário conforme um id

    Route::delete('/{id}', 'UserController@destroy')->name('destroy'); // Deletar um usuário conforme um id
});
