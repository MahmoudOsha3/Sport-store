<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ConfirmPayment extends Mailable
{
    use Queueable, SerializesModels;

    public $order_id ;
    public function __construct($order_id)
    {
        $this->order_id = $order_id ;
    }
    public function build()
    {
        $order = Order::with('orderItems')->where('id' , $this->order_id)->first() ;
        return $this->subject('Confirm Payment Mailano')->view('emails.confirmPayment' , compact('order'));
    }
}
