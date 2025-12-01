<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    use HasFactory;
    protected $fillable = ['product_id' , 'color' , 'size' , 'stock' , 'sku' , 'price'] ;


    // Accessor
    // public function getColorAttribute()
    // {
    //     return explode('/' , $this->product_variant)[0] ?? null  ;
    // }

    // public function getSizeAttribute()
    // {
    //     return explode('/' , $this->product_variant)[1] ?? null  ;
    // }

    public function product()
    {
        return $this->belongsTo(Product::class, 'id');
    }

    
}
