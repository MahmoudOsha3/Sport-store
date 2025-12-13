<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Broadcasting\Channel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Mail;

class OrderCreatedNotifiaction extends Notification implements ShouldQueue
{
    use Queueable;

    protected $order ;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function via(object $notifiable): array
    {
        return ['broadcast' , 'database'] ;
    }


    public function toDataBase($notifiable)
    {
        return [
            'created_by' => $this->order->user->name ,
            'order_id' => $this->order->id ,
            'number_order' => $this->order->number_order ,
            'link' => route('orders.show', $this->order->id),
        ] ;
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'order' => [
                'order_number' => $this->order->number_order ,
                'created_by' => $this->order->user->name ,
                'link' => route('orders.show', $this->order->id), 
            ]
        ]);
    }

    public function broadcastType()
    {
        return 'order.created';
    }

    public function broadcastOn()
    {
        return new Channel('admin.orders'); // Public Channel
    }

}
