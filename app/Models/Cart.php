<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cookie;
Use Illuminate\Support\Str ;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = ['cookie_id' , 'product_id' , 'variant_id' , 'user_id' , 'option' , 'quantity'] ;

    public static function booted()
    {
        static::addGlobalScope('carts' , function(Builder $builder){
            $builder->where('cookie_id' , Cart::getCookieId());
            // $builder->where('cookie_id' , Cart::getCookieId())->where('user_id' , auth()->user()->id ) ;

        });

        // في كل مرة يتم إنشاء كرت يتم إنشاء الايدي الخاص بي
        static::creating(function (Cart $cart){
            $cart->cookie_id = Cart::getCookieId() ;
        });
    }


    public static function getCookieId()
    {
        $cookie_id = Cookie::get('cart_id');
        if(! $cookie_id)
        {
            $cookie_id = Str::uuid() ;
            Cookie::queue('cart_id' , $cookie_id  , 30 * 24 * 60 ) ;
        }
        return $cookie_id ;
    }




    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id') ;
    }

        public function variant()
    {
        return $this->belongsTo(ProductVariant::class, 'variant_id') ;
    }
}
