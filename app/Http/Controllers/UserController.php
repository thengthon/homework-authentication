<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

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
        $token = $user->createToken('token')->plainTextToken;

        return response()->json([
            'Message' => 'Registerd',
            'User' => $user,
            'Token'=> $token 
        ]);
    }

    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if(!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['Message' => 'Bad Login'], 401);
        }
        $token = $user->createToken('mytoken')->plainTextToken;
        
        return response()->json([
            'User' => $user,
            'Token' => $token,
        ]);
    }
    
    public function logout(Request $request) {
        auth()->user()->tokens()->delete();
        return response()->json(['Message' => 'Token Deleted']);
    }
}
// 1|h2151wc1LUHFfhhsH0L6a2R3iSYgIXcgSPT2Rh4G