<?php

use App\Product;
use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/*
* Product Restful service
*/
Route::get('products', 'ProductsController@index');
Route::get('products/{product}', 'ProductsController@show');
Route::post('products','ProductsController@store');
Route::put('products/{product}','ProductsController@update');
Route::delete('products/{product}', 'ProductsController@delete');