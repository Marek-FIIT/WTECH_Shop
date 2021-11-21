<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Color;
use App\Models\Product;

class BrandsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brandsList = Brand::orderBy('name')->get();
        $colorsList = Color::orderBy('name')->get();
        $sidebarTitle = 'Značky';
        $name = $sidebarTitle;
        $products = Product::all();
        return view('brands.index')->with('data', [
            'brandslist' => $brandsList,
            'colorsList' => $colorsList,
            'sidebarTitle' => $sidebarTitle,
            'name' => $name,
            'products' => $products,
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
        $brandsList = Brand::orderBy('name')->get();
        $colorsList = Color::orderBy('name')->get();
        $sidebarTitle = 'Značky';
        $name = Brand::select('name')->find($id)->name;
        $products = Product::join('product_brand', 'products.id', '=', 'product_brand.product_id')->where('brand_id', $id)->get();


        return view('brands.index')->with('data', [
            'brandslist' => $brandsList,
            'colorsList' => $colorsList,
            'sidebarTitle' => $sidebarTitle,
            'name' => $name,
            'products' => $products
        ]);
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
