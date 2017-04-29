<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Log;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Http\Request;

class AuthController extends Controller
{

    public function register(Request $request)
    {

        $data = $request->all();

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

    }

    public function login(Request $request)
    {
        $input = $request->all();
        if (!$token = JWTAuth::attempt($input)) {
            return response()->json(['result' => 'wrong email or password.']);
        }
        return response()->json(['result' => $token]);
    }

    public function get_user_details(Request $request)
    {
        $input = $request->all();
        //$user = JWTAuth::toUser($request->header('X-Authorization'));
        return response()->json(['result' => $request->attributes]);
    }

}
