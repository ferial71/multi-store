<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Services\CartManager;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use function GuzzleHttp\Psr7\_caseless_remove;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return inertia('Cart', [
            'cartCount'=> Cart::count(),
            'cartContent' => Cart::content(),
            'cartTotal' =>  Cart::total(),
            'cartLater' => Cart::instance('saveForLater')->content(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store($id)
    {

        $product = Product::findOrFail($id);

        Cart::add($id, $product->name, 1, $product->price)
            ->associate(Product::class);
        return redirect()->route('cart.index')->with('success_message', 'Item was added to cart');
    }
    public function saveLater($id)
    {

        $item=  Cart::get($id);

        Cart::remove($id);

        Cart::instance('saveForLater')->add($id, $item->name, $item->qty, $item->price)
            ->associate(Product::class);
        return redirect()->route('cart.index')->with('success_message', 'Item was added to cart');
    }

    public function remove($id)
    {

        $qty =Cart::get($id)->qty;
        if ($qty > 0) {
            Cart::update($id,['qty' => $qty -1 ]);
        }else{
            Cart::remove($id);
        }


        return redirect()->back();
    }

    public function removeAll($id)
    {

        dd(Cart::content()->where($id)->row);
        if ( is_null(Cart::content()->where($id)) ){
            Cart::remove($id);
            dd('yeag');
        }elseif ( is_null(Cart::instance('saveForLater')->content()->where($id)) ){
            Cart::saveForLater()->remove($id);
            dd('ynn');
        }

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Inertia\Response|\Inertia\ResponseFactory
     */
    public function show()
    {

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
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
