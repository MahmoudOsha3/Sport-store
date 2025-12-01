<?php

namespace App\Events;

use App\Models\Order;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class OrderCreated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    // تحديد القناة التي سيتم البث عليها
    public function broadcastOn()
    {
        return new Channel('admin.orders');
    }

    // الاسم الذي سيتم استقباله في الواجهة
    public function broadcastAs() 
    {
        return 'order.created';
    }

    public function broadcastWith() : array
    {
        return [
            'order' => [
                'order_number' =>   $this->order->number_order ,
                'user_name' => $this->order->user->name ,
                'link' => route('orders.show' , $this->order->id )
                ]
        ];
    }
}
