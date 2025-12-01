<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id' , 'product_id' , 'product_name' , 'total_price' , 'option' , 'status' , 'payment_status'
    ];

    protected $casts = [
        'option' => 'array', 
    ];

    public static function booted()
    {
        static::creating(function(Order $order){
            $order->number_order = Order::getNextNumberOrder();
        });
    }



    public static function getNextNumberOrder()
    {
        $year = Carbon::now()->year ;
        $latest_order = Order::whereYear('created_at' , $year )->max('number_order') ;
        if($latest_order){
            return $latest_order + 1 ;
        }
        return $year . '0001' ;
    }
    // relationship
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }

    public function couponUsage()
    {
        return $this->hasOne(CouponUsage::class, 'order_id');
    }

}
