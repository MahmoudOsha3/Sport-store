<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::get() ;
        return view('website.home' , compact('products'));
    }

    public function category($category_id)
    {
        $category = Category::findorfail($category_id);
        $products = Product::where('category_id' , $category_id)->paginate(8) ;
        return view('website.categories.index' , compact('products','category')) ;
    }

    public function show($id)
    {
        $product = Product::with('variants')->Where(['id' => $id , 'status' => 'active'])->first();
        if(!$product){ abort(404) ; }
        return view('website.product' , compact('product'));
    }


}
