<?php

namespace App\Http\Middleware;

use Closure;
use League\Flysystem\Exception;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
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
            $request->attributes = ['user' => $user];

        } catch (TokenExpiredException $e) {

            return response()->json([
                'message' => 'Token expired.',
                'error' => true,
            ], 401);

        } catch (TokenInvalidException $e) {
            return response()->json([
                'message' => 'Invalid Credentials.',
                'error' => true,
            ], 404);
        } catch (JWTException $e) {
            return response()->json([
                'message' => 'Token absent.',
                'error' => true,
            ], 404);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Something went wrong.',
                'error' => true,
            ], 404);
        }
        return $next($request, $user);
    }
}
