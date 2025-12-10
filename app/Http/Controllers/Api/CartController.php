<?php

namespace App\Http\Controllers\Api ;
use App\Http\Controllers\Controller;
use App\Http\Requests\Website\CartRequest;
use App\Models\Cart;
use App\Models\ProductVariant;
use App\Traits\ResponseApiTrait;
use Illuminate\Http\Request;

class CartController extends Controller
{
    use ResponseApiTrait ;
    public function index()
    {
        $carts = Cart::get() ; // condition using Gloabl Scope (Cooke_id)
        return $this->getDataApi($carts , 200) ;
    }

    public function store(CartRequest $request)
    {
        $validated = $request->validated() ;
        // store cookie_id in Cart Model using observer
        $checkStock = ProductVariant::where('id' , $request->variant_id)->value('stock') ;
        if ($checkStock < $request->quantity) {
            return $this->FaildApi('الكمية المطلوبة أكبر من المتاح في المخزون' , 200);
        }

        $cart = Cart::create([
            'product_id' => $request->product_id ,
            'user_id' => auth()->user()->id ?? null ,
            'quantity' => $request->quantity ,
            'variant_id' => $request->variant_id ,
            'option' => $request->option ?? "null" ,
        ]);
        return $this->successApi($cart , 'cart is created' , 201) ;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
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
    public function destroy($id)
    {
        $cart = Cart::findorfail($id) ;
        $cart->delete() ;
        return $this->DeleteApi('تم حذف المنتج من السلة' , 200) ;
    }
}
