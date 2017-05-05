<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        Log::info('here getting all data');

        $category = Category::with(['products', 'products.images' => function ($query) {
            $query->orderBy('created_at', 'desc');
        }])->get();

        return $category->toJson();
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
        //

        Log::info('Creating category ..');

        $data = $request->all();
        Log::info('Creating category name ..' . $data['category_name']);
        Log::info('Creating category name ..' . $data['category_image']);


        $model = Category::create([
            'category_name' => $data['category_name'],
            'category_description' => $data['category_description'],
            'category_image' => mysql_real_escape_string($data['category_image']),
            'category_shop_id' => $data['category_shop_id']
        ]);

        return $model->toJson();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        $category->load('products');
        return $category->toJson();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Category $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $data = $request->all();
        $category->update($data);
        Log::info('Updating product ' . $category);
        $category->save();

        return $category->toJson();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return $category;
    }
}
