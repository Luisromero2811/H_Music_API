<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Playlist;

class PlaylistController extends Controller
{
    function create(Request $request){

        $request->validate([
            'nombre'=>'required|string|min:1|max:80',
        ]);

        $playlist = new Playlist;

        $playlist->nombre = $request->input('nombre');

        if($request->input('descripcion')){
            $playlist->descripcion = $request->input('descripcion');
        }else{
            $playlist->descripcion = "";
        }
        
        $playlist->user_id = $request->user()->id;
        

        if($playlist->save()){
            return response()->json(["status"=>TRUE,"playlist"=>$playlist],201);
        }else{
            return response()->json(["status"=>FALSE,"message"=>"Algo salio mal"],200);
        }
    }

    function listar(Request $request){

        $playlists = Playlist::where('user_id',$request->user()->id)->get();

        if($playlists){
            return response()->json(["status"=>TRUE,"playlists"=>$playlists],200);
        }else{
            return response()->json(["status"=>FALSE,"message"=>"Algo salio mal"],200);
        }
    }

    function update(Request $request,$id){
        $playlist = Playlist::where('id',$id)->where('user_id',$request->user()->id)->first();

        if(!$playlist){
            return response()->json(["status"=>FALSE,"message"=>"Esta playlist no te pertenece"],200);
        }

        if($request->input('nombre')){
            $playlist->nombre = $request->input('nombre');
        }

        if($request->input('descripcion')){
            $playlist->descripcion = $request->input('descripcion');
        }

        if($playlist->save()){
            return response()->json(["status"=>TRUE,"playlist"=>$playlist],200);
        }else{
            return response()->json(["status"=>FALSE,"message"=>"Algo salio mal"],200);
        }
    }

    function delete(Request $request, $id){
        $playlist = Playlist::where('id',$id)->where('user_id',$request->user()->id)->first();

        if(!$playlist){
            return response()->json(["status"=>FALSE,"message"=>"Esta playlist no te pertenece"],200);
        }
        
        if($playlist->delete()){
            return response()->json(["status"=>TRUE,"message"=>"Playlist Eliminada"],200);
        }else{
            return response()->json(["status"=>FALSE,"message"=>"Algo salio mal"],200);
        }
    }
}
