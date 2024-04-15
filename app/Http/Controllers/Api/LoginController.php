<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
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

        
        $users = DB::table('users')->pluck('token','email');
        return response()->json(['sucess '=>"user",'token' => $users]);

    }

    // public function logout(Request $request)
    // {
    //     Auth::logout();
    //     $request->user->update(['token' => null]);
    //     return response()->json(['message' => 'Logged out successfully']);
    // }
}
