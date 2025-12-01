<?php

namespace App\Http\Controllers\Dashboard\Auth ;

use App\Models\admin ;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\AdminRequest;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;

class AuthAdminController extends Controller
{
    // login
    public function index()
    {
        return view('auth.admin.login') ;
    }

    public function login(Request $request)
    {
        // هنا انا بقول لو عدد ريكوست الخاص بهذا المفتاح وصل لخمس مثلا اقف وابعت تحذير ان يخض بعد مدة معينة
        if(RateLimiter::tooManyAttempts($this->throttleKey($request) , 5 )){
            $seconds = RateLimiter::availableIn($this->throttleKey($request));
            $minutes = ceil($seconds / 60) ;

            throw ValidationException::withMessages([
                'email' => 'يرجى المحاولة بعد '.$minutes .' دقيقة.',
            ]);
        }
        $validate = $request->validate([
            'email' => 'required|email|exists:admins,email',
            'password' => 'required|string|min:4'
            ]) ;
        $credentials = $request->only('email', 'password');

        if(! Auth::guard('admin')->attempt($credentials , $request->boolean('remember')))
        {
            RateLimiter::hit($this->throttleKey($request) , 60 * 2); // زود العداد علي هذا المفتاح
            return redirect()->back()->withErrors([
                'email' => 'البريد الإلكتروني أو كلمة المرور غير صحيحة.',
            ])->withInput() ;
        }

        RateLimiter::clear($this->throttleKey($request)) ; // خلاص لوجين صحيح امسح بقي العداد
        $request->session()->regenerate() ;
        return redirect()->route('admin.dashboard');
    }

    // register
    public function create()
    {
        return view('auth.admin.register') ;
    }

    public function store(AdminRequest $request)
    {
        try{
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


    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login') ;
    }


    public function throttleKey(Request $request)
    {
        return Str::lower($request->email) . '|' . $request->ip() ;
    }

}
