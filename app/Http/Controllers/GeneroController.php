<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Genero;
class GeneroController extends Controller
{
    function getGeneros(){
        $generos = Genero::all();
        return response()->json($generos);
    }
}
