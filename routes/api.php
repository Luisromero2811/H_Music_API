<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/registro','UserController@registro');     //Registro
Route::post('/login','AuthController@login');   //Login

Route::middleware(['auth:sanctum'])->group(function () {

    Route::post('/logout','AuthController@logout');     //Cerrar Sesion
    Route::get('/check','AuthController@check');     //Return User

    Route::put('/user','UserController@update');    //Actualizar user

    //CRUD playlist para user
    Route::post('/playlist','PlaylistController@create');    //Crear playlist
    Route::get('/playlist','PlaylistController@listar');    //Listar playlist
    Route::put('/playlist/{id}','PlaylistController@update');    //Actualizar playlist
    Route::delete('/playlist/{id}','PlaylistController@delete');    //Eliminar playlist

    //CRUD canciones para admin
    Route::post('/cancion','CancionController@create');    //Crear cancion
    Route::get('/cancion','CancionController@listar');    //Listar cancion
    Route::get('/cancion/genero/{id}','CancionController@listarPorGenero');    //Listar cancion por genero
    Route::put('/cancion/{id}','CancionController@update');    //Actualizar cancion
    Route::delete('/cancion/{id}','CancionController@delete');    //Eliminar cancion

    //Rutas de Playlists
    Route::post('/cancion/playlist/','PlaylistCancionController@agregarCancion');    //Agrega una cancion a una playlst
    Route::get('/canciones/playlist/{id}','PlaylistCancionController@cancionesDePlaylist'); //Mostrar canciones de una playlist

    Route::delete('/cancion/playlist/{id}','PlaylistCancionController@eliminarCancionDePlaylist'); //Elimnar una cancion de una playlist, id= id de la playllist
    
    //Rutas de playlist guardadas por el usuario
    Route::post('/user/playlist','PlaylistUserController@mgPlaylist'); // Guardar playlist que le gusta a un usuario
    Route::delete('/user/playlist/{id}','PlaylistUserController@eliminarMgPlaylist'); //Eliminar una playlist que guardo el usuario = parametro {playlist_id}
    Route::get('/user/playlist/{id}','PlaylistUserController@listarMgPlaylist'); //Listar las playlist que le gustan al usuario = paramaetro {user_Id}
});



Route::get('/music/{music}/{extension}','MusicController@getSong');
Route::get('/music/all','MusicController@getAllMusics');
Route::put('/music/edit','MusicController@updateMusic');
Route::get('/music/{id}','MusicController@getMusic');
Route::get('/generos/all','GeneroController@getGeneros');
Route::delete('/music/{id}','MusicController@deleteMusic');
Route::get('/token', function (Request $request) {
 
    $token = csrf_token();
    return $token;
});

