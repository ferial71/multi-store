<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response|\Inertia\ResponseFactory
     */
    public function index()
    {
        return inertia('Products', [
            'products' => ProductResource::collection(Product::all()),
        ]);
    }


    public function show($id)
    {

        return inertia('Show', [
            'product' => Product::where('id', $id)->first(),
        ]);

    }
}
