<?php

namespace APP\Services ;

use App\Interfaces\PaymentGatewayInterface;
use App\Mail\ConfirmPayment;
use App\Models\Order;
use App\Services\BasePaymentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class PaymobPaymentService extends BasePaymentService implements PaymentGatewayInterface
{
    protected $base_url ;
    protected $api_key  ;
    protected $total_price ;
    protected $order_id ;
    protected $integrations_id; // setting in paymob بمعني اصح بتوفر دفع من خلال فيزا او محفظة او اي حاجة

    public function __construct() {
        // this is configration of paymob
        $this->api_key = env('PAYMOP_API_KEY') ;
        $this->base_url = env('PAYMOP_BASE_URL') ;
        $this->header = [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ];
        // $this->total_price = ;
        $this->integrations_id = ['5369750' ,'5370393']; // config in paymob site, i can created in paymob site
    }

    public function generateToken()
    {
        $response = $this->buildRequest('POST' ,$this->base_url . '/api/auth/tokens' , ['api_key' => $this->api_key ] , 'json' ) ;
        return $response->getData(true)['data']['token'] ;
    }

    public function generateOrder()
    {
        $order = Http::withHeaders(['content-type' => 'application/json'])->post('https://accept.paymob.com/api/ecommerce/orders',
            [
                "auth_token" => $this->generateToken() ,
                "delivery_needed" => "false",
                "merchant_order_id" => $this->order_id,
                "amount_cents" => $this->total_price * 100,
                "items" => []
            ]);

        $order = $order->json();
        return $order ;
    }

public function generatePaymentKey()
{
    $token = $this->generateToken();
    $order = $this->generateOrder() ;

    $response = Http::post($this->base_url . '/api/acceptance/payment_keys', [
        "auth_token" => $token,
        "amount_cents" => $this->total_price * 100 ,
        "expiration" => 3600,
        "merchant_order_id" => $this->order_id ,
        "order_id" => $order['id'] ,
        "billing_data" => [
            'first_name' => 'Mahmoud' ,
            'last_name' => 'Osha' ,
            'phone_number' => '0246018405' ,
            'address' => 'Arab in omar ibn Khatab',
            'street' => 'Arab in omar ibn Khatab',
            'building' => '5' ,
            'floor' => '1' ,
            'apartment' => '5' ,
            'city' => 'cairo' ,
            'country' => 'Egypt' ,
            'email' => 'mahmoud@gmail.com' ,
        ],
        "currency" => "EGP",
        "integration_id" => $this->integrations_id[0], // مثلاً أول وسيلة دفع Visa
    ]);

    return $response->json();
}


    public function sendPayment(Request $request , $order_id , $total_price)
    {
        $this->total_price = $total_price;
        $this->order_id = $order_id;
        $paymentKey = $this->generatePaymentKey()['token'];
        return redirect("https://accept.paymob.com/api/acceptance/iframes/" . '972298' . "?payment_token=" . $paymentKey);
    }

    public function callback($request)
    {
        $data = $request->all();
        // تأكد أن البيانات وصلت من Paymob
        if (isset($data['success']) && $data['success'] == "true") {

            $merchantOrderId = $data['merchant_order_id'] ?? null;

            if ($merchantOrderId) {
                Order::where('id', $merchantOrderId)->update([
                    'payment_status' => 'paid',
                    'status' => 'processing'
                ]);
                Mail::to('abdelrahimmahmoud6@gmail.com')->send(new ConfirmPayment($merchantOrderId));
                return true ;
            }

            return false ;
        }

        return false ;

    }

}

// ######### Webhook return this data ######
// {
//   "id": 123456789,
//   "pending": false,
//   "amount_cents": 40000,
//   "success": true,
//   "is_auth": false,
//   "is_capture": true,
//   "is_standalone_payment": true,
//   "is_voided": false,
//   "is_refunded": false,
//   "is_3d_secure": true,
//   "integration_id": 5369750,
//   "profile_id": 12345,
//   "has_parent_transaction": false,
//   "order": {
//     "id": 987654321,
//     "created_at": "2025-10-23T13:45:30Z",
//     "delivery_needed": false,
//     "merchant": {
//       "id": 99999,
//       "email": "merchant@example.com"
//     },
//     "amount_cents": 40000,
//     "shipping_data": {
//       "first_name": "Mahmoud",
//       "last_name": "Osha",
//       "phone_number": "01012345678",
//       "email": "mahmoud@gmail.com",
//       "city": "Cairo",
//       "country": "Egypt"
//     },
//     "currency": "EGP",
//     "merchant_order_id": "15"
//   },
//   "source_data": {
//     "pan": "2346",
//     "type": "card",
//     "sub_type": "MasterCard"
//   },
//   "data": {
//     "card_type": "MasterCard",
//     "card_subtype": "Credit",
//     "masked_pan": "512345******2346",
//     "cardholder_name": "MAHMOUD OSHA",
//     "acq_response_code": "00",
//     "order_description": "Test Order"
//   },
//   "created_at": "2025-10-23T13:46:00Z",
//   "currency": "EGP",
//   "error_occured": false,
//   "error_msg": null,
//   "txn_response_code": "00",
//   "message": "Approved",
//   "merchant_commission": 500,
//   "owner": 123456,
//   "refunded_amount_cents": 0,
//   "captured_amount": 40000,
//   "source_id": 1234567
// }
