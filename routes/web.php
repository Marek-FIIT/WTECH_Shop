<?php

use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Controllers\CategoryController;
Route::resource('categories', CategoryController::class);

use App\Http\Controllers\ProductController;
Route::resource('products', ProductController::class);

Route::get('/', function () {
    /*$categories = array();//[][][] = "000";
    $firstLevelCategories = FirstLevelCategory::all();

    for ($i = 0; $i < sizeof($firstLevelCategories); $i++) {
        print($firstLevelCategories[$i]->name);
        $categories[$firstLevelCategories[$i]->name] = array();
        $secondLevelCategories = SecondLevelCategory::where('1st_level_category_id', $firstLevelCategories[$i]->id)->get();

        for ($j = 0; $j < sizeof($secondLevelCategories); $j++) {
            $categories[ $firstLevelCategories[$i]->name]
            [$secondLevelCategories[$j]->name] = ThirdLevelCategory::where('2nd_level_category_id', $secondLevelCategories[$j]->id)->get();
        }
    }*/

    return view('index');//->with('categories', $categories);
});

Route::resource('brands', BrandsController::class);
