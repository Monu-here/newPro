<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
 
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !\Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $user ->update(['token'=>Str::random(60)]);

        // dd($token);


        return response()->json(['sucess '=>"user",'data'=>['token' => $user->token]]);

    }

    // public function logout(Request $request)
    // {
    //     Auth::logout();
    //     $request->user->update(['token' => null]);
    //     return response()->json(['message' => 'Logged out successfully']);
    // }
}
