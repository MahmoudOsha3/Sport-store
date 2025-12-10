<?php

namespace App\Jobs;

use App\Models\Order;
use App\Models\ProductVariant;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class DeleteOrderExpired implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    public function handle(): void
    {
        $orders = Order::where('created_at', '<', now()->subMinute())
                        ->where('payment_status', 'pending')
                        ->with('orderItems')
                        ->get();

        foreach ($orders as $order) {
            foreach ($order->orderItems as $orderItem) {
                ProductVariant::where([
                    'product_id' => $orderItem->product_id,
                    'color'      => $orderItem->options['color'] ?? null,
                    'size'       => $orderItem->options['size'] ?? null,
                ])->increment('stock', $orderItem->quantity);
            }

            $order->delete();
        }

    }
}
