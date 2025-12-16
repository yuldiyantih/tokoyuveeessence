<?php

namespace App\Http\Controllers;

use App\Models\Product;

class FrontendProductController extends Controller
{

    public function index()
    {
        $products = Product::all();
        return view('frontend.product.index', compact('products'));
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('frontend.product.show', compact('product'));
    }
}
