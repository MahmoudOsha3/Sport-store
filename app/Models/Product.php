<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
class Product extends Model
{

    use HasFactory , SoftDeletes;
    protected $fillable = ['title' , 'description' , 'slug' , 'image' , 'sku' , 'price' ,'compare_price','rate','status' ,'category_id' ] ;


    // local scope
    public function scopeSearch(Builder $builder ,$request)
    {
        $builder->when($request->search, function($builder , $search){
            $builder->whereAny(['title' , 'sku' , 'price' , 'status'], 'like' , "%{$search}%") ;
        });
    }

    // Accessors 
    public function getDiscountPercentageAttribute()
    {
        return  round(($this->compare_price - $this->price) / $this->compare_price  * 100 , 2) ;
    }

    // Global scope
    protected static function booted(){
        static::creating(function(Product $product){
            $prefix = 'CURVA-' ; // name of brand
            $latest_sku = Product::latest('id')->value('sku') ;

            // $latest_sku = Product::latest()->value('sku');
            if($latest_sku)
            {
                $sku_parts = explode('-' , $latest_sku) ; // convert array and separate after each (-)
                $latest_part = end($sku_parts) ;
                if(is_numeric($latest_part)){
                    $latest_part ++ ;
                    $product->sku = $prefix . str_pad($latest_part , '4' , '0', STR_PAD_LEFT);
                    // $product->sku = $prefix . $latest_part + 1 ;
                }
                // $product->sku = $prefix . str_pad($new_numeric_part, '4' , '0', STR_PAD_LEFT) ;

            }else{
                $product->sku = $prefix . '0001' ;
            }
        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class,'id') ;
    }


    public function variants()
    {
        return $this->hasMany(ProductVariant::class, 'product_id');
    }
}
