<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderResource;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return OrderResource::collection(Order::all());
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
            'Order_id'=>'required',
            'stock'=>'required'
        ]);

        $order = new Order([
            'name' => $request->get('name'),
            'slug' => $request->get('slug'),
            'description' => $request->get('description'),
            'price' => $request->get('price'),
            'weight' => $request->get('weight'),
            'stock' => $request->get('stock'),
            'location' => $request->get('location'),
            'image' => $request->get('image'),
            'Order_id' => $request->get('Order_id'),
        ]);
        $order->save();
        return response()->json([
            "message" => "Order created"
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
        if (Order::where('id', $id)->exists()) {
            return response()->json(new OrderResource(Order::findOrFail($id)),200);
        } else {
            return response()->json([
                "message" => "Order not found"
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

        if (Order::where('id', $id)->exists()) {
            $order = Order::find($id);

            $order->name = is_null($request->name) ? $order->name : $request->name;
            $order->slug = is_null($request->slug) ? $order->slug : $request->slug;
            $order->description = is_null($request->description) ? $order->description : $request->description;
            $order->price = is_null($request->price) ? $order->price : $request->price;
            $order->weight = is_null($request->weight) ? $order->slug : $request->weight;
            $order->location = is_null($request->location) ? $order->location : $request->location;
            $order->stock = is_null($request->stock) ? $order->stock : $request->stock;
            $order->save();

            return response()->json([
                "message" => "Order updated successfully"
            ], 200);
        } else {
            return response()->json([
                "message" => "Order not found"
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
        if(Order::where('id', $id)->exists()) {
            $order = Order::find($id);
            $order->delete();

            return response()->json([
                "message" => "Order deleted"
            ], 202);
        } else {
            return response()->json([
                "message" => "Order not found"
            ], 404);
        }
    }
}
