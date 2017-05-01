<?php

namespace App\Http\Controllers;

use App\Shop;
use App\User;
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
            return response()->json(['result' => 'wrong email or password.']);
        }
        return response()->json(['result' => $token]);
    }

    public function get_user_details(Request $request)
    {
        $input = $request->all();
        //$user = JWTAuth::toUser($request->header('X-Authorization'));
        return response()->json($request->attributes['user']);
    }

}
