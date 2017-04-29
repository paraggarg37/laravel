<?php

namespace App\Http\Controllers;

use App\Images;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

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
    public function show(Images $images)
    {

        return $images->toJson();
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
    public function update(Request $request, Images $images)
    {

        $data = $request->all();
        $images->update($data);
        Log::info('Updating Image ' . $images);
        $images->save();

        return $images->toJson();
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
