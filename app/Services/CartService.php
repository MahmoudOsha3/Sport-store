<?php
namespace App\Services ;

use App\Models\Cart;
use App\Models\ProductVariant;
use Illuminate\Support\Facades\DB;

class CartService
{
    public function createCart($request)
    {
        try{
            $checkStock = $this->checkStock($request);
            if($checkStock['status'] == 1 ){
                $this->insertCart($request) ;
                return redirect()->back()->with(['success' => 'تم إدخال البيانات الي السلة']) ;
            }
            return redirect()->back()->with(['error' => $checkStock['Message']]) ;
        }catch(\Exception $e){
            return redirect()->back()->with(['error' => $e->getMessage()]) ;
        }
    }

    public function checkStock($request)
    {
        $checkStock = ProductVariant::where('id' , $request->variant_id)->value('stock') ;
        if ($checkStock < $request->quantity) {
            $return = ['status' => 0 , 'Message' => 'الكمية المطلوبة أكبر من المتاح في المخزون'] ;
        }
        $return = ['status' => 1 , 'Message' => ''] ;
    }

    public function insertCart($request)
    {
        $cart = Cart::create([
            'product_id' => $request->product_id ,
            'user_id' => auth()->user()->id ?? null ,
            'quantity' => $request->quantity ,
            'variant_id' => $request->variant_id ,
            'option' => $request->option ?? "null" ,
        ]);
        return $cart ;
    }
}
