<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Services\OrderService;
use App\Traits\ResponseApiTrait;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    use ResponseApiTrait ;
    public $orderServivce ;
    public function __construct(OrderService $orderServivce)
    {
        $this->orderServivce = $orderServivce ;
    }

    public function index()
    {
        $orders = Order::with('orderItems')->where('user_id' , auth()->user()->id)->latest()->get() ;
        $this->getDataApi($orders , 200) ;
    }

    public function store(Request $request)
    {
        $cart = Cart::get() ;
        if($cart->isEmpty()){
            return $this->FaildApi('Not Order Found for creating' , 404) ;
        }else{
            $order = $this->orderServivce->CreateOrder($request) ;
            return $this->successApi($order , 'order is created' , 201) ;
        }
    }


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
        $this->orderServivce->deleteOrder($id) ;
        return $this->DeleteApi('order is deleted' , 200) ;
    }
}
