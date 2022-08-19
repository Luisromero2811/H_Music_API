<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login(Request $request){

        $request->validate([
            'email'=> 'required|email|string|max:255',
            'password'=> 'required|string|max:255|min:6',
        ]);

        $user = User::where('email', $request->input('email'))->first();
        
        if (! $user || ! Hash::check($request->input('password'), $user->password)) {
            return response()->json(["status"=>FALSE,"message"=>"Email o contraseña incorrecta"],200);
        }
        
        if($user->rol == "admin"){
            $token = $user->createToken($request->email,['admin:admin','user:user'])->plainTextToken; 
        }else{ 
        $token = $user->createToken($request->email,['user:user'])->plainTextToken; 
        }
        
        return response()->json(["status"=>TRUE,"token"=>$token,"rol"=>$user->rol,"id"=>$user->id,"user"=>$user],200);
    }


    public function logout(Request $request){
        return response()->json(["status"=>TRUE,"Tokens afectados" => $request->user()->tokens()->delete()],200);
    }
    
    public function check(Request $request){
        return response()->json(["status"=>TRUE,"user" => $request->user()],200);
    }
}
