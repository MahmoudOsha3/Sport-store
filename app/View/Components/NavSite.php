<?php

namespace App\View\Components;

use App\Models\Cart;
use App\Models\Category;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class NavSite extends Component
{
    public $user ;
    public $carts ;
    public $categories ;
    public $total_price_carts ;
    public function __construct()
    {
        $this->user = Auth::user() ;
        $this->carts = Cart::with(['product' , 'variant'])->get() ;
        $this->categories = Category::get() ;
        $this->total_price_carts = Cart::join('product_variants', 'carts.variant_id', '=', 'product_variants.id')
            ->selectRaw('SUM(product_variants.price * carts.quantity) as total')
            ->value('total') ;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.nav-site');
    }
}
