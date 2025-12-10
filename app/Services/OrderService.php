<?php

namespace App\Services ;

use App\Events\OrderCreated;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ProductVariant;
use Illuminate\Support\Facades\DB;

class OrderService
{
    public function CreateOrder($request)
    {
        return DB::transaction(function () use ($request) {

            $carts = Cart::with('variant' , 'product')->get() ;  // global scope get carts using cookie id or user_id

            $couponData = ['discount' => 0, 'coupon' => null];
            
            if ($request->filled('coupon_code')) {
                
                $couponService = app(CouponService::class);
                $totalBeforeCoupon = $this->calculateTotalPrice() ;
                $couponData = $couponService->applyCoupon($request->coupon_code , $totalBeforeCoupon );
                
                if (!$couponData['status']) {
                    throw new \Exception('الكوبون غير صحيح او غير صالح للإستخدام') ;
                } 
            }

            $final_total = $this->calculateTotalPrice() - $couponData['discount'] ;

            // number of order is created using observe
            $order = Order::create([
                'user_id' => auth()->user()->id ,
                'total_price' => $final_total ,
            ]);

            foreach ($carts as $cart)
            {
                $orderItem = $this->createOrderItem($order , $cart) ;
                $this->decreaseStock($cart , $orderItem) ;
                $cart->delete() ;
            }

            if ($couponData['coupon']) {
                $couponService->recordCouponUsage($couponData['coupon'] , $order , $totalBeforeCoupon , $couponData['discount'] );
            }

            // event(new OrderCreated($order));
            return $order;
        });

    }

    public function calculateTotalPrice()
    {
        $total = Cart::join('product_variants', 'carts.variant_id', '=', 'product_variants.id')
            ->selectRaw('SUM(product_variants.price * carts.quantity) as total')
            ->value('total');

        return $total ;
    }


    public function createOrderItem($order , $cart)
    {
        // order => product of price determine using option (color , size)
        $orderItem = OrderItem::create([
            'order_id' => $order->id ,
            'product_id' => $cart->product->id ,
            'product_name' => $cart->product->title ,
            'sku' => $cart->variant->sku ,
            'price' => $cart->variant->price ,
            'quantity' => $cart->quantity ,
            'options' => [
                'color' => $cart->variant->color ,
                'size' => $cart->variant->size
            ]
        ]);
        return $orderItem ;
    }

    public function decreaseStock($cart , $orderItem)
    {
        ProductVariant::where('id' , $cart->variant->id)->decrement('stock' , $orderItem->quantity) ;
    }

    public function deleteOrder($order_id)
    {
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
    }
}
