<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;

class UserController extends Controller
{
    //Registro User
    function registro(Request $request){

        $request->validate([
            'nombre'=>'required|string|min:1|max:30',
            'email'=>'required|min:1',
            'password'=>'required|string|min:1',
            'rol'=>'required|max:5',
        ]);

        $user = new User;

        $user->nombre = $request->input('nombre');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->rol = $request->input('rol');

        if($user->save()){
            return response()->json(["status"=>TRUE,"user"=>$user],201);
        }else{
            return response()->json(["status"=>FALSE,"message"=>"Algo salio mal"],500);
        } 

    }

    function update(Request $request){
        $user = User::where('id',$request->user()->id)->first();

        if($request->input('nombre')){
            $user->nombre = $request->input('nombre');
        }

        if($request->input('email')){
            $user->email = $request->input('email');
        }

        if($user->save()){
            return response()->json(["status"=>TRUE,"user"=>$user],200);
        }else{
            return response()->json(["status"=>FALSE,"message"=>"No se pudo actualizar el user"],200);
        }
    }
    
}
