<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Redis;

class UserController extends Controller
{
    public function register(Request $request) {
        $request->validate([
            'password' => 'required'
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;

        $user->save();
        $token = $user->createToken('mytoken')->plainTextToken;

        return response()->json([
            'Message' => 'Registerd',
            'User' => $user,
            'Token'=> $token 
        ]);
    }

    public function login(Request $request) {
        let 
    }
}