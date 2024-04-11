<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $user->update(['token' => \Illuminate\Support\Str::random(60)]);
        return response()->json(['token' => $user->token]);
    }
    public function logout(Request $request)
    {
        $request->user->update(['token' => null]);
        return response()->json(['message' => 'Logged out successfully']);
    }
}
