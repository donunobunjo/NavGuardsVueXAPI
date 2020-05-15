<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function register(Request $request){
        $validator = Validator::make($request->all(),[
            'name'=>'required',
            'email'=>'required|email',
            'password'=>'required'
        ]);
        if ($validator->fails()){
            return Response::json(['error'=>$validator->errors()],401);
        }
        $user = User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>bcrypt($request->password),
        ]);
        $token = $user->createToken('myToken')->accessToken;
        $name = $user->name;
        return Response::json(['name'=>$name,'token'=>$token]);
    }

    public function login(Request $request){
        
        $credentials=['email'=>$request->email,'password'=>$request->password];

        if (Auth::attempt($credentials)){
            $user=Auth::user()->name;
            $token=Auth::user()->createToken('myToken')->accessToken;
            return Response::json(['user'=>$user,'token'=>$token],200);
        }

        return Response::json(['error'=>'Unauthorized'],401);
    }

    public function logout(){
        $user = Auth::user()->name;
        return Response::json(['msg'=>$user]);
    }
}
