<?php

namespace App\Http\Controllers;

use App\Models\Shopping_cart_content;
use Illuminate\Http\Request;
use App\Models\Shopping_cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check()) {
            $products = [];
            $content = Shopping_cart::join('shopping_carts_content', 'shopping_carts.id', '=', 'shopping_carts_content.shopping_cart_id')->get();
            $price = 0;
            foreach ($content as $item) {
                $product = Product::where('id', $item->product_id)->first();
                array_push($products, [$product, $item->product_count]);
                $product_price = $product->price * $item->product_count;
                $price = $price + $product_price;
            }
            $tax_free = $price*0.8;
            return view('shoppingCart.cart')->with(['products' => $products,
            'price' => $price,
                'tax_free' => $tax_free]);
        }


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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Product $task)
    {
        $product = Shopping_cart_content::where('product_id', $request->product);
        $product->delete();
        return redirect('cart');
    }
}

