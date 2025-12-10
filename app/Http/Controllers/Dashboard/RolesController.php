<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\RoleAbility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::all() ;
        return view('dashboard.roles.index' , compact('roles')) ;
    }


    public function create()
    {
        $roles = Role::all() ;
        return view('dashboard.roles.create' , compact('roles'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255' ,
            'permissions' => 'required|array'
        ]);
        Role::createWithPermission($request) ;
        return redirect()->back()->with(['success' => 'تم إنشاء الدور بنجاح']) ;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return 66 ;
    }

    public function edit($id)
    {
        $role = Role::findorfail($id) ;
        $permissions = RoleAbility::where('role_id' , $role->id)->get() ;
        return view('dashboard.roles.edit' , compact('role' , 'permissions')) ;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255' ,
            'permissions' => 'required|array'
        ]);
        Role::updateWithPermission($request , $role) ;
        return redirect()->back()->with(['success' => 'تم التعديل  بنجاح']) ;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $role->delete() ;
        return redirect()->back()->with(['success' => 'تم الحذف  بنجاح']) ;
    }
}
