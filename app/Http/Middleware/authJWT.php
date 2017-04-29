<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;


class authJWT
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try {
            $user = JWTAuth::toUser($request->header('X-Authorization'));
            $request->attributes = ['user'=>$user];

        } catch (Exception $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException) {
                 return Response::json([
                    'message' => 'Invalid Credentials.',
                    'error' => true,
                ], 404);
            } else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
                return Response::json([
                    'message' => 'Token expired',
                    'error' => true,
                ], 404);
            } else {
                return response()->json(['error' => 'Something is wrong']);
            }
        }
        return $next($request,$user);
    }
}
