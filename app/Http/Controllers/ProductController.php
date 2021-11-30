<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductBrand;
use App\Models\ProductImage;
use App\Models\ProductMaterial;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Shopping_cart;
use App\Models\Shopping_cart_content;

class ProductController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);

        $brands = ProductBrand::join('brands', 'product_brand.brand_id', '=', 'brands.id')
            ->where('product_brand.product_id', $id)
            ->get();
        $materials = ProductMaterial::join('materials', 'product_material.material_id', '=', 'materials.id')
            ->where('product_material.product_id', $id)
            ->get();

        $variants = ProductVariant::join('colors', 'product_variants.color_id', '=', 'colors.id')
            ->where('product_variants.product_id', $id)
            ->get();
        $images = ProductImage::where('product_images.product_id', $id)->orderBy('src_image')->get();

        $cart = session()->get('cart');
        if ($cart == null)
            $cart = [];
        else
            session()->put('cart', 'ahoj');


        //$images = ProductImage::where('product_id', $product->id)->get();

        return view('product')->with(['product'    => $product,
            'id'         => $id,
            'brands'     => $brands,
            'materials'  => $materials,
            'variants'   => $variants,
            'images'     => $images,
            'cart'       =>  $cart]);
    }

    public function store(Request $request)
    {

        if (Auth::check()) {
            $cart = Shopping_cart::where('user_id', auth()->user()->id)->first();
            if (empty($cart)) {
                $cart = Shopping_cart::create(['user_id' => auth()->user()->id, 'last_time_active' => "2011-01-01 00:00:00"]);
            }
            $product = Shopping_cart_content::where([['shopping_cart_id', '=', $cart->id], ['product_id', '=', $request->id]])->first();
            if (empty($product)) {
                $product = Shopping_cart_content::create(['shopping_cart_id' => $cart->id, 'product_id' => $request->id, 'product_count' => 1]);
            }
            else {
                $product = Shopping_cart_content::where('id', $product->id)->increment('product_count', 1);
            }
        }
        else {
            $content = $request->session()->get('content');
            if (empty($content)) {
                $request->session()->put('content', []);
                $request->session()->put('count', []);
            }

            if(in_array([$request->id], session('content'))) {
                $key = array_search([$request->id], session('content'));
                $arr = session()->get('count');
                $arr[$key] = $arr[$key]+1;
                $request->session()->put('count', $arr);
            }
            else {
                $request->session()->push('content', [$request->id]);
                $request->session()->push('count', 1);

                echo 'pridane';
            }
        }
        return redirect('/products/' . $request->id);


    }
}
