<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PlaylistCancion;
use App\Cancion;
use Illuminate\Support\Facades\DB;

class PlaylistCancionController extends Controller
{
    function agregarCancion(Request $request){
        $request->validate([
            'cancion_id'=>'required|integer',
            'playlist_id'=>'required|integer',
        ]);
        
        $nuevaCancion = new PlaylistCancion;

        $nuevaCancion->cancion_id = $request->input('cancion_id');
        $nuevaCancion->playlist_id = $request->input('playlist_id');

        if($nuevaCancion->save()){
            return response()->json(["status"=>TRUE,"message"=>"La cancion de agrego correctamente"],200);
        }else{
            return response()->json(["status"=>FALSE,"message"=>"Algo salio mal"],200);
        }
    }

    function cancionesDePlaylist(Request $request,$id){
        $canciones = DB::table('playlists_canciones')
            ->join('canciones', 'canciones.id', '=', 'playlists_canciones.cancion_id')
            ->select('canciones.*')
            ->where('playlists_canciones.playlist_id',$id)
            ->get();

        if($canciones){
            return response()->json(["status"=>TRUE,"canciones"=>$canciones],200);
        }else{
            return response()->json(["status"=>FALSE,"message"=>"Algo salio mal"],200);
        }
    }

    function eliminarCancionDePlaylist(Request $request,$id){
        $request->validate([
            'cancion_id'=>'required|integer',
        ]);

        $cancion = PlaylistCancion::where('cancion_id',$request->input('cancion_id'))
        ->where('playlist_id',$id)->first();

        if($cancion->delete()){
            return response()->json(["status"=>TRUE,"message"=>"Cancion eliminada de la playlist"],200);
        }else{
            return response()->json(["status"=>FALSE,"message"=>"Algo salio mal"],200);
        }
    }


}
