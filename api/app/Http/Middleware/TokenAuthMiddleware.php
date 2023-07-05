<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TokenAuthMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $token = base64_decode($request->bearerToken());
        
        if ($token === env('TOKEN_KEY')) {
            return $next($request);
        }
        
        return response()->json(['message' => 'Unauthorized'], 401);
    }
}
