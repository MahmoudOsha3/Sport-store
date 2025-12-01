<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Http\Requests\Website\CartRequest;
use App\Models\Cart;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;


class CartController extends Controller
{
    public function index()
    {
        $carts = Cart::with('variant')->get() ;
        $total = $this->totalPriceOfCarts() ;
        return view('website.carts.index' , compact('carts' ,'total')) ;
    }

    public  function totalPriceOfCarts()
    {
        $total = Cart::join('product_variants' , 'carts.variant_id' , '=' , 'product_variants.id')
            ->selectRaw('SUM(product_variants.price * carts.quantity) as total')->value('total') ;
        return $total ;
    }

    public function store(CartRequest $request)
    {
        try{
            $validated = $request->validated() ;
            // store cookie_id in Cart Model using observer
            $checkStock = ProductVariant::where('id' , $request->variant_id)->value('stock') ;
            if ($checkStock < $request->quantity) {
                return redirect()->back()->with('warning', 'الكمية المطلوبة أكبر من المتاح في المخزون');
            }

            $cart = Cart::create([
                'product_id' => $request->product_id ,
                'user_id' => auth()->user()->id ?? null ,
                'quantity' => $request->quantity ,
                'variant_id' => $request->variant_id ,
                'option' => $request->option ?? "null" ,
            ]);
            return redirect()->back()->with(['success' => 'تم إضافة المنتج إلي السلة']) ;
        }catch(\Exception $e){
            return redirect()->back()->with(['error' => $e->getMessage()]) ;
        }
    }



    public function delete(Request $request)
    {
        try{
            $cart = Cart::findorfail($request->cart_id) ;
            $cart->delete() ;
            return redirect()->back()->with(['success' => 'تم حذف المنتج من السلة']) ;
        }catch(\Exception $e){
            return redirect()->back()->with(['error' => $e->getMessage()]) ;
        }

    }
}
