<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('listarClientes', 'ClienteController@index');
Route::get('buscarClientes', 'ClienteController@busquedaClientes');

Route::post('agregarCliente','ClienteController@store');
Route::post('editarCliente','ClienteController@update');
Route::post('borrarCliente', 'ClienteController@destroy');

Route::get('listarCategorias', 'CategoriaController@index');

Route::get('mostrarImagen', 'ImagenController@mostrarImagen');
Route::post('cambiarImagen', 'ImagenController@cambiarImagen');

