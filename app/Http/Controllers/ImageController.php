<?php

namespace App\Http\Controllers;

use App\Images;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Images::all()->toJson();
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
        $image = Images::create($data);
        Log::info('add image' . $image);
        return $image->toJson();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Images $images
     * @return \Illuminate\Http\Response
     */
    public function show(Images $image)
    {


        $image = base64_decode($image->getOriginal('image'));
        $response = Response::make($image, 200);
        $response->header('Content-Type', 'image/png');
        return $response;

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Images $images
     * @return \Illuminate\Http\Response
     */
    public function edit(Images $images)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Images $images
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Images $image)
    {
        $data = $request->all();
        $image->update($data);
        Log::info('Updating Image ' . $image);
        $image->save();

        return $image->toJson();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Images $images
     * @return \Illuminate\Http\Response
     */
    public function destroy(Images $images)
    {
        //
    }
}
