<?php

namespace App\Http\Controllers\Website ;

use App\Events\OrderCreated;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index()
    {
        //
    }


    // create order and payment process
    // public function store(Request $request)
    // {
    //     try{
    //         DB::beginTransaction() ;
    //         $carts = Cart::with('variant')->get() ;  // global scope get carts using cookie id or user_id

    //         // number of order is created using observe
    //         $order = Order::create([
    //             'user_id' => auth()->user()->id ,
    //             'total_price' => $request->total_price ,
    //         ]) ;

    //         foreach ($carts as $cart)
    //         {
    //             // order => product of price determine using option (color , size)
    //             $orderItem = OrderItem::create([
    //                 'order_id' => $order->id ,
    //                 'product_id' => $cart->product->id ,
    //                 'product_name' => $cart->product->title ,
    //                 'sku' => $cart->variant->sku ,
    //                 'price' => $cart->variant->price ,
    //                 'quantity' => $cart->quantity ,
    //                 'options' => [
    //                     'color' => $cart->variant->color ,
    //                     'size' => $cart->variant->size
    //                 ]
    //             ]);
    //             $stock_decrement = ProductVariant::where('id' , $cart->variant->id)->decrement('stock' , $orderItem->quantity) ;
    //             $cart->delete() ;
    //         }
    //         // event(new OrderCreated($order)) ;
    //         DB::commit() ;
    //         return redirect()->back()->with('success' , 'تم إنشاء الطلب بنجاح');
    //     }catch(\Exception $e){
    //         DB::rollBack() ;
    //         return redirect()->back()->with('error' , $e->getMessage()) ;
    //     }
    // }

    // public function delete(Request $request , $order_id)
    // {
    //     try{
    //         DB::beginTransaction();
    //         $order = Order::with('orderItems')->findorfail($order_id) ;
    //         foreach ($order->orderItems as $orderItem)
    //         {
    //             ProductVariant::where([
    //                 'product_id' => $orderItem->product_id ,
    //                 'color' => $orderItem->options['color'],
    //                 'size' => $orderItem->options['size'],
    //                 ])->increment('stock' , $orderItem->quantity) ;
    //                 $orderItem->delete();
    //         }
    //         $order->delete() ;
    //         DB::commit() ;
    //         return redirect()->back()->with('success' , 'تم حذف الطلب بنجاح');
    //     }catch(\Exception $e){
    //         DB::rollBack() ;
    //         return redirect()->back()->with('error' , $e->getMessage()) ;
    //     }
    // }
}
