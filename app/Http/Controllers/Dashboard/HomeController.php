<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $countUsers = User::count() ;

        $countNewProducts = Product::whereMonth('created_at' , now()->month)
            ->whereYear('created_at' , now()->year)->count() ;

        $countNewOrders = Order::whereMonth('created_at' , now()->month)
            ->whereYear('created_at' , now()->year)->count() ;

        $countOrdersNonCompleted = Order::whereNot('payment_status' , 'paid')->count() ;

        $totalBuyingInThisMonth = Order::whereMonth('created_at' , now()->month)
            ->sum('total_price');

        $productsMoreSales = OrderItem::selectRaw('product_name , product_id , COUNT(product_id) as total')
            ->groupBy('product_id' , 'product_name')
            ->orderByDesc('total')->limit(3)
            ->get();


        return view('dashboard.home.index' , get_defined_vars()) ;
    }
}
