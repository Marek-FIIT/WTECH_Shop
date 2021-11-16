<?php

use Illuminate\Support\Facades\Route;
use App\Models\FirstLevelCategory;
use App\Models\SecondLevelCategory;
use App\Models\ThirdLevelCategory;
use App\Http\Controllers\BrandsController;


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

Route::get('/', function () {
    return view('index');//->with('categories', $categories);
});

Route::resource('brands', BrandsController::class);
