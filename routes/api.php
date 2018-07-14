<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/*
* Product Restful service
*/
Route::group(['prefix' => 'products', 'as' => 'products'], function ()
{
	Route::get('/', 'ProductsController@index');
	Route::post('/','ProductsController@store');
	Route::get('/{product}', 'ProductsController@show');
	Route::delete('/{product}', 'ProductsController@delete');
	Route::put('/{product}','ProductsController@update');
});