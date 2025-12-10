<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\CouponRequest;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponsController extends Controller
{

    public function __construct() {
        // $this->authorizeResource(Coupon::class , 'coupon') ;
    }
    public function index()
    {
        $this->authorize('viewAny' , Coupon::class) ;
        $coupons = Coupon::latest()->paginate(10) ;
        return view('dashboard.coupons.index' , compact('coupons')) ;
    }

    public function create()
    {
        //
    }


    public function store(CouponRequest $request)
    {
        try{
            $this->authorize('create' , Coupon::class) ;
            $validate = $request->validated() ;
            Coupon::create($validate);
            return redirect()->back()->with('success' , 'تم إنشاء الكوبون');
        }catch(\Exception $e){
            return redirect()->back()->with('error' , $e->getMessage() );
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function update(CouponRequest $request, $id)
    {
        $this->authorize('update', Coupon::class) ;
        try{
            $validate = $request->validated() ;
            $coupon = Coupon::where('id' , $request->coupon_id)->first() ;
            $coupon->update($validate) ;
            return redirect()->back()->with('success' , 'تم تعديل الكوبون');
        }catch(\Exception $e){
            return redirect()->back()->with('error' , $e->getMessage() );
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Coupon $coupon)
    {
        $this->authorize('delete' , Coupon::class) ;
        $coupon->delete() ;
        return redirect()->back()->with('success' , 'تم الحذف بنجاح');
    }
}
