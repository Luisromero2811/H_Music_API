<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/registro','UserController@registro');     //Registro
Route::post('/login','AuthController@login');   //Login

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/logout','AuthController@logout');     //Cerrar Sesion
    Route::get('/check','AuthController@check');     //Return User
});






