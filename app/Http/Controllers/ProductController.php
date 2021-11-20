<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductBrand;
use App\Models\ProductImage;
use App\Models\ProductMaterial;
use App\Models\ProductVariant;
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


        //$images = ProductImage::where('product_id', $product->id)->get();

        return view('product')->with(['product'    => $product,
                                           'brands'     => $brands,
                                           'materials'  => $materials,
                                           'variants'   => $variants,
                                           'images'     => $images]);
    }
}
