<?php

namespace App\Http\Controllers;

use App\Shop;
use App\User;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Http\Request;

class AuthController extends Controller
{

    public function register(Request $request)
    {

        Log::info("register request");
        $data = $request->all();


        // $shop = Shop::where('shop_id', 1)->first();

        try {
            if (isset($data['shop_name'])) {
                $shop = Shop::create([
                    'shop_name' => $data['shop_name'],
                ]);


                Log::info("shop created " . $shop['shop_id']);

                $user = User::create([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'shop_id' => $shop['shop_id'],
                    'password' => bcrypt($data['password']),
                ]);

                Log::info("user created" . $user);

                $user->load('shop');
            } else {

                $user = User::create([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'password' => bcrypt($data['password']),
                ]);

            }
        } catch (QueryException $e) {
            return response()->json(['message' => 'User already exists.', 'error' => true], 400);
        }

        return $user;

        /*    $data = $request->all();

            return User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
            ]);*/


    }

    public function login(Request $request)
    {
        $input = $request->all();
        if (!$token = JWTAuth::attempt($input)) {
            return response()->json(['message' => 'wrong email or password.', 'error' => true], 401);
        }
        $user = JWTAuth::toUser($token);

        return response()->json(['token' => $token, 'user' => $user]);
    }

    public function get_user_details(Request $request)
    {
        return response()->json($request->attributes['user']);
    }

}
