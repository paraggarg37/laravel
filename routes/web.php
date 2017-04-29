<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::resource('shop', 'ShopController');
Route::resource('image', 'ImageController');

Route::resource('product', 'ProductController');
Route::resource('category', 'CategoryController');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['api'],'prefix' => 'api'], function () {

    Route::post('register', 'AuthController@register');
    Route::post('login', 'AuthController@login');
    Route::group(['middleware' => 'jwt-auth'], function () {
        Route::post('get_user_details', 'AuthController@get_user_details');
    });
});