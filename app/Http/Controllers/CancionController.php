<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cancion;

class CancionController extends Controller
{
    function create(Request $request){

        $request->validate([
            'nombre'=>'required|string|min:1|max:80',
            'genero'=>'required|string|min:1|max:30',
        ]);

        $cancion = new Cancion;

        $cancion->nombre = $request->input('nombre');
        $cancion->genero = $request->input('genero');
        $cancion->mp3 = "";
        //Insertar Cancion

        if($cancion->save()){
            return response()->json(["status"=>TRUE,"cancion"=>$cancion],201);
        }else{
            return response()->json(["status"=>FALSE,"message"=>"Algo salio mal"],200);
        }
    }

    function listar(Request $request){

        $canciones = Cancion::all();

        if($canciones){
            return response()->json(["status"=>TRUE,"canciones"=>$canciones],200);
        }else{
            return response()->json(["status"=>FALSE,"message"=>"Algo salio mal"],200);
        }
    }

    function update(Request $request,$id){
        $cancion = cancion::where('id',$id)->first();

        if($request->input('nombre')){
            $cancion->nombre = $request->input('nombre');
        }

        if($request->input('genero')){
            $cancion->genero = $request->input('genero');
        }

        if($request->input('mp3')){
            $cancion->genero = $request->input('mp3');
        }

        if($cancion->save()){
            return response()->json(["status"=>TRUE,"cancion"=>$cancion],200);
        }else{
            return response()->json(["status"=>FALSE,"message"=>"Algo salio mal"],200);
        }
    }

    function delete(Request $request, $id){
        $cancion = Cancion::where('id',$id)->first();

        if($cancion->delete()){
            return response()->json(["status"=>TRUE,"message"=>"cancion Eliminada"],200);
        }else{
            return response()->json(["status"=>FALSE,"message"=>"Algo salio mal"],200);
        }
    }
}

