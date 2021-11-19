<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

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
        $product = Product::join('product_brand', 'product.id', '=', 'product_brand.product_id')
                          ->join('brands', 'product_brand.brand_id', '=', 'brand.id')
                          ->join('product_material', 'product.id', '=', 'product_material.product_id')
                          ->join('materials', 'product_material.material_id', '=', 'material.id')
                          ->join('colors', 'products.color_id', '=', 'colors.id')
                          ->join('product_images', 'products.id', '=', 'product_images.product_id')
                          ->where('products', $id)
                          ->get();

        return view('product')->with('product', $product);
    }
}
