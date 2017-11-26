<?php

namespace App\Http\Controllers;

use App\Category;
use App\Images;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;


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

        $data = $request->all();


        if (isset($data['images'])) {
            $images_data = $data['images'];
            unset($data['images']);
            $images = Images::find($images_data);
            $category = Category::create($data);
            $category->images()->saveMany($images);
        } else {
            $category = Category::create($data);
        }


        return $category->toJson();

        /*Log::info('Creating category ..');

        $data = $request->all();
        Log::info('Creating category name ..' . $data['category_name']);
        Log::info('Creating category name ..' . $data['category_image']);


        $model = Category::create([
            'category_name' => $data['category_name'],
            'category_description' => $data['category_description'],
            'category_image' => $data['category_image'],
            'category_shop_id' => $data['category_shop_id']
        ]);

        return $model->toJson();*/
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //$category->load('products');

        Log::info("category image is " . $category->category_image);
        $options = app('request')->header('accept-charset') == 'utf-8' ? JSON_UNESCAPED_UNICODE : null;
        return response()->json($category, 200, [], $options);
    }

    public function getImage($index)
    {
        $category = Category::find($index);
        $image = base64_decode($category->getOriginal('category_image'));
        $response = Response::make($image, 200);
        $response->header('Content-Type', 'image/png');
        return $response;
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

        if (isset($data['images'])) {
            $images_data = $data['images'];
            unset($data['images']);

            $images = Images::find($images_data);
            $all_images = $category->images()->getResults();


            foreach ($all_images as $i) {

                Log::info("id is " . $i->id);

                if (in_array($i->id, $images_data)) {

                } else {
                    Log::info("deleting" . $i);
                    $i->delete();
                }
            }

            $category->images()->saveMany($images);
        }


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
        $all_images = $category->images()->getResults();
        foreach ($all_images as $i) {
            $i->delete();
        }
        $category->delete();
        return $category;
    }
}
