<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Product , ProductVariant};

class ProductVariantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        // first valiation ... then ...
        $product = Product::where('id' , $request->product_id )->first() ;
        foreach ($request->variants as $variant) {
            ProductVariant::create([
                'product_id' => $request->product_id ,
                'color' => $variant['color'] ,
                'size' => $variant['size'] ,
                'price' => $variant['price'] != null ? $variant['price']  : $product->price ,
                'stock' => $variant['stock'] ,
                'sku' => $product->sku .'-'. $variant['color'] . '-' . $variant['size']
            ]) ;
        }
        return redirect()->back()->with('success' , 'تم إنشاء الخصائص بنجاح') ;

    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        return 15 ;
    }
}
