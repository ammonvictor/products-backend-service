<?php

use App\Product;
use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/*
* Product Restful service
*/
Route::group(['prefix' => 'products'], function ()
{
	Route::get('/', 'ProductsController@index');
	Route::get('/{product}', 'ProductsController@show');
	Route::post('/','ProductsController@store');
	Route::put('/{product}','ProductsController@update');
	Route::delete('/{product}', 'ProductsController@delete');
});