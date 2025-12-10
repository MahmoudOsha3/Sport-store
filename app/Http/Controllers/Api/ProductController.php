<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Traits\ResponseApiTrait;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    use ResponseApiTrait ;
    public function index(Request $request)
    {
        $products = Product::with('category:id,name')->paginate(10) ;
        return $this->getDataApi($products , 200 ) ;
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:320' ,
            'price' => 'required|numeric',
            'compare_price' => 'required|numeric|gt:price' ,
            'image' => 'image|mimes:png,jpg,jpeg',
            'category_id' => 'required|exists:categories,id',
        ]);
        $product = Product::create($validate) ;
        return $this->successApi($product , 'product is created' , 201) ;
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return $this->getDataApi($product , 200) ;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $validate = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string|max:320' ,
            'price' => 'sometimes|required|numeric',
            'compare_price' => 'sometimes|required|numeric|gt:price' ,
            'image' => 'sometimes|required|image|mimes:png,jpg,jpeg',
            'category_id' => 'sometimes|required|exists:categories,id',
        ]);
        $product->update($validate);
        $this->successApi($product , 'Product is updated' , 200) ;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete() ;
        return $this->DeleteApi('product is deleted' , 200) ;
    }
}
