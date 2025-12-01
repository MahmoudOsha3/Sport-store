<?php

namespace App\Interfaces ;

use Illuminate\Http\Request;

interface PaymentGatewayInterface
{
    public function sendPayment(Request $request , $order_id , $total_price) ;

    public function callback($request) ;

}
