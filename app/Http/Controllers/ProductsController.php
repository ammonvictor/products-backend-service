<?php

namespace App\Http\Controllers;

use Auth;
use App\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
	function __construct()
	{
		$this->middleware('auth:api');
	}
	public function index()
	{
		return Auth::user()->products;
	}
	
	public function show(Product $product)
	{
		return $product;
	}
	
	public function store(Request $request)
	{
		$validatedData = $this->validate($request, [
			'title' => 'required|unique:products|max:255',
			'description' => 'required',
			'price' => 'integer',
			'availability' => 'boolean',
			]);
		$product = Auth::user()->products()->create($validatedData);
		
		return response()->json($product, 201);
	}
	
	public function update(Request $request, Product $product)
	{
		$prod = Auth::user()->products()->where('id', $product->id)->update($request->all());
		
		return response()->json($prod, 200);
	}
	
	public function delete(Product $product)
	{
		Auth::user()->products()->where('id', $product->id)->delete();
		
		return response()->json(null, 204);
	}
}
