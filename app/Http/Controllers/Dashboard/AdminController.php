<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AdminRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin ;
use Illuminate\Support\Facades\Gate;

class AdminController extends Controller
{
    // login
    public function index(Request $request)
    {
        $admins = Admin::latest()->search($request)->paginate(10) ;
        return view('dashboard.admins.index' , compact('admins')) ;
    }

    public function create()
    {
        if(Gate::denies('create.admin')){
            abort(403 ,'Not Authorized') ;
        }
        return view('auth.admin.register') ;
    }

    public function store(AdminRequest $request)
    {
        try{
            $this->authorize('create' , Admin::class) ;
            $validate = $request->validated() ;
            $name_image = $request->file('image')->getClientOriginalName() ;
            $path = $request->file('image')->storeAs('dashboard/images' , $name_image ,'admins') ;
            Admin::create(array_merge($validate, ['image' => $path]));
            return redirect()->back()->with('success' , 'تم إنشاء المشرف بنجاح') ;
        }
        catch(\Exception $e){
            return redirect()->back()->with('error' , $e->getMessage()) ;
        }
    }

}
