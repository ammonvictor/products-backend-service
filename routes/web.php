<?php

Route::get('/', function () {
    return view('welcome');
});

Route::get('/products', function () {
    return view('products.index');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
