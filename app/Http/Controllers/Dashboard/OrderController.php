<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class OrderController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny' , Order::class) ;
        $orders = Order::with('couponUsage' , 'user')->latest()->paginate(7) ;
        return view('dashboard.orders.index' , compact('orders')) ;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($order_id)
    {
        $this->authorize('view' , Order::class) ;
        $order = Order::with('couponUsage')->findorfail($order_id ) ;
        return view('dashboard.orders.show' , compact('order')) ;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        $this->authorize('update' , Order::class) ;
        try{
        $order = Order::findorfail($id) ;
        $order->update([
            'status' => $request->status
        ]) ;
        return redirect()->back()->with(['success' => 'تم تعديل حالة الطلب بنجاح ']);
        }catch(\Exception $e){
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
