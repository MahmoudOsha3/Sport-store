<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Broadcast;

class OrderCreatedNotifiaction extends Notification implements ShouldQueue
{
    use Queueable;

    protected $order ;
    /**
     * Create a new notification instance.
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['broadcast'];
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'title' => "Notification is done",
            'body' => "hello  , $this->order . " ,
        ]);
    }

    public function toArray($notifiable)
    {
        return [
            'order_id' => $this->order->id,
            'message' => "New order #{$this->order->id} has been created",
        ];
    }
}
