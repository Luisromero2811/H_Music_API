<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cancion;

class CancionController extends Controller
{
    function create(Request $request){

        $request->validate([
            'Nombre'=>'required|string|min:1|max:80',
            'genero_id'=>'required|integer|min:1|max:30',
            ]);

        $cancion = new Cancion;

        $cancion->Nombre = $request->input('Nombre');
        $cancion->genero_id = $request->input('genero_id');
        //$cancion->Musica = $request->input('Musica');
        //$nameMusica = time().'.'.explode('/',explode(':', substr($cancion->Musica,0,strpos($cancion->Musica,';')))[1])[1];
        $musica = $request->file('Musica');
        $filenamemusica = time().'.'.$musica->extension();
        $musica->move('publicMusic',$filenamemusica);
        //Insertar Cancion
        $cancion->Musica = $filenamemusica;

        $imagen = $request->file('Imagen');
        $filenameimagen = time().'.'.$imagen->extension();
        $imagen->move('publicImage',$filenameimagen);
        //Insertar Cancion
        $cancion->Imagen = $filenameimagen;

        $cancion->Formato = $request->input('Formato');
        $cancion->Autor = $request->input('Autor');
        $cancion->Duracion = $request->input('Duracion');

        return response()->json($cancion);

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
        $music = Cancion::where('id',$id)->first();

        if($request->input('Nombre')){
            $music->Nombre = $request->input('Nombre');
        }

        if($request->input('Formato')){
            $music->Formato = $request->input('Formato');
        }

        if($request->input('Genero')){
            $music->Genero = $request->input('Genero');
        }

        if($request->input('Autor')){
            $music->Autor = $request->input('Autor');
        }

        if($request->input('Duracion')){
            $music->Duracion = $request->input('Duracion');
        }

        if($request->input('Imagen')){
            $music->Imagen = $request->input('Imagen');
        }

        if($request->input('Musica')){
            $music->Musica = $request->input('Musica');
        }

        if($music->save()){
            return response()->json(["status"=>TRUE,"music"=>$music],200);
        }else{
            return response()->json(["status"=>FALSE,"message"=>"No se pudo actualizar el user"],200);
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

