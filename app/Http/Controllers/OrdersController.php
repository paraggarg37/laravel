<?php

namespace App\Http\Controllers;

use App\Address;
use App\Cart;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */

    function randomNumber($length)
    {
        $result = '';

        for ($i = 0; $i < $length; $i++) {
            $result .= mt_rand(0, 9);
        }

        return $result;
    }

    public function store(Request $request)
    {

        $data = $request->all();
        Log::info('Add Order');
        $data['address']['user_id'] = $data["user_id"];
        $address = Address::create($data['address']);
        $referenceId = $this->randomNumber(10);
        $cart = $data["cart"];
        $amount = 0;

        foreach ($cart as $key => $value) {
            $value["reference_id"] = $referenceId;
            $cart[$key] = $value;
            $amount += $value["product_quantity"] * $value["product_price"];
        }

        Cart::insert($cart);

        $order = Order::create([
            "user_id" => $data['user_id'],
            "amount" => $amount,
            "address_id" => $address->id,
            "reference_id" => $referenceId
        ]);

        return $order->toJson();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Order $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        $data = $request->all();
        $order->update($data);
        $order->save();
        return $order->toJson();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
