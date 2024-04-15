<?php

namespace App\Http\Middleware;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Str;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    protected $except = [
        'api/logintoken', // Adjust this based on your route
    ];
    public function handle($request, Closure $next)
    {
        //     $token = $request->header('Authorization');

        //     if (!$token) {
        //         return response()->json(['message' => 'Authorization header is missing'], 401);
        //     }

        //     $token = str_replace('Bearer ', '', $token);

        //     $user = User::where('token', $token)->first();

        //     if (!$user) {
        //         return response()->json(['message' => 'Unauthorized'], 401);
        //     }

        //     // You may want to add additional checks here such as token expiration, etc.

        //     $request->user = $user;

        //     return $next($request);
        // }
        // Specify routes to skip middleware


        // Check if current route is in except array
        if (in_array($request->route()->uri(), $this->except)) {
            return $next($request);
        }

        $token = $request->header('Authorization');

        if (!$token) {
            return response()->json(['message' => 'Authorization header is missing'], 401);
        }

        $token = str_replace('Bearer ', '', $token);

        $user = User::where('token', $token)->first();

        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        // You may want to add additional checks here such as token expiration, etc.

        $request->user = $user;

        return $next($request);
    }
}
