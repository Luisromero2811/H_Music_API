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
    
    function updateMusic(Request $request){
        
        $music = Cancion::where('id',$request->id)->first();

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

    function getMusic($id) {
        $music = Cancion::where('id',$id)->first();
        return response()->json($music);
    }

    function deleteMusic($id) {
        $music = Cancion::where('id',$id)->first();
        if ($music->delete()){
            return response()->json(["status"=>true]);
        }else{
            return response()->json(["status"=>false]);
        }
    }
}
