<?php

namespace App\Http\Controllers;

use App\Category;
use App\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // return Shop::all()->toJson();

        $shops = Shop::has('category')->get();


        return $shops->toJson();
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
    public function store(Request $request)
    {

        $data = $request->all();

        $shop = Shop::create($data);

        Log::info('Showing user profile for user: ' . $shop);

        return $shop->toJson();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Shop $shop
     * @return \Illuminate\Http\Response
     */
    public function show(Shop $shop)
    {
        Log::info('Showing user profile for user: ' . $shop->shop_id);

        //$shop->load('products','products.category','products.images');
        return $shop->toJson();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Shop $shop
     * @return \Illuminate\Http\Response
     */
    public function edit(Shop $shop)
    {
        //
    }


    public function getCategory($id)
    {
        return Category::where('category_shop_id', $id)->get();

    }

    public function getSummary()
    {
        $shops = Shop::setEagerLoads([])->withCount('products')->get();

        return $shops;

    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Shop $shop
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shop $shop)
    {
        //
        $data = $request->all();
        $shop->update($data);
        Log::info('Updating Shop ' . $shop);
        $shop->save();

        return $shop->toJson();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Shop $shop
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shop $shop)
    {
        //
    }
}
