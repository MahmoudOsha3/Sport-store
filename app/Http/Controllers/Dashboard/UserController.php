<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Jobs\UserCreated;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class UserController extends Controller
{
    public function index()
    {
        // $users = Cache::remember('users' , 60 , function (){
        //     return User::latest()->paginate(7) ;
        // });
        $users  =User::latest()->paginate(7) ;
        return view('dashboard.users.index' , compact('users')) ;
    }

    public function store()
    {
        
    }

    public function destroy(Request $request)
    {
        try{
            $user = User::findorfail($request->id)->delete() ;
            return redirect()->back()->with(['success' => 'تم الحذف بنجاح']);
        }catch(\Exception $e){
            return redirect()->with(['error' => $e->getMessage()]);
        }

    }
}
