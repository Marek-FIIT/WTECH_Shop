<?php

namespace App\Http\Controllers;

use App\Models\Product;
use ErrorException;
use Illuminate\Http\Request;
use App\Models\FirstLevelCategory;
use App\Models\SecondLevelCategory;
use App\Models\ThirdLevelCategory;
use App\Models\Brand;
use App\Models\Color;
use App\Models\Material;
use App\Models\ProductVariant;
use Illuminate\Support\Facades\DB;
use League\Flysystem\Exception;

class CategoryController extends Controller
{
    private function sizeCompare($size1, $size2)
    {
        if (is_numeric($size1) and is_numeric($size2))
        {
            if ($size1 == $size2) return 0;
            if ($size1 > $size2)  return -1;
            if ($size1 < $size2)  return 1;
        }

        if ( str_contains($size1, 'S') and !str_contains($size2, 'S')) return 1;
        if (!str_contains($size1, 'S') and  str_contains($size2, 'S')) return -1;

        if ( str_contains($size1, 'L') and !str_contains($size2, 'L')) return -1;
        if (!str_contains($size1, 'L') and  str_contains($size2, 'L')) return 1;

        if ( str_contains($size1, 'M') and  str_contains($size2, 'M')) return 0;

        if ( str_contains($size1, 'S') and  str_contains($size2, 'S'))
        {
            $xcount1 = substr_count($size1, 'X');
            $xcount2 = substr_count($size2, 'X');
            if ($xcount1 == $xcount2) return 0;
            if ($xcount1 > $xcount2)  return 1;
            if ($xcount1 < $xcount2)  return -1;

        }
        if ( str_contains($size1, 'L') and  str_contains($size2, 'L'))
        {
            $xcount1 = substr_count($size1, 'X');
            $xcount2 = substr_count($size2, 'X');
            if ($xcount1 == $xcount2) return 0;
            if ($xcount1 > $xcount2)  return -1;
            if ($xcount1 < $xcount2)  return 1;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $categoryName
     * @return \Illuminate\Http\Response
     */
    public function show($categoryName)
    {
        $category1 = FirstLevelCategory:: where('name', $categoryName)->get();
        $category2 = SecondLevelCategory::where('name', $categoryName)->get();
        $category3 = ThirdLevelCategory:: where('name', $categoryName)->get();

        /*
        switch (1) {
            case sizeof($category1):
                $products = DB::table('products')
                    ->join('3rd_level_categories', 'products.3rd_level_category_id', '=', '3rd_level_categories.id')
                    ->join('2nd_level_categories', '3rd_level_categories.2nd_level_category_id', '=', '2nd_level_categories.id')
                    ->join('1st_level_categories', '2nd_level_categories.1st_level_category_id', '=', '1st_level_categories.id')
                    ->where('1st_level_categories.name', '=', $categoryName)
                    ->orderBy('products.name')
                    ->select('products.*')
                    ->get();
                break;
            case sizeof($category2):
                $products = DB::table('products')
                    ->join('3rd_level_categories', 'products.3rd_level_category_id', '=', '3rd_level_categories.id')
                    ->join('2nd_level_categories', '3rd_level_categories.2nd_level_category_id', '=', '2nd_level_categories.id')
                    ->where('2nd_level_categories.name', '=', $categoryName)
                    ->orderBy('products.name')
                    ->select('products.*')
                    ->get();
                break;
            case sizeof($category3):
                $products = DB::table('products')
                    ->join('3rd_level_categories', 'products.3rd_level_category_id', '=', '3rd_level_categories.id')
                    ->where('3rd_level_categories.name', '=', $categoryName)
                    ->orderBy('products.name')
                    ->select('products.*')
                    ->get();
                break;
        }
        */
        switch (1) {
            case sizeof($category1):
                $products = Product::join('3rd_level_categories', 'products.3rd_level_category_id', '=', '3rd_level_categories.id')
                                   ->join('2nd_level_categories', '3rd_level_categories.2nd_level_category_id', '=', '2nd_level_categories.id')
                                   ->join('1st_level_categories', '2nd_level_categories.1st_level_category_id', '=', '1st_level_categories.id')
                                   ->where('1st_level_categories.name', '=', $categoryName);
                break;
            case sizeof($category2):
                $products = Product::join('3rd_level_categories', 'products.3rd_level_category_id', '=', '3rd_level_categories.id')
                                   ->join('2nd_level_categories', '3rd_level_categories.2nd_level_category_id', '=', '2nd_level_categories.id')
                                   ->where('2nd_level_categories.name', '=', $categoryName);

                break;
            case sizeof($category3):
                $products = Product::join('3rd_level_categories', 'products.3rd_level_category_id', '=', '3rd_level_categories.id')
                                   ->where('3rd_level_categories.name', '=', $categoryName);
                break;
        }
        $filteredSizes = array();
        $filteredBrands = array();
        $filteredColors = array();
        $filteredMaterials = array();

        $lte = 1000;
        $gte = 0;
        $sort = 'az';
        try {
            $queryString = explode('?', explode('/', url()->full())[4])[1];//parse_url(url()->full(), PHP_URL_QUERY);

            foreach (explode('&', $queryString) as $parameter) {
                $key = explode('=', $parameter)[0];
                $value = explode('=', $parameter)[1];

                if (str_contains($key, 'size'))
                    $filteredSizes[$key] = $value;
                if (str_contains($key, 'brand'))
                    $filteredBrands[$key] = $value;
                if (str_contains($key, 'color'))
                    $filteredColors[$key] = $value;
                if (str_contains($key, 'material'))
                    $filteredMaterials[$key] = $value;

                if ($key == 'price_gte')
                    $gte = $value;
                if ($key == 'price_lte')
                    $lte = $value;

                if ($key == 'sort')
                    $sort = $value;
            }

            if (sizeof($filteredBrands) != 0)
                $products = $products->whereIn('products.id', function ($query) use ($filteredBrands) {
                    $query->select('product_brand.product_id')
                        ->from('product_brand')
                        ->join('brands', 'product_brand.brand_id', '=', 'brands.id')
                        ->whereIn('brands.name', $filteredBrands)
                        ->get();
                });

            if (sizeof($filteredMaterials) != 0)
                $products = $products->whereIn('products.id', function ($query) use ($filteredMaterials) {
                    $query->select('product_material.product_id')
                        ->from('product_material')
                        ->join('materials', 'product_material.material_id', '=', 'materials.id')
                        ->whereIn('materials.name', $filteredMaterials)
                        ->get();
                });

            if (sizeof($filteredColors) != 0 or sizeof($filteredSizes) != 0)
                $products = $products->whereIn('products.id', function ($query) use ($filteredColors, $filteredSizes) {
                    $query->select('product_variants.product_id')
                          ->from('product_variants');
                    if (sizeof($filteredColors) != 0)
                        $query->join('colors', 'product_variants.color_id', '=', 'colors.id')
                              ->whereIn('colors.name', $filteredColors);
                    if (sizeof($filteredSizes) != 0)
                        $query->whereIn('product_variants.size', $filteredSizes);

                    $query->get();
                });

            $products = $products->where('products.price', '>=', $gte)
                                 ->where('products.price', '<=', $lte);

            switch ($sort)
            {
                case 'az':
                    $products = $products->orderBy('products.name');
                    break;
                case 'za':
                    $products = $products->orderByDesc('products.name');
                    break;
                case 'lp':
                    $products = $products->orderBy('products.price');
                    break;
                case 'hp':
                    $products = $products->orderByDesc('products.price');
                    break;
            }

        }
        catch (ErrorException $ex)
        {
            $products = $products->orderBy('products.name');
        }

        $products = $products->select('products.*');

        error_log($products->toSql());
        $products = $products->get();

        $categories = array();//[][][] = "000";
        $firstLevelCategories = FirstLevelCategory::all();//orderBy('name')->get();

        for ($i = 0; $i < sizeof($firstLevelCategories); $i++) {
            if ($categoryName == $firstLevelCategories[$i]->name) $superCategory = $firstLevelCategories[$i]->name;
            $categories[$firstLevelCategories[$i]->name] = array();
            $secondLevelCategories = SecondLevelCategory::where('1st_level_category_id', $firstLevelCategories[$i]->id)->orderBy('name')->get();

            for ($j = 0; $j < sizeof($secondLevelCategories); $j++) {
                if ($categoryName == $secondLevelCategories[$j]->name) $superCategory = $firstLevelCategories[$i]->name;
                $categories[$firstLevelCategories[$i]->name][$secondLevelCategories[$j]->name] = array();
                $thirdLevelCategories = ThirdLevelCategory::where('2nd_level_category_id', $secondLevelCategories[$j]->id)->orderBy('name')->get();

                for ($k = 0; $k < sizeof($thirdLevelCategories); $k++) {
                     if ($categoryName == $thirdLevelCategories[$k]->name) $superCategory = $firstLevelCategories[$i]->name;
                    $categories[$firstLevelCategories[$i]->name][$secondLevelCategories[$j]->name][$k] = $thirdLevelCategories[$k]->name;
                }
            }
        }

        $colors    = Color::orderBy('name')->get();
        $brands    = Brand::orderBy('name')->get();
        $materials = Material::orderBy('name')->get();

        $sizes     = ProductVariant::select('size')
                                   ->whereIn('product_id', array_column($products->toArray(), 'id'))
                                   ->get();

        $sizes = array_column($sizes->toArray(), 'size');
        $sizes = array_unique((array)$sizes);
        usort($sizes, array($this, 'sizeCompare'));


        error_log('zaciatok logu');
        error_log(sizeof($brands));
        error_log(sizeof($sizes));
        error_log(sizeof($materials));
        error_log(sizeof($colors));
        error_log('koniec logu');

        return view('category')->with(['products'=>$products,
                                            'chosenCategory'=>$categoryName,
                                            'sizes'=>(array)$sizes,
                                            'brands'=>$brands,
                                            'materials'=>$materials,
                                            'colors'=>$colors,
                                            'categories'=>(object)['superCategory' => $superCategory,
                                                                   'subCategories' => $categories[$superCategory]],
                                            'filters'=>(object)['sizes'     => $filteredSizes,
                                                                'brands'    => $filteredBrands,
                                                                'colors'    => $filteredColors,
                                                                'materials' => $filteredMaterials,
                                                                'gte'       => $gte,
                                                                'lte'       => $lte,
                                                                'sort'      => $sort]]);
    }
}


