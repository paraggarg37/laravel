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


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::group(['middleware' => ['api', 'cors'], 'prefix' => 'api'], function () {

    Route::get('shop/summary', 'ShopController@getSummary');
    Route::resource('shop', 'ShopController');
    Route::resource('image', 'ImageController');

    Route::resource('product', 'ProductController');
    Route::resource('category', 'CategoryController');

    Route::resource('order', 'OrdersController');

    Route::post('register', 'AuthController@register');
    Route::post('login', 'AuthController@login');
    Route::group(['middleware' => 'jwt-auth'], function () {
        Route::get('user', 'AuthController@get_user_details');
    });

    Route::get('category/image/{id}', 'CategoryController@getImage');
    Route::get('shop/image/{id}', 'ShopController@getImage');


    Route::get('shop/{id}/category', ['uses' => 'ShopController@getCategory', 'parameters' => [
        'shop' => 'id'
    ]]);

});

