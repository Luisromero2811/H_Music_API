<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Cancion;
use Illuminate\Support\Facades\DB;

class MusicController extends Controller
{
    function getSong(Request $request){
        $filepath = storage_path() . '/app/public/music/' . $request->music . '.' . $request->extension;
        try{
            $file = file_exists($filepath);
        }catch(FileNotFoundException $e){
            return response()->json(["status"=>404]);
        }
        return response()->file($filepath);
        /*if(!Storage::disk('publicMusic')->exists($name)){
            return response()->json(["status"=>FALSE,"message"=>"cancion no encontrada"],404);
        }
        return Storage::disk('publicMusic')->get($name);*/
    }

    function getAllMusics(){
        try{
            $musics = DB::table('canciones')
            ->join('generos','generos.id','=','canciones.genero_id')
            ->select(
            'canciones.id',
            'canciones.Nombre', 
            'canciones.Formato',
            'generos.Genero',
            'canciones.Autor',
            'canciones.Duracion',
            'canciones.Imagen',
            'canciones.Musica')
            ->get();
            return response()->json($musics);
        }catch(Exception $e){
            return response()->json(["status"=>FALSE,"message"=>$e->getMessage()]);
        }
    }
}
