<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PlaylistCancion;
use App\Cancion;

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
        $users = DB::table('playlists_canciones')
            ->join('contacts', 'users.id', '=', 'contacts.user_id')
            ->join('orders', 'users.id', '=', 'orders.user_id')
            ->select('users.*', 'contacts.phone', 'orders.price')
            ->get();

        if($canciones){
            return response()->json(["status"=>TRUE,"canciones"=>$canciones],200);
        }else{
            return response()->json(["status"=>FALSE,"message"=>"Algo salio mal"],200);
        }
    }


}
