<?php

namespace App\Http\Controllers\Website;

use App\Events\OrderCreated;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ProductVariant;
use App\Notifications\OrderCreatedNotifiaction;
use App\Services\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public $orderServivce ;
    public function __construct(OrderService $orderServivce)
    {
        $this->orderServivce = $orderServivce ;
    }
    // Details of order (user of auth)
    public function index()
    {
        $orders = Order::with('orderItems')->where('user_id' , auth()->user()->id)->latest()->get() ;
//         foreach($orders as $order){
//             foreach($order->orderItems as $item)
//             {
//                 return $item->product ;
//             }
//         }
// // /        return $orders;
        return view('website.orders.index' , compact('orders')) ;
    }

    // create order
    public function store(Request $request)
    {
        try{
            $this->orderServivce->CreateOrder($request) ;
            return redirect()->route('order.index')->with('success' , 'تم إنشاء الطلب بنجاح');
        }catch(\Exception $e){
            return redirect()->back()->with('error' , $e->getMessage()) ;
        }
    }

    public function delete(Request $request , $order_id)
    {
        try{
            DB::beginTransaction();
            $order = Order::with('orderItems')->findorfail($order_id) ;
            foreach ($order->orderItems as $orderItem)
            {
                ProductVariant::where([
                    'product_id' => $orderItem->product_id ,
                    'color' => $orderItem->options['color'],
                    'size' => $orderItem->options['size'],
                    ])->increment('stock' , $orderItem->quantity) ;
            }
            $order->delete() ;
            DB::commit() ;
            return redirect()->back()->with('success' , 'تم حذف الطلب بنجاح');
        }catch(\Exception $e){
            DB::rollBack() ;
            return redirect()->back()->with('error' , $e->getMessage()) ;
        }
    }

}
