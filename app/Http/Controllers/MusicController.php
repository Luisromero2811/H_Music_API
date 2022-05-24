<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
}
