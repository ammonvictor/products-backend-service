<?php

use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/products', function (Request $request) {
	$products = Auth::user()->products;
    return view('products.index', ['products' => $products]);
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
