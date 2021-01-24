<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return CategoryResource::collection(Category::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'slug'=>'required',
            'description'=>'required',
            'price'=>'required',
            'weight'=>'required',
            'location'=>'required',
            'category_id'=>'required',
            'stock'=>'required'
        ]);

        $category = new Category([
            'name' => $request->get('name'),
            'slug' => $request->get('slug'),
            'description' => $request->get('description'),
            'price' => $request->get('price'),
            'weight' => $request->get('weight'),
            'stock' => $request->get('stock'),
            'location' => $request->get('location'),
            'image' => $request->get('image'),
            'category_id' => $request->get('category_id'),
        ]);
        $category->save();
        return response()->json([
            "message" => "Category created"
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        if (Category::where('id', $id)->exists()) {
            return response()->json(new CategoryResource(Category::findOrFail($id)),200);
        } else {
            return response()->json([
                "message" => "Category not found"
            ], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {

        if (Category::where('id', $id)->exists()) {
            $category = Category::find($id);

            $category->name = is_null($request->name) ? $category->name : $request->name;
            $category->slug = is_null($request->slug) ? $category->slug : $request->slug;
            $category->description = is_null($request->description) ? $category->description : $request->description;
            $category->price = is_null($request->price) ? $category->price : $request->price;
            $category->weight = is_null($request->weight) ? $category->slug : $request->weight;
            $category->location = is_null($request->location) ? $category->location : $request->location;
            $category->stock = is_null($request->stock) ? $category->stock : $request->stock;
            $category->save();

            return response()->json([
                "message" => "Category updated successfully"
            ], 200);
        } else {
            return response()->json([
                "message" => "Category not found"
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        if(Category::where('id', $id)->exists()) {
            $category = Category::find($id);
            $category->delete();

            return response()->json([
                "message" => "Category deleted"
            ], 202);
        } else {
            return response()->json([
                "message" => "Category not found"
            ], 404);
        }
    }
}
