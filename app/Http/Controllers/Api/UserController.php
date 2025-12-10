<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Traits\ResponseApiTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    use ResponseApiTrait ;
    public function index()
    {
        $users = User::paginate(10) ;
        return UserResource::collection($users) ;
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email'
        ]);

        $user = User::create([
            'name' => $request->name ,
            'email' => $request->email ,
            'password' => Hash::make($request->password),
            'address' => $request->address ,
            'phone' => $request->phone
        ]);

        return $this->successApi($user , 'User Created Succesfully' , 201) ;
    }

    public function show($id)
    {
        $user = User::findorfail($id) ;
        return $this->getDataApi($user , 200) ;


    }
    public function update(Request $request , User $user)
    {
        $user->update([
            'name' => $request->name ,
        ]);

        return $this->successApi($user , 'User Uodated Succesfully' , 200) ;

    }

    public function destroy(User $user)
    {
        $user->delete() ;
        return $this->DeleteApi('User deleted Succesfully' , 200) ;

    }
}
