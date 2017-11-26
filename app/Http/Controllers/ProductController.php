<?php

namespace App\Http\Controllers;

use App\Images;
use App\Product;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return Product::all()->toJson();
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


        if (isset($data['images'])) {
            $images_data = $data['images'];
            unset($data['images']);

            $product = Product::create($data);
            $images = Images::find($images_data);
            $product->images()->saveMany($images);
        } else {
            $product = Product::create($data);
        }


        return $product->toJson();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return $product->toJson();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {

        $data = $request->all();

        if (isset($data['images'])) {
            $images_data = $data['images'];
            unset($data['images']);

            $images = Images::find($images_data);
            $all_images = $product->images()->getResults();


            foreach ($all_images as $i) {

                Log::info("id is " . $i->id);

                if (in_array($i->id, $images_data)) {

                } else {
                    Log::info("deleting" . $i);
                    $i->delete();
                }
            }

            $product->images()->saveMany($images);
        }


        $product->update($data);
        Log::info('Updating product ' . $product);


        $product->save();


        return $product->toJson();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $all_images = $product->images()->getResults();
        foreach ($all_images as $i) {
            $i->delete();
        }
        $product->delete();
        return $product;
    }
}
