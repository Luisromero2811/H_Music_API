<?php

namespace App\Http\Controllers;

use App\PlaylistUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PlaylistUserController extends Controller
{
    function mgPlaylist(Request $request){
        $request->validate([
            'user_id'=>'required|integer',
            'playlist_id'=>'required|integer',
        ]);
        
        $mgplaylist = new PlaylistUser;

        $mgplaylist->user_id = $request->input('user_id');
        $mgplaylist->playlist_id = $request->input('playlist_id');

        if($mgplaylist->save()){
            return response()->json(["status"=>TRUE,"message"=>"Se agrego la playlist correctamente"],200);
        }else{
            return response()->json(["status"=>FALSE,"message"=>"Algo salio mal"],200);
        }
    }

    function eliminarMgPlaylist(Request $request,$id){
        $request->validate([
            'user_id'=>'required|integer',
        ]);

        $user_id = $request->input('user_id');

        
        $elimnarmgplaylist = PlaylistUser::where('user_id', $user_id)->where('playlist_id',$id)->delete();
        
        return response()->json(["status"=>TRUE,"message"=>"Se elimino la playlist del usuario correctamente"],200);
    }

    function listarMgPlaylist(Request $request,$user_id){
        
        $playlists = DB::table('playlists')
            ->join('playlists_usuarios', 'playlists_usuarios.playlist_id', '=', 'playlists.id')
            ->select('playlists.*')
            ->where('playlists_usuarios.user_id',$user_id)
            ->get();

        return response()->json(["status"=>TRUE,"playlists"=>$playlists],200);
    }
}
