<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class ProductController extends Controller
{
    public function index()
    {
        $product = Product::inRandomOrder()->take(8)->get();
        return view('product.index')->with('products', $product);
    }

    public function show($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        return view('product.show')->with('product', $product);
    }
}
