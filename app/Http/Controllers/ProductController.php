<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Brand;
use App\Unit;
use App\Category;

class ProductController extends Controller
{
    function products()
    {
        $brand = Brand::whereis_del(0)->get();
        $unit = Unit::whereis_del(0)->get();
        $subcatlist = Category::whereis_del(0)->orderBy('id', 'desc')->get();
        return view('products.products')->with(['brand' => $brand,'unit' => $unit , 'subcatlist' => $subcatlist]);
    }
}
