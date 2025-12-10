<?php

namespace App\Http\Controllers\Website ;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interfaces\PaymentGatewayInterface ;
use App\Models\Order;
use App\Models\Payment;

class PaymentController extends Controller
{
    protected PaymentGatewayInterface $paymentGateway ;
    public function __construct(PaymentGatewayInterface $PaymentGatewayType)
    {
        $this->paymentGateway = $PaymentGatewayType ;
    }
    
    public function paymentProcess(Request $request , $order_id)
    {
        try{
            $order = Order::where('id' , $order_id)->first() ;
            return $this->paymentGateway->sendPayment($request , $order_id , $order->total_price) ;
        }catch(\Exception $e){
            return redirect()->back()->with('error' , $e->getMessage()) ;
        }

    }

    public function callBack(Request $request)
    {
        $response = $this->paymentGateway->callBack($request) ;
        if ($response) {
            return redirect()->route('payment.success');
        }
        return redirect()->route('payment.failed');
    }


    public function success()
    {

        return view('website.checkout.payment-success');
    }
    public function failed()
    {

        return view('website.checkout.payment-failed');
    }

}
